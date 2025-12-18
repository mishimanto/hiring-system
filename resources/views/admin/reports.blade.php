@extends('layouts.admin')

@section('title', 'Reports - ' . config('app.name'))

@section('page-title', 'Reports & Analytics')

@section('breadcrumbs')
    <li class="breadcrumb-item active">Reports</li>
@endsection

@section('content')
<div class="row">
    <!-- Overall Statistics -->
    <!-- <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Overall Platform Statistics</h6>
                <button onclick="window.print()" class="btn btn-sm btn-outline-primary">
                    <i class="fas fa-print me-1"></i>Print Report
                </button>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 col-sm-6 mb-2">
                        <div class="card stat-card primary">
                            <div class="card-body">
                                <div class="stat-title">Total Users</div>
                                <div class="stat-value">{{ \App\Models\User::count() }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-2">
                        <div class="card stat-card success">
                            <div class="card-body">
                                <div class="stat-title">Total Jobs Posted</div>
                                <div class="stat-value">{{ \App\Models\OpenJob::count() }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-2">
                        <div class="card stat-card info">
                            <div class="card-body">
                                <div class="stat-title">Total Applications</div>
                                <div class="stat-value">{{ \App\Models\JobApplication::count() }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-2">
                        <div class="card stat-card warning">
                            <div class="card-body">
                                <div class="stat-title">Hired Candidates</div>
                                <div class="stat-value">{{ \App\Models\JobApplication::where('status', 'hired')->count() }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
</div>

  <div class="row mb-3">
    <div class="col text-end">
        <button onclick="window.print()" class="btn btn-sm btn-outline-primary">
            <i class="fas fa-print me-1"></i> Print Report
        </button>
    </div>
</div>
              
           

<div class="row">
    <!-- Job Status Summary -->
    <div class="col-lg-4 mb-2">
        <div class="card">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Job Status Summary</h6>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <td>Approved Jobs</td>
                            <td><span class="badge bg-success">{{ \App\Models\OpenJob::where('status', 'approved')->count() }}</span></td>
                        </tr>
                        <tr>
                            <td>Pending Jobs</td>
                            <td><span class="badge bg-warning">{{ \App\Models\OpenJob::where('status', 'pending')->count() }}</span></td>
                        </tr>
                        <tr>
                            <td>Rejected Jobs</td>
                            <td><span class="badge bg-danger">{{ \App\Models\OpenJob::where('status', 'rejected')->count() }}</span></td>
                        </tr>
                        <tr>
                            <td>Active Jobs</td>
                            <td><span class="badge bg-info">{{ \App\Models\OpenJob::where('is_active', true)->where('deadline', '>=', now())->count() }}</span></td>
                        </tr>
                        <tr>
                            <td>Expired Jobs</td>
                            <td><span class="badge bg-secondary">{{ \App\Models\OpenJob::where('deadline', '<', now())->count() }}</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- User Distribution -->
    <div class="col-lg-4 mb-2">
        <div class="card">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">User Distribution</h6>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <td>Administrators</td>
                            <td><span class="badge bg-danger">{{ \App\Models\User::where('role', 'admin')->count() }}</span></td>
                        </tr>
                        <tr>
                            <td>Employers</td>
                            <td><span class="badge bg-primary">{{ \App\Models\User::where('role', 'employer')->count() }}</span></td>
                        </tr>
                        <tr>
                            <td>Job Seekers</td>
                            <td><span class="badge bg-success">{{ \App\Models\User::where('role', 'job_seeker')->count() }}</span></td>
                        </tr>
                        <tr>
                            <td>Active Users</td>
                            <td><span class="badge bg-info">{{ \App\Models\User::where('is_active', true)->count() }}</span></td>
                        </tr>
                        <tr>
                            <td>Inactive Users</td>
                            <td><span class="badge bg-secondary">{{ \App\Models\User::where('is_active', false)->count() }}</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Application Status -->
    <div class="col-lg-4 mb-2">
        <div class="card">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Application Status</h6>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <td>Pending Applications</td>
                            <td><span class="badge bg-warning">{{ \App\Models\JobApplication::where('status', 'pending')->count() }}</span></td>
                        </tr>
                        <tr>
                            <td>Reviewed Applications</td>
                            <td><span class="badge bg-info">{{ \App\Models\JobApplication::where('status', 'reviewed')->count() }}</span></td>
                        </tr>
                        <tr>
                            <td>Shortlisted Applications</td>
                            <td><span class="badge bg-primary">{{ \App\Models\JobApplication::where('status', 'shortlisted')->count() }}</span></td>
                        </tr>
                        <tr>
                            <td>Hired Candidates</td>
                            <td><span class="badge bg-success">{{ \App\Models\JobApplication::where('status', 'hired')->count() }}</span></td>
                        </tr>
                        <tr>
                            <td>Rejected Applications</td>
                            <td><span class="badge bg-danger">{{ \App\Models\JobApplication::where('status', 'rejected')->count() }}</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row mt-2">
    <!-- Recent Jobs Posted -->
    <div class="col-lg-6 mb-2">
        <div class="card">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Recent Job Postings</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Job Title</th>
                                <th>Company</th>
                                <th>Status</th>
                                <th>Posted</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $recentJobs = \App\Models\OpenJob::with('employer')
                                    ->latest()
                                    ->take(10)
                                    ->get();
                            @endphp
                            @foreach($recentJobs as $job)
                            <tr>
                                <td>{{ Str::limit($job->title, 25) }}</td>
                                <td>{{ $job->employer->company_name ?? 'N/A' }}</td>
                                <td>
                                    @if($job->status === 'approved')
                                        <span class="badge bg-success">Approved</span>
                                    @elseif($job->status === 'pending')
                                        <span class="badge bg-warning">Pending</span>
                                    @else
                                        <span class="badge bg-danger">Rejected</span>
                                    @endif
                                </td>
                                <td>{{ $job->created_at->diffForHumans() }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Company List -->
    <div class="col-lg-6 mb-2">
        <div class="card">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Registered Companies</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Company Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Jobs Posted</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $companies = \App\Models\User::where('role', 'employer')
                                    ->whereNotNull('company_name')
                                    ->get();
                            @endphp
                            @foreach($companies as $company)
                            <tr>
                                <td>{{ $company->company_name }}</td>
                                <td>{{ $company->email }}</td>
                                <td>{{ $company->phone ?? 'N/A' }}</td>
                                <td>
                                    @php
                                        $jobCount = \App\Models\OpenJob::where('employer_id', $company->id)->count();
                                    @endphp
                                    <span class="badge bg-info">{{ $jobCount }}</span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-2">
    <!-- Monthly Job Postings -->
    <div class="col-lg-8 mb-2">
        <div class="card">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Monthly Job Postings (Last 6 Months)</h6>
            </div>
            <div class="card-body">
                @php
                    $sixMonthsAgo = now()->subMonths(6)->format('Y-m-01');
                    $monthlyJobs = \App\Models\OpenJob::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as count')
                        ->where('created_at', '>=', $sixMonthsAgo)
                        ->groupBy('month')
                        ->orderBy('month')
                        ->get();
                    
                    // Fill in missing months
                    $months = [];
                    $counts = [];
                    for ($i = 5; $i >= 0; $i--) {
                        $month = now()->subMonths($i)->format('Y-m');
                        $months[] = now()->subMonths($i)->format('M Y');
                        $jobCount = $monthlyJobs->where('month', $month)->first();
                        $counts[] = $jobCount ? $jobCount->count : 0;
                    }
                @endphp
                <table class="table table-bordered">
                    <thead>
                        <tr class="bg-light">
                            <th>Month</th>
                            @foreach($months as $month)
                            <th class="text-center">{{ $month }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>Jobs Posted</strong></td>
                            @foreach($counts as $count)
                            <td class="text-center">{{ $count }}</td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
                
                <!-- Progress bars for visualization -->
                @php
                    $maxCount = max($counts) > 0 ? max($counts) : 1;
                @endphp
                <div class="mt-2">
                    @foreach($months as $index => $month)
                    <div class="mb-2">
                        <div class="d-flex justify-content-between">
                            <span>{{ $month }}</span>
                            <span>{{ $counts[$index] }} jobs</span>
                        </div>
                        <div class="progress" style="height: 20px;">
                            <div class="progress-bar bg-primary" role="progressbar" 
                                 style="width: {{ ($counts[$index] / $maxCount) * 100 }}%">
                                {{ $counts[$index] }}
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Job Categories -->
    <div class="col-lg-4 mb-2">
        <div class="card">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Job Categories</h6>
            </div>
            <div class="card-body">
                @php
                    $categories = \App\Models\OpenJob::selectRaw('category, COUNT(*) as count')
                        ->groupBy('category')
                        ->orderBy('count', 'desc')
                        ->get();
                @endphp
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Category</th>
                                <th>Jobs</th>
                                <th>%</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $totalJobs = $categories->sum('count');
                            @endphp
                            @foreach($categories as $category)
                                @php
                                    $percentage = $totalJobs > 0 ? round(($category->count / $totalJobs) * 100, 1) : 0;
                                @endphp
                                <tr>
                                    <td>{{ $category->category }}</td>
                                    <td>{{ $category->count }}</td>
                                    <td>
                                        <div class="progress" style="height: 20px;">
                                            <div class="progress-bar bg-primary" role="progressbar" 
                                                 style="width: {{ $percentage }}%">
                                                {{ $percentage }}%
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-2">
    <!-- Recent Users -->
    <div class="col-lg-6 mb-2">
        <div class="card">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Recent Users</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Role</th>
                                <th>Email</th>
                                <th>Joined</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $recentUsers = \App\Models\User::latest()->take(10)->get();
                            @endphp
                            @foreach($recentUsers as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>
                                    <span class="badge bg-{{ $user->role == 'admin' ? 'danger' : ($user->role == 'employer' ? 'primary' : 'success') }}">
                                        {{ ucfirst(str_replace('_', ' ', $user->role)) }}
                                    </span>
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->created_at->diffForHumans() }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Database Summary -->
    <div class="col-lg-6 mb-2">
        <div class="card">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Database Summary</h6>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <td>Total Users</td>
                            <td>{{ \App\Models\User::count() }}</td>
                        </tr>
                        <tr>
                            <td>Total Employers</td>
                            <td>{{ \App\Models\User::where('role', 'employer')->count() }}</td>
                        </tr>
                        <tr>
                            <td>Total Job Seekers</td>
                            <td>{{ \App\Models\User::where('role', 'job_seeker')->count() }}</td>
                        </tr>
                        <tr>
                            <td>Total Jobs Posted</td>
                            <td>{{ \App\Models\OpenJob::count() }}</td>
                        </tr>
                        <tr>
                            <td>Total Applications</td>
                            <td>{{ \App\Models\JobApplication::count() }}</td>
                        </tr>
                        <tr>
                            <td>Total Categories</td>
                            <td>{{ \App\Models\Category::count() }}</td>
                        </tr>
                        <tr>
                            <td>Resumes Uploaded</td>
                            <td>{{ \App\Models\User::whereNotNull('resume_path')->count() }}</td>
                        </tr>
                        <tr>
                            <td>Profile Completions</td>
                            <td>{{ \App\Models\JobSeekerProfile::where('profile_completion', '>=', 80)->count() }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Print Styles -->
<style>
    @media print {
        .navbar, .sidebar, .breadcrumbs, .btn, .card-header .btn {
            display: none !important;
        }
        
        .card {
            border: 1px solid #dee2e6;
            margin-bottom: 20px;
            break-inside: avoid;
        }
        
        .card-header {
            background-color: #f8f9fa !important;
            color: #000 !important;
            border-bottom: 2px solid #4e73df;
        }
        
        .stat-card {
            margin-bottom: 15px;
        }
        
        table {
            font-size: 12px;
        }
        
        h6 {
            font-size: 14px;
        }
        
        body {
            padding: 20px;
        }
    }
</style>

@endsection