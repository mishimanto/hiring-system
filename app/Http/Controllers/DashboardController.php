<?php

namespace App\Http\Controllers;

use App\Models\OpenJob;
use App\Models\JobApplication;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        if ($user->isAdmin()) {
            return $this->adminDashboard();
        } elseif ($user->isEmployer()) {
            return $this->employerDashboard();
        } else {
            return $this->jobSeekerDashboard();
        }
    }

    private function adminDashboard()
    {
        $stats = [
            'total_jobs' => OpenJob::count(),
            'total_applications' => JobApplication::count(),
            'total_hires' => JobApplication::where('status', 'hired')->count(),
            'total_users' => User::count(),
            'pending_jobs' => OpenJob::where('status', 'pending')->count(),
            'active_employers' => User::employers()->active()->count(),
            'active_job_seekers' => User::jobSeekers()->active()->count(),
        ];

        $recentJobs = OpenJob::with('employer')->latest()->take(10)->get();
        $recentUsers = User::latest()->take(10)->get();

        return view('admin.dashboard', compact('stats', 'recentJobs', 'recentUsers'));
    }

    private function employerDashboard()
    {
        $employerId = Auth::id();
        
        $stats = [
            'total_jobs' => OpenJob::where('employer_id', $employerId)->count(),
            'active_jobs' => OpenJob::where('employer_id', $employerId)
                ->where('is_active', true)
                ->where('deadline', '>=', now())
                ->count(),
            'total_applications' => JobApplication::whereHas('job', function($q) use ($employerId) {
                $q->where('employer_id', $employerId);
            })->count(),
            'pending_applications' => JobApplication::whereHas('job', function($q) use ($employerId) {
                $q->where('employer_id', $employerId);
            })->where('status', 'pending')->count(),
        ];

        $jobs = OpenJob::where('employer_id', $employerId)
            ->withCount('applications')
            ->latest()
            ->take(5)
            ->get();

        $applications = JobApplication::whereHas('job', function($q) use ($employerId) {
                $q->where('employer_id', $employerId);
            })
            ->with(['job', 'jobSeeker'])
            ->latest()
            ->take(10)
            ->get();

        return view('employer.dashboard', compact('stats', 'jobs', 'applications'));
    }

    private function jobSeekerDashboard()
    {
        $jobSeekerId = Auth::id();
        
        $stats = [
            'total_applications' => JobApplication::where('job_seeker_id', $jobSeekerId)->count(),
            'pending_applications' => JobApplication::where('job_seeker_id', $jobSeekerId)
                ->where('status', 'pending')->count(),
            'shortlisted_applications' => JobApplication::where('job_seeker_id', $jobSeekerId)
                ->where('status', 'shortlisted')->count(),
            'hired_applications' => JobApplication::where('job_seeker_id', $jobSeekerId)
                ->where('status', 'hired')->count(),
        ];

        $applications = JobApplication::where('job_seeker_id', $jobSeekerId)
            ->with(['job.employer'])
            ->latest()
            ->take(10)
            ->get();

        // Get job IDs that the user has already applied to
        $appliedJobIds = JobApplication::where('job_seeker_id', $jobSeekerId)
            ->pluck('job_id')
            ->toArray();

        $suggestedJobs = OpenJob::where('status', 'approved')
            ->where('is_active', true)
            ->where('deadline', '>=', now())
            ->whereNotIn('id', $appliedJobIds)
            ->with('employer')
            ->inRandomOrder()
            ->take(5)
            ->get();

        return view('job-seeker.dashboard', compact('stats', 'applications', 'suggestedJobs'));
    }
    
}