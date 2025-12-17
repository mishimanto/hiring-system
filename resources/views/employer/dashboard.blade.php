@extends('layouts.app')

@section('title', 'Dashboard - ' . config('app.name'))

@section('content')
<div class="container py-5">
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="h2">Employer Dashboard</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card dashboard-card border-left-primary">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Jobs</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['total_jobs'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-briefcase fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card dashboard-card border-left-success">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Active Jobs</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['active_jobs'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card dashboard-card border-left-warning">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Pending Applications</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['pending_applications'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card dashboard-card border-left-info">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Total Applications</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['total_applications'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-file-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Quick Actions</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('jobs.create') }}" class="btn btn-primary w-100">
                                <i class="fas fa-plus me-2"></i>Post New Job
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('jobs.my-jobs') }}" class="btn btn-success w-100">
                                <i class="fas fa-briefcase me-2"></i>Manage Jobs
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('employer.applications') }}" class="btn btn-info w-100">
                                <i class="fas fa-users me-2"></i>View Applications
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('profile.edit') }}" class="btn btn-warning w-100">
                                <i class="fas fa-building me-2"></i>Company Profile
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Recent Applications -->
        <div class="col-lg-8 mb-4">
            <div class="card shadow">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Recent Applications</h6>
                    <a href="{{ route('employer.applications') }}" class="btn btn-sm btn-primary">View All</a>
                </div>
                <div class="card-body">
                    @if($applications->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Applicant</th>
                                        <th>Job Title</th>
                                        <th>Applied Date</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($applications as $application)
                                        <tr>
                                            <td>{{ $application->jobSeeker->name }}</td>
                                            <td>{{ Str::limit($application->job->title, 25) }}</td>
                                            <td>{{ $application->applied_at->format('M d, Y') }}</td>
                                            <td>
                                                @if($application->status === 'pending')
                                                    <span class="badge bg-warning">Pending</span>
                                                @elseif($application->status === 'reviewed')
                                                    <span class="badge bg-info">Reviewed</span>
                                                @elseif($application->status === 'shortlisted')
                                                    <span class="badge bg-primary">Shortlisted</span>
                                                @elseif($application->status === 'hired')
                                                    <span class="badge bg-success">Hired</span>
                                                @else
                                                    <span class="badge bg-danger">Rejected</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('applications.show', $application) }}" class="btn btn-sm btn-info">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-users fa-3x text-muted mb-3"></i>
                            <h5>No applications yet</h5>
                            <p class="text-muted">Applications will appear here when candidates apply for your jobs.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Recent Jobs -->
        <div class="col-lg-4 mb-4">
            <div class="card shadow">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Recent Jobs</h6>
                    <a href="{{ route('jobs.my-jobs') }}" class="btn btn-sm btn-primary">View All</a>
                </div>
                <div class="card-body">
                    @if($jobs->count() > 0)
                        @foreach($jobs as $job)
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h6 class="card-title">{{ Str::limit($job->title, 40) }}</h6>
                                    <p class="card-text small">
                                        <i class="fas fa-map-marker-alt me-1"></i> {{ $job->location }}<br>
                                        <i class="fas fa-calendar-alt me-1"></i> Deadline: {{ $job->deadline->format('M d') }}<br>
                                        <i class="fas fa-users me-1"></i> {{ $job->applications_count ?? $job->applications()->count() }} applications
                                    </p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="badge bg-{{ $job->status === 'approved' ? 'success' : ($job->status === 'pending' ? 'warning' : 'danger') }}">
                                            {{ ucfirst($job->status) }}
                                        </span>
                                        <div>
                                            <a href="{{ route('jobs.show', $job) }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('jobs.edit', $job) }}" class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-briefcase fa-3x text-muted mb-3"></i>
                            <p class="text-muted">You haven't posted any jobs yet.</p>
                            <a href="{{ route('jobs.create') }}" class="btn btn-primary">Post Your First Job</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection