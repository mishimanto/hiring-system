@extends('layouts.app')

@section('title', 'My Jobs - ' . config('app.name'))

@section('content')
<div class="container py-5">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h2">My Job Postings</h1>
                <a href="{{ route('jobs.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Post New Job
                </a>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">My Jobs</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="card shadow">
        <div class="card-header bg-white py-3">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="mb-0">All Jobs Posted</h5>
                </div>
                <div class="col-md-6">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search jobs..." id="searchInput">
                        <button class="btn btn-outline-secondary" type="button" id="searchButton">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            @if($jobs->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover" id="jobsTable">
                        <thead>
                            <tr>
                                <th>Job Title</th>
                                <th>Category</th>
                                <th>Location</th>
                                <th>Status</th>
                                <th>Applications</th>
                                <th>Deadline</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($jobs as $job)
                                <tr>
                                    <td>
                                        <a href="{{ route('jobs.show', $job) }}" class="text-decoration-none">
                                            {{ Str::limit($job->title, 40) }}
                                        </a>
                                    </td>
                                    <td>{{ $job->category }}</td>
                                    <td>{{ $job->location }}</td>
                                    <td>
                                        <span class="badge bg-{{ $job->status === 'approved' ? 'success' : ($job->status === 'pending' ? 'warning' : 'danger') }}">
                                            {{ ucfirst($job->status) }}
                                        </span>
                                        @if($job->is_active && $job->deadline->isFuture())
                                            <span class="badge bg-primary">Active</span>
                                        @else
                                            <span class="badge bg-secondary">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge bg-info">{{ $job->applications()->count() }}</span>
                                    </td>
                                    <td>{{ $job->deadline->format('M d, Y') }}</td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('jobs.show', $job) }}" class="btn btn-info" title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('jobs.edit', $job) }}" class="btn btn-warning" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('jobs.destroy', $job) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" title="Delete" 
                                                        onclick="return confirm('Are you sure you want to delete this job?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $jobs->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-briefcase fa-3x text-muted mb-3"></i>
                    <h4>No jobs posted yet</h4>
                    <p class="text-muted">Start by posting your first job opening.</p>
                    <a href="{{ route('jobs.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Post Your First Job
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        const searchButton = document.getElementById('searchButton');
        const tableRows = document.querySelectorAll('#jobsTable tbody tr');
        
        function searchJobs() {
            const searchTerm = searchInput.value.toLowerCase();
            
            tableRows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(searchTerm) ? '' : 'none';
            });
        }
        
        searchInput.addEventListener('keyup', searchJobs);
        searchButton.addEventListener('click', searchJobs);
    });
</script>
@endsection