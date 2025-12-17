@extends('layouts.app')

@section('title', 'My Applications - ' . config('app.name'))

@section('content')
<div class="container  py-5">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h2">My Applications</h1>
                <a href="{{ route('jobs.index') }}" class="btn btn-primary">
                    <i class="fas fa-search me-2"></i>Browse More Jobs
                </a>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">My Applications</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Filters -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Filters</h6>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('applications.index') }}">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option value="">All Status</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="reviewed" {{ request('status') == 'reviewed' ? 'selected' : '' }}>Reviewed</option>
                            <option value="shortlisted" {{ request('status') == 'shortlisted' ? 'selected' : '' }}>Shortlisted</option>
                            <option value="hired" {{ request('status') == 'hired' ? 'selected' : '' }}>Hired</option>
                            <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Search</label>
                        <input type="text" name="search" class="form-control" placeholder="Search by job title or company..." value="{{ request('search') }}">
                    </div>
                    <div class="col-md-2 mb-3 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100">Filter</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Applications Table -->
    <div class="card shadow">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All Applications ({{ $applications->total() }})</h6>
        </div>
        <div class="card-body">
            @if($applications->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Job Title</th>
                                <th>Company</th>
                                <th>Applied Date</th>
                                <th>Status</th>
                                <th>Deadline</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($applications as $application)
                                <tr>
                                    <td>
                                        <a href="{{ route('jobs.show', $application->job) }}" class="text-decoration-none">
                                            {{ Str::limit($application->job->title, 40) }}
                                        </a>
                                    </td>
                                    <td>{{ $application->job->employer->company_name ?? $application->job->employer->name }}</td>
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
                                        @if($application->job->deadline->isFuture())
                                            <span class="text-success">{{ $application->job->deadline->format('M d, Y') }}</span>
                                        @else
                                            <span class="text-danger">Expired</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('jobs.show', $application->job) }}" class="btn btn-info" title="View Job">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" 
                                                    data-bs-target="#coverLetterModal{{ $application->id }}" title="View Cover Letter">
                                                <i class="fas fa-file-alt"></i>
                                            </button>
                                        </div>

                                        <!-- Cover Letter Modal -->
                                        <div class="modal fade" id="coverLetterModal{{ $application->id }}" tabindex="-1">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Your Cover Letter for {{ $application->job->title }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="border rounded p-3 bg-light">
                                                            {!! nl2br(e($application->cover_letter)) !!}
                                                        </div>
                                                        <div class="mt-3">
                                                            <h6>Application Details:</h6>
                                                            <p><strong>Applied:</strong> {{ $application->applied_at->format('F d, Y h:i A') }}</p>
                                                            @if($application->reviewed_at)
                                                                <p><strong>Reviewed:</strong> {{ $application->reviewed_at->format('F d, Y h:i A') }}</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $applications->withQueryString()->links() }}
                </div>
                
                <!-- Stats -->
                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title">Application Statistics</h6>
                                <div class="row text-center">
                                    <div class="col">
                                        <h4>{{ $applications->where('status', 'pending')->count() }}</h4>
                                        <small class="text-muted">Pending</small>
                                    </div>
                                    <div class="col">
                                        <h4>{{ $applications->where('status', 'reviewed')->count() }}</h4>
                                        <small class="text-muted">Reviewed</small>
                                    </div>
                                    <div class="col">
                                        <h4>{{ $applications->where('status', 'shortlisted')->count() }}</h4>
                                        <small class="text-muted">Shortlisted</small>
                                    </div>
                                    <div class="col">
                                        <h4>{{ $applications->where('status', 'hired')->count() }}</h4>
                                        <small class="text-muted">Hired</small>
                                    </div>
                                    <div class="col">
                                        <h4>{{ $applications->where('status', 'rejected')->count() }}</h4>
                                        <small class="text-muted">Rejected</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-file-alt fa-3x text-muted mb-3"></i>
                    <h4>No applications yet</h4>
                    <p class="text-muted">You haven't applied for any jobs yet. Start your job search now!</p>
                    <a href="{{ route('jobs.index') }}" class="btn btn-primary">Browse Jobs</a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection