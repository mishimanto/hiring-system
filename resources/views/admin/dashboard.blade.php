@extends('layouts.admin')

@section('title', 'Admin Dashboard - ' . config('app.name'))

@section('page-title', 'Dashboard')

@section('breadcrumbs')
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
<div class="row">
    <!-- Stats Cards -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stat-card primary">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="stat-title">Total Users</div>
                        <div class="stat-value">{{ $stats['total_users'] }}</div>
                        <!-- <div class="text-xs">
                            <span class="text-success me-2">
                                <i class="fas fa-arrow-up"></i> {{ round(($stats['total_users'] / max($stats['total_users'], 1)) * 100) }}%
                            </span>
                            <span class="text-muted">Since last month</span>
                        </div> -->
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stat-card success">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="stat-title">Total Jobs</div>
                        <div class="stat-value">{{ $stats['total_jobs'] }}</div>
                        <!-- <div class="text-xs">
                            <span class="text-success me-2">
                                <i class="fas fa-arrow-up"></i> {{ round(($stats['total_jobs'] / max($stats['total_jobs'], 1)) * 100) }}%
                            </span>
                            <span class="text-muted">Since last month</span>
                        </div> -->
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-briefcase fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stat-card info">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="stat-title">Total Applications</div>
                        <div class="stat-value">{{ $stats['total_applications'] }}</div>
                        <!-- <div class="text-xs">
                            <span class="text-success me-2">
                                <i class="fas fa-arrow-up"></i> {{ round(($stats['total_applications'] / max($stats['total_applications'], 1)) * 100) }}%
                            </span>
                            <span class="text-muted">Since last month</span>
                        </div> -->
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-file-alt fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stat-card warning">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="stat-title">Pending Jobs</div>
                        <div class="stat-value">{{ $stats['pending_jobs'] }}</div>
                        <!-- <div class="text-xs">
                            <span class="text-danger me-2">
                                <i class="fas fa-exclamation-circle"></i> Needs attention
                            </span>
                        </div> -->
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clock fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Quick Stats -->
    <div class="col-lg-4 mb-4">
        <div class="card">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Quick Stats</h6>
            </div>
            <div class="card-body">
                <div class="list-group list-group-flush">
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <i class="fas fa-building text-primary me-2"></i>
                            <span>Employers</span>
                        </div>
                        <span class="badge bg-primary rounded-pill">{{ $stats['active_employers'] }}</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <i class="fas fa-user-tie text-success me-2"></i>
                            <span>Job Seekers</span>
                        </div>
                        <span class="badge bg-success rounded-pill">{{ $stats['active_job_seekers'] }}</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <i class="fas fa-user-check text-info me-2"></i>
                            <span>Hired Candidates</span>
                        </div>
                        <span class="badge bg-info rounded-pill">{{ $stats['total_hires'] }}</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <i class="fas fa-chart-line text-warning me-2"></i>
                            <span>Active Jobs</span>
                        </div>
                        <span class="badge bg-warning rounded-pill">{{ \App\Models\OpenJob::where('is_active', true)->where('deadline', '>=', now())->count() }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Jobs -->
    <div class="col-lg-8 mb-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Recent Job Postings</h6>
                <a href="{{ route('admin.jobs') }}" class="btn btn-sm btn-primary">View All</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Company</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentJobs as $job)
                                <tr>
                                    <td>
                                        <a href="{{ route('jobs.show', $job) }}" class="text-decoration-none">
                                            {{ Str::limit($job->title, 30) }}
                                        </a>
                                    </td>
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
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('jobs.show', $job) }}" class="btn btn-info">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            @if($job->status === 'pending')
                                                <form action="{{ route('jobs.approve', $job) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                </form>
                                                <form action="{{ route('jobs.reject', $job) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </form>
                                            @endif
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

<div class="row">
    <!-- Recent Users -->
    <div class="col-lg-12 mb-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Recent Users</h6>
                <a href="{{ route('admin.users') }}" class="btn btn-sm btn-primary">View All</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Joined</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentUsers as $user)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" 
                                                 style="width: 40px; height: 40px;">
                                                <i class="fas fa-user"></i>
                                            </div>
                                            <div>
                                                <strong>{{ $user->name }}</strong>
                                                @if($user->company_name)
                                                    <br><small class="text-muted">{{ $user->company_name }}</small>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <span class="badge bg-{{ $user->role == 'admin' ? 'danger' : ($user->role == 'employer' ? 'primary' : 'success') }}">
                                            {{ ucfirst(str_replace('_', ' ', $user->role)) }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($user->is_active)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>{{ $user->created_at->diffForHumans() }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Links -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Quick Actions</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('admin.users') }}" class="btn btn-primary w-100">
                            <i class="fas fa-users me-2"></i>Manage Users
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('admin.jobs') }}" class="btn btn-success w-100">
                            <i class="fas fa-briefcase me-2"></i>Manage Jobs
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('admin.reports') }}" class="btn btn-info w-100">
                            <i class="fas fa-chart-bar me-2"></i>View Reports
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('admin.settings.index') }}" class="btn btn-warning w-100">
                            <i class="fas fa-cog me-2"></i>Settings
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection