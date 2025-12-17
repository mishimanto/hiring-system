@extends('layouts.app')

@section('title', 'Application Details - ' . config('app.name'))

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Application Details</h4>
                        <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5>Job Information</h5>
                            <p><strong>Title:</strong> {{ $application->job->title }}</p>
                            <p><strong>Company:</strong> {{ $application->job->employer->company_name ?? 'N/A' }}</p>
                            <p><strong>Location:</strong> {{ $application->job->location }}</p>
                            <p><strong>Job Type:</strong> {{ ucfirst(str_replace('_', ' ', $application->job->job_type)) }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5>Applicant Information</h5>
                            <p><strong>Name:</strong> {{ $application->jobSeeker->name }}</p>
                            <p><strong>Email:</strong> {{ $application->jobSeeker->email }}</p>
                            <p><strong>Phone:</strong> {{ $application->jobSeeker->phone ?? 'Not provided' }}</p>
                            <p><strong>Applied On:</strong> {{ $application->applied_at->format('M d, Y') }}</p>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-12">
                            <h5>Application Status</h5>
                            <div class="d-flex align-items-center">
                                @php
                                    $statusColors = [
                                        'pending' => 'warning',
                                        'reviewed' => 'info',
                                        'shortlisted' => 'primary',
                                        'hired' => 'success',
                                        'rejected' => 'danger'
                                    ];
                                @endphp
                                <span class="badge bg-{{ $statusColors[$application->status] }} me-3" style="font-size: 1rem;">
                                    {{ ucfirst($application->status) }}
                                </span>
                                
                                @if(auth()->user()->isEmployer() && $application->job->employer_id === auth()->id())
                                    <form action="{{ route('applications.status', $application) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <div class="input-group" style="width: 300px;">
                                            <select name="status" class="form-select" required>
                                                <option value="">Change Status</option>
                                                <option value="reviewed">Mark as Reviewed</option>
                                                <option value="shortlisted">Shortlist</option>
                                                <option value="hired">Hire</option>
                                                <option value="rejected">Reject</option>
                                            </select>
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-12">
                            <h5>Cover Letter</h5>
                            <div class="border rounded p-3 bg-light">
                                {!! nl2br(e($application->cover_letter)) !!}
                            </div>
                        </div>
                    </div>

                    @if($application->resume_path)
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <h5>Resume</h5>
                                <a href="{{ Storage::url($application->resume_path) }}" target="_blank" 
                                   class="btn btn-outline-primary">
                                    <i class="fas fa-file-download me-2"></i>Download Resume
                                </a>
                            </div>
                        </div>
                    @endif

                    @if(auth()->user()->isEmployer() && $application->job->employer_id === auth()->id())
                        <div class="row">
                            <div class="col-md-12">
                                <h5>Add Notes</h5>
                                <form action="{{ route('applications.status', $application) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <div class="mb-3">
                                        <textarea name="notes" class="form-control" rows="3" 
                                                  placeholder="Add private notes about this candidate...">{{ old('notes', $application->notes) }}</textarea>
                                    </div>
                                    <input type="hidden" name="status" value="{{ $application->status }}">
                                    <button type="submit" class="btn btn-primary">Save Notes</button>
                                </form>
                            </div>
                        </div>
                    @endif

                    @if($application->notes)
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <h5>Internal Notes</h5>
                                <div class="border rounded p-3 bg-light">
                                    {!! nl2br(e($application->notes)) !!}
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection