@extends('layouts.app')

@section('title', 'Job Listings - ' . config('app.name'))

@section('content')
<div class="container py-5">
    <div class="row mb-4">
        <div class="col-md-3">
            <!-- Filters Sidebar -->
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0 text-center"><i class="fas fa-filter me-2"></i>Filters</h5>
                </div>
                <div class="card-body">
                    <form method="GET" action="{{ route('jobs.index') }}">
                        <div class="mb-3">
                            <label class="form-label">Category</label>
                            <select name="category" class="form-select">
                                <option value="">All Categories</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                                        {{ $category }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Location</label>
                            <select name="location" class="form-select">
                                <option value="">All Locations</option>
                                @foreach($locations as $location)
                                    <option value="{{ $location }}" {{ request('location') == $location ? 'selected' : '' }}>
                                        {{ $location }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Job Type</label>
                            <select name="job_type" class="form-select">
                                <option value="">All Types</option>
                                <option value="full_time" {{ request('job_type') == 'full_time' ? 'selected' : '' }}>Full Time</option>
                                <option value="part_time" {{ request('job_type') == 'part_time' ? 'selected' : '' }}>Part Time</option>
                                <option value="contract" {{ request('job_type') == 'contract' ? 'selected' : '' }}>Contract</option>
                                <option value="internship" {{ request('job_type') == 'internship' ? 'selected' : '' }}>Internship</option>
                                <option value="remote" {{ request('job_type') == 'remote' ? 'selected' : '' }}>Remote</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Sort By</label>
                            <select name="sort" class="form-select">
                                <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest First</option>
                                <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest First</option>
                                <option value="salary_high" {{ request('sort') == 'salary_high' ? 'selected' : '' }}>Salary (High to Low)</option>
                                <option value="salary_low" {{ request('sort') == 'salary_low' ? 'selected' : '' }}>Salary (Low to High)</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Apply Filters</button>
                        <a href="{{ route('jobs.index') }}" class="btn btn-outline-secondary w-100 mt-2">Clear Filters</a>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <!-- Job Listings -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0">Job Listings</h1>
                <div class="text-muted">
                    Showing {{ $jobs->firstItem() }} - {{ $jobs->lastItem() }} of {{ $jobs->total() }} jobs
                </div>
            </div>

            <!-- Search Box -->
            <form method="GET" action="{{ route('jobs.index') }}" class="mb-4">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search jobs..." value="{{ request('search') }}">
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>

            @forelse($jobs as $job)
                <div class="card job-card mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <h5 class="card-title">
                                    <a href="{{ route('jobs.show', $job) }}" class="text-decoration-none">{{ $job->title }}</a>
                                </h5>
                                <h6 class="card-subtitle mb-2 text-muted">
                                    {{ $job->employer->company_name ?? $job->employer->name }}
                                </h6>
                                <p class="card-text mb-2">
                                    <span class="me-3"><i class="fas fa-map-marker-alt me-1"></i> {{ $job->location }}</span>
                                    <span class="me-3"><i class="fas fa-briefcase me-1"></i> {{ ucfirst(str_replace('_', ' ', $job->job_type)) }}</span>
                                    <span><i class="fas fa-money-bill-wave me-1"></i> {{ $job->salary_range }}</span>
                                </p>
                                <div class="mb-2">
                                    <span class="badge bg-secondary me-1">{{ $job->category }}</span>
                                    <span class="badge bg-info">{{ $job->vacancy }} position(s)</span>
                                </div>
                            </div>
                            <div class="col-md-4 text-end">
                                <div class="mb-3">
                                    <small class="ms-3"><i class="fas fa-clock me-1"></i> 
                                        Posted 
                                        @if($job->created_at)
                                            {{ $job->created_at->diffForHumans() }}
                                        @else
                                            N/A
                                        @endif
                                    </small>
                                </div>
                                @if($job->deadline->isFuture())
                                    <div class="mb-2">
                                        <small class="text-muted">Apply before: {{ $job->deadline->format('M d, Y') }}</small>
                                    </div>
                                @else
                                    <span class="badge bg-danger">Expired</span>
                                @endif
                                <a href="{{ route('jobs.show', $job) }}" class="btn btn-primary">View Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="card">
                    <div class="card-body text-center py-5">
                        <i class="fas fa-search fa-3x text-muted mb-3"></i>
                        <h3>No jobs found</h3>
                        <p class="text-muted">Try adjusting your search filters</p>
                        <a href="{{ route('jobs.index') }}" class="btn btn-primary">Clear Filters</a>
                    </div>
                </div>
            @endforelse

            <!-- Pagination -->
            @if($jobs->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    {{ $jobs->withQueryString()->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection