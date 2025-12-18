@extends('layouts.app')

@section('title', $openjob->title . ' - ' . config('app.name'))

@section('content')

<style>
/* ================= Job Details Page Design ================= */
.job-page .card {
    border: none;
    border-radius: 14px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.06);
}

.job-page h1,
.job-page h2,
.job-page h4,
.job-page h5 {
    font-weight: 600;
}

.job-page .badge {
    padding: 6px 14px;
    font-size: 13px;
    border-radius: 20px;
}

.job-meta p {
    margin-bottom: 8px;
    font-size: 14px;
    color: #555;
}

.job-meta i {
    color: #2563eb;
}

.job-description,
.requirements {
    font-size: 15px;
    line-height: 1.7;
    color: #444;
    background: #f9fafb;
    padding: 15px;
    border-radius: 10px;
}

.sidebar-card .card-header {
    background: #f8fafc;
    font-weight: 600;
}

.apply-btn {
    padding: 12px;
    font-size: 15px;
    border-radius: 10px;
}

.related-job-card {
    transition: all .3s ease;
}

.related-job-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 20px rgba(0,0,0,.08);
}

.quick-stats h5 {
    font-weight: 700;
    color: #2563eb;
}

.modal-content {
    border-radius: 16px;
}
</style>

<div class="container py-5 job-page">
    <div class="row">
        <!-- ================= LEFT CONTENT ================= -->
        <div class="col-lg-8">

            <!-- Job Details -->
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h1 class="h3 mb-2 text-primary">{{ $openjob->title }}</h1>
                            <h2 class="h6 text-muted">
                                {{ $openjob->employer->company_name ?? $openjob->employer->name }}
                            </h2>
                        </div>

                        <small class="text-muted">
                            <i class="fas fa-clock me-1"></i>
                            Posted {{ $openjob->created_at?->diffForHumans() }}
                        </small>

                        <!-- @if($openjob->status === 'approved')
                            <span class="badge bg-success">Approved</span>
                        @elseif($openjob->status === 'pending')
                            <span class="badge bg-warning">Pending</span>
                        @else
                            <span class="badge bg-danger">Rejected</span>
                        @endif -->
                    </div>

                    <div class="row mb-4 job-meta">
                        <div class="col-md-6">
                            <p><i class="fas fa-map-marker-alt me-2"></i>{{ $openjob->location }}</p>
                            <p><i class="fas fa-briefcase me-2"></i>{{ ucfirst(str_replace('_',' ',$openjob->job_type)) }}</p>
                            <p><i class="fas fa-layer-group me-2"></i>{{ $openjob->category }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><i class="fas fa-money-bill-wave me-2"></i>{{ $openjob->salary_range }}</p>
                            <p><i class="fas fa-users me-2"></i>{{ $openjob->vacancy }} Vacancy</p>
                            <p><i class="fas fa-calendar-alt me-2"></i>
                                {{ $openjob->deadline ? $openjob->deadline->format('F d, Y') : 'Not specified' }}
                            </p>
                        </div>
                    </div>

                    <div class="mb-4">
                        <h5>Job Description</h5>
                        <div class="job-description">
                            {!! nl2br(e($openjob->description)) !!}
                        </div>
                    </div>

                    <div class="mb-4">
                        <h5>Requirements</h5>
                        <div class="requirements">
                            {!! nl2br(e($openjob->requirements)) !!}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Related Jobs -->
            @if($relatedJobs->count())
            <div class="card">
                <div class="card-header bg-light">
                    <h5 class="mb-0">Related Jobs</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($relatedJobs as $job)
                        <div class="col-md-6 mb-3">
                            <div class="card h-100 related-job-card">
                                <div class="card-body">
                                    <h6>{{ $job->title }}</h6>
                                    <p class="small text-muted">
                                        <i class="fas fa-map-marker-alt me-1"></i>{{ $job->location }}<br>
                                        <i class="fas fa-money-bill-wave me-1"></i>{{ $job->salary_range }}
                                    </p>
                                    <a href="{{ route('jobs.show',$job) }}" class="btn btn-sm btn-outline-primary">
                                        View Job
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
        </div>

        <!-- ================= RIGHT SIDEBAR ================= -->
        <div class="col-lg-4">

            <!-- Company Info -->
            <div class="card mb-4 sidebar-card">
                <div class="card-header">
                    Company Information
                </div>
                <div class="card-body">
                    <h6>{{ $openjob->employer->company_name ?? 'N/A' }}</h6>
                    @if($openjob->employer->industry)
                        <p><i class="fas fa-industry me-2"></i>{{ $openjob->employer->industry }}</p>
                    @endif
                    @if($openjob->employer->website)
                        <p><i class="fas fa-globe me-2"></i>
                            <a href="{{ $openjob->employer->website }}" target="_blank">Website</a>
                        </p>
                    @endif
                </div>
            </div>

            @auth
                @if(auth()->user()->isJobSeeker())
                    <!-- Apply Section -->
                    <div class="card sidebar-card">
                        <div class="card-header">Apply for this Job</div>
                        <div class="card-body">
                            @if($hasApplied)
                                <div class="alert alert-info">You already applied.</div>
                                <a href="{{ route('applications.index') }}" class="btn btn-primary w-100">View Applications</a>
                            @else
                                <button class="btn btn-primary w-100 apply-btn" data-bs-toggle="modal" data-bs-target="#applyModal">
                                    <i class="fas fa-paper-plane me-2"></i>Apply Now
                                </button>
                            @endif
                        </div>
                    </div>
                @endif
            @endauth


            <!-- Quick Stats -->
            <div class="card mt-4 text-center">
                <div class="card-body quick-stats">
                    <div class="row">
                        <div class="col-6">
                            <h5>{{ $openjob->views }}</h5>
                            <small>Views</small>
                        </div>
                        <div class="col-6">
                            <h5>{{ $openjob->applications()->count() }}</h5>
                            <small>Applications</small>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
