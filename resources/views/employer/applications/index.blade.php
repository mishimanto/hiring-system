@extends('layouts.app')

@section('title', 'Manage Applications - ' . config('app.name'))

@section('content')
<div class="container py-5">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h2">Manage Applications</h1>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Applications</li>
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
            <form method="GET" action="{{ route('employer.applications') }}">
                <div class="row">
                    <div class="col-md-3 mb-3">
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
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Job</label>
                        <select name="job_id" class="form-select">
                            <option value="">All Jobs</option>
                            @foreach(auth()->user()->openjobs as $job)
                                <option value="{{ $job->id }}" {{ request('job_id') == $job->id ? 'selected' : '' }}>
                                    {{ $job->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Search</label>
                        <input type="text" name="search" class="form-control" placeholder="Search by applicant name..." value="{{ request('search') }}">
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
                                <th>Applicant</th>
                                <th>Job Title</th>
                                <th>Applied Date</th>
                                <th>Status</th>
                                <th>Cover Letter</th>
                                <th>Resume</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($applications as $application)
                                <tr>
                                    <td>
                                        <strong>{{ $application->jobSeeker->name }}</strong><br>
                                        <small class="text-muted">{{ $application->jobSeeker->email }}</small>
                                    </td>
                                    <td>
                                        <a href="{{ route('jobs.show', $application->job) }}" class="text-decoration-none">
                                            {{ Str::limit($application->job->title, 30) }}
                                        </a>
                                    </td>
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
                                        <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" 
                                                data-bs-target="#coverLetterModal{{ $application->id }}">
                                            View
                                        </button>
                                    </td>
                                    <td>
                                        @if($application->resume_path)
                                            <a href="{{ Storage::url($application->resume_path) }}" target="_blank" 
                                               class="btn btn-sm btn-outline-primary">
                                                Download
                                            </a>
                                        @else
                                            <span class="text-muted">No resume</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('applications.show', $application) }}" class="btn btn-info" title="View Details">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            
                                            <div class="dropdown">
                                                <button class="btn btn-primary dropdown-toggle" type="button" 
                                                        data-bs-toggle="dropdown">Update Status</button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <form action="{{ route('applications.status', $application) }}" method="POST" class="dropdown-item p-0">
                                                            @csrf
                                                            @method('PATCH')
                                                            <input type="hidden" name="status" value="reviewed">
                                                            <button type="submit" class="dropdown-item">Mark as Reviewed</button>
                                                        </form>
                                                    </li>
                                                    <li>
                                                        <form action="{{ route('applications.status', $application) }}" method="POST" class="dropdown-item p-0">
                                                            @csrf
                                                            @method('PATCH')
                                                            <input type="hidden" name="status" value="shortlisted">
                                                            <button type="submit" class="dropdown-item">Shortlist</button>
                                                        </form>
                                                    </li>
                                                    <li>
                                                        <form action="{{ route('applications.status', $application) }}" method="POST" class="dropdown-item p-0">
                                                            @csrf
                                                            @method('PATCH')
                                                            <input type="hidden" name="status" value="hired">
                                                            <button type="submit" class="dropdown-item">Hire</button>
                                                        </form>
                                                    </li>
                                                    <li><hr class="dropdown-divider"></li>
                                                    <li>
                                                        <form action="{{ route('applications.status', $application) }}" method="POST" class="dropdown-item p-0">
                                                            @csrf
                                                            @method('PATCH')
                                                            <input type="hidden" name="status" value="rejected">
                                                            <button type="submit" class="dropdown-item text-danger">Reject</button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                        <!-- Cover Letter Modal -->
                                        <div class="modal fade" id="coverLetterModal{{ $application->id }}" tabindex="-1">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Cover Letter from {{ $application->jobSeeker->name }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="border rounded p-3 bg-light">
                                                            {!! nl2br(e($application->cover_letter)) !!}
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
            @else
                <div class="text-center py-5">
                    <i class="fas fa-file-alt fa-3x text-muted mb-3"></i>
                    <h4>No applications found</h4>
                    <p class="text-muted">Applications will appear here when candidates apply for your jobs.</p>
                    <a href="{{ route('jobs.create') }}" class="btn btn-primary">Post a Job</a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection