@extends('layouts.app')

@section('title', 'Post a Job - ' . config('app.name'))

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="p-2 text-center">Post a New Job</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('jobs.store') }}" method="POST">
                        @csrf
                        
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="title" class="form-label">Job Title *</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                    id="title" name="title" value="{{ old('title') }}" required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="description" class="form-label">Job Description *</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" 
                                        id="description" name="description" rows="5" required>{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="requirements" class="form-label">Requirements *</label>
                                <textarea class="form-control @error('requirements') is-invalid @enderror" 
                                        id="requirements" name="requirements" rows="5" required>{{ old('requirements') }}</textarea>
                                @error('requirements')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="category" class="form-label">Category *</label>
                                <select class="form-control @error('category') is-invalid @enderror" 
                                        id="category" name="category" required>
                                    <option value="">Select a category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category }}" 
                                                {{ old('category') == $category ? 'selected' : '' }}>
                                            {{ $category }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="location" class="form-label">Location *</label>
                                <input type="text" class="form-control @error('location') is-invalid @enderror" 
                                    id="location" name="location" value="{{ old('location') }}" required>
                                @error('location')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="job_type" class="form-label">Job Type *</label>
                                <select class="form-select @error('job_type') is-invalid @enderror" 
                                        id="job_type" name="job_type" required>
                                    <option value="">Select Job Type</option>
                                    <option value="full_time" {{ old('job_type') == 'full_time' ? 'selected' : '' }}>Full Time</option>
                                    <option value="part_time" {{ old('job_type') == 'part_time' ? 'selected' : '' }}>Part Time</option>
                                    <option value="contract" {{ old('job_type') == 'contract' ? 'selected' : '' }}>Contract</option>
                                    <option value="internship" {{ old('job_type') == 'internship' ? 'selected' : '' }}>Internship</option>
                                    <option value="remote" {{ old('job_type') == 'remote' ? 'selected' : '' }}>Remote</option>
                                </select>
                                @error('job_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="salary_type" class="form-label">Salary Type *</label>
                                <select class="form-select @error('salary_type') is-invalid @enderror" 
                                        id="salary_type" name="salary_type" required>
                                    <option value="monthly" {{ old('salary_type') == 'monthly' ? 'selected' : '' }}>Monthly</option>
                                    <option value="yearly" {{ old('salary_type') == 'yearly' ? 'selected' : '' }}>Yearly</option>
                                    <option value="hourly" {{ old('salary_type') == 'hourly' ? 'selected' : '' }}>Hourly</option>
                                </select>
                                @error('salary_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="salary_min" class="form-label">Minimum Salary</label>
                                <input type="number" class="form-control @error('salary_min') is-invalid @enderror" 
                                    id="salary_min" name="salary_min" value="{{ old('salary_min') }}" min="0" step="0.01">
                                @error('salary_min')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="salary_max" class="form-label">Maximum Salary</label>
                                <input type="number" class="form-control @error('salary_max') is-invalid @enderror" 
                                    id="salary_max" name="salary_max" value="{{ old('salary_max') }}" min="0" step="0.01">
                                @error('salary_max')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="deadline" class="form-label">Application Deadline *</label>
                                <input type="date" class="form-control @error('deadline') is-invalid @enderror" 
                                    id="deadline" name="deadline" value="{{ old('deadline') }}" required min="{{ date('Y-m-d') }}">
                                @error('deadline')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="vacancy" class="form-label">Number of Vacancies *</label>
                                <input type="number" class="form-control @error('vacancy') is-invalid @enderror" 
                                    id="vacancy" name="vacancy" value="{{ old('vacancy', 1) }}" min="1" required>
                                @error('vacancy')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">Post Job</button>
                                <a href="{{ route('jobs.my-jobs') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Set minimum date for deadline
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('deadline').min = today;
    });
</script>
@endsection