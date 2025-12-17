<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index(Request $request)
    {
        $user = Auth::user();
        
        if ($user->isEmployer()) {
            return $this->employerApplications($request);
        } else {
            return $this->jobSeekerApplications($request);
        }
    }

    private function employerApplications(Request $request)
    {
        $query = JobApplication::whereHas('job', function($q) {
            $q->where('employer_id', Auth::id());
        })->with(['job', 'jobSeeker']);

        // Filter by status
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        // Filter by job
        if ($request->has('job_id') && $request->job_id) {
            $query->where('job_id', $request->job_id);
        }

        // Search
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->whereHas('jobSeeker', function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%");
            });
        }

        $applications = $query->latest()->paginate(20);

        return view('employer.applications.index', compact('applications'));
    }

    private function jobSeekerApplications(Request $request)
    {
        $query = JobApplication::where('job_seeker_id', Auth::id())
            ->with(['job.employer']);

        // Filter by status
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        // Search
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->whereHas('job', function($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                  ->orWhereHas('employer', function($q2) use ($search) {
                      $q2->where('company_name', 'LIKE', "%{$search}%")
                         ->orWhere('name', 'LIKE', "%{$search}%");
                  });
            });
        }

        $applications = $query->latest()->paginate(20);

        return view('job-seeker.applications.index', compact('applications'));
    }

    public function show(JobApplication $application)
    {
        // Authorization check
        $user = Auth::user();
        
        if ($user->isEmployer()) {
            if ($application->job->employer_id !== $user->id) {
                abort(403, 'Unauthorized action.');
            }
        } elseif ($user->isJobSeeker()) {
            if ($application->job_seeker_id !== $user->id) {
                abort(403, 'Unauthorized action.');
            }
        } elseif (!$user->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        $application->load(['job', 'jobSeeker']);

        return view('applications.show', compact('application'));
    }

    public function updateStatus(Request $request, JobApplication $application)
    {
        // Check if user is employer for this job
        if (!Auth::user()->isEmployer() || $application->job->employer_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'status' => 'required|in:shortlisted,rejected,hired,reviewed',
            'notes' => 'nullable|string|max:500',
        ]);

        $updateData = [
            'status' => $request->status,
            'reviewed_at' => now(),
        ];

        if ($request->has('notes')) {
            $updateData['notes'] = $request->notes;
        }

        $application->update($updateData);

        return back()->with('success', 'Application status updated!');
    }
}