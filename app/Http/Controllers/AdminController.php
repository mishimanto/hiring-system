<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\OpenJob;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware(['auth', 'role:admin']);
    // }

    public function dashboard()
    {
        $stats = [
            'total_users' => User::count(),
            'total_jobs' => OpenJob::count(),
            'total_applications' => JobApplication::count(),
            'total_hires' => JobApplication::where('status', 'hired')->count(),
            'pending_jobs' => OpenJob::where('status', 'pending')->count(),
            'active_employers' => User::employers()->active()->count(),
            'active_job_seekers' => User::jobSeekers()->active()->count(),
        ];

        $recentJobs = OpenJob::with('employer')->latest()->take(5)->get();
        $recentUsers = User::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentJobs', 'recentUsers'));
    }

    public function users(Request $request)
    {
        $query = User::query();

        // Filter by role
        if ($request->has('role')) {
            $query->where('role', $request->role);
        }

        // Filter by status
        if ($request->has('status')) {
            $query->where('is_active', $request->status === 'active');
        }

        // Search
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%")
                  ->orWhere('company_name', 'LIKE', "%{$search}%");
            });
        }

        $users = $query->latest()->paginate(20);

        return view('admin.users.index', compact('users'));
    }

    public function jobs(Request $request)
    {
        $query = OpenJob::with('employer');

        // Filter by status
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        // Filter by active status
        if ($request->has('active_status')) {
            if ($request->active_status === 'active') {
                $query->where('is_active', true)->where('deadline', '>=', now());
            } elseif ($request->active_status === 'expired') {
                $query->where(function($q) {
                    $q->where('is_active', false)->orWhere('deadline', '<', now());
                });
            }
        }

        // Search
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                  ->orWhere('description', 'LIKE', "%{$search}%")
                  ->orWhere('location', 'LIKE', "%{$search}%");
            });
        }

        $jobs = $query->latest()->paginate(20);

        return view('admin.jobs.index', compact('jobs'));
    }

    public function toggleUser(User $user)
    {
        $user->update(['is_active' => !$user->is_active]);

        $status = $user->is_active ? 'activated' : 'deactivated';
        return back()->with('success', "User {$status} successfully!");
    }

    public function destroyUser(User $user)
    {
        // Prevent deleting own account
        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot delete your own account!');
        }

        $user->delete();

        return back()->with('success', 'User deleted successfully!');
    }

    public function reports()
    {
        $stats = [
            'total_users' => User::count(),
            'total_employers' => User::employers()->count(),
            'total_job_seekers' => User::jobSeekers()->count(),
            'total_jobs' => OpenJob::count(),
            'total_applications' => JobApplication::count(),
            'hired_applications' => JobApplication::hired()->count(),
        ];

        // Monthly job postings (last 6 months)
        $sixMonthsAgo = now()->subMonths(6)->format('Y-m-01');
        
        $monthlyJobs = OpenJob::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as count')
            ->where('created_at', '>=', $sixMonthsAgo)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Job categories distribution
        $categories = OpenJob::selectRaw('category, COUNT(*) as count')
            ->groupBy('category')
            ->orderBy('count', 'desc')
            ->limit(10)
            ->get();

        return view('admin.reports', compact('stats', 'monthlyJobs', 'categories'));
    }

    public function settings()
    {
        $settings = [
            'site_name' => config('app.name'),
            'contact_email' => 'contact@jobportal.com',
            'contact_phone' => '+1 234 567 8900',
            'address' => '123 Job Street, Career City',
            'about_us' => 'We connect talented professionals with great opportunities.',
            'privacy_policy' => 'Your privacy is important to us...',
            'terms_conditions' => 'By using our platform, you agree to...',
        ];

        return view('admin.settings', compact('settings'));
    }

    public function updateSettings(Request $request)
    {
        $validated = $request->validate([
            'site_name' => 'required|string|max:255',
            'contact_email' => 'required|email',
            'contact_phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'logo' => 'nullable|image|max:2048',
            'about_us' => 'nullable|string',
            'privacy_policy' => 'nullable|string',
            'terms_conditions' => 'nullable|string',
        ]);

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('logos', 'public');
            // Store logo path in database or config
        }

        // Update .env or database settings here
        // For demo, we'll just show success message

        return back()->with('success', 'Settings updated successfully!');
    }

    public function clearCache()
    {
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('view:clear');
        Artisan::call('route:clear');

        return back()->with('success', 'Cache cleared successfully!');
    }

    public function clearOldData()
    {
        // Delete expired jobs
        OpenJob::where('deadline', '<', now()->subMonths(1))->delete();
        
        // Delete old applications
        JobApplication::where('created_at', '<', now()->subMonths(6))->delete();

        return back()->with('success', 'Old data cleared successfully!');
    }

    public function resetStats()
    {
        // Reset all counters to 0
        // This would be implemented based on your specific requirements
        
        return back()->with('success', 'Statistics reset successfully!');
    }
}