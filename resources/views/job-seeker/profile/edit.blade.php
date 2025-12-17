@extends('layouts.app')

@section('title', 'Edit Profile - ' . config('app.name'))

@section('content')
<div class="container py-5">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h2 mb-1">Edit Profile</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('job-seeker.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Profile</li>
                        </ol>
                    </nav>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('job-seeker.dashboard') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Back to Dashboard
                    </a>
                    <a href="{{ route('profile.edit') }}" class="btn btn-outline-primary">
                        <i class="fas fa-cog me-1"></i> Account Settings
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Profile Completion Alert -->
    @if($profile->profile_completion < 70)
    <div class="alert alert-info mb-4">
        <div class="d-flex align-items-center">
            <div class="flex-grow-1">
                <h5 class="alert-heading mb-1">
                    <i class="fas fa-chart-line me-2"></i>
                    Complete Your Profile ({{ $profile->profile_completion }}%)
                </h5>
                <p class="mb-0">Complete your profile to increase your chances of getting hired by 65%.</p>
            </div>
            <div class="progress flex-shrink-0" style="width: 200px; height: 20px;">
                <div class="progress-bar bg-primary" role="progressbar" 
                     style="width: {{ $profile->profile_completion }}%;" 
                     aria-valuenow="{{ $profile->profile_completion }}" 
                     aria-valuemin="0" 
                     aria-valuemax="100">
                </div>
            </div>
        </div>
    </div>
    @endif
    
    <div class="row">
        <!-- Left Navigation -->
        <div class="col-lg-3 mb-4">
            <div class="card shadow-sm border-0 sticky-top" style="top: 20px; z-index: 100;">
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        <a href="#basic-info" class="list-group-item list-group-item-action active" data-bs-toggle="list">
                            <i class="fas fa-user me-2"></i> Basic Information
                        </a>
                        <a href="#job-preferences" class="list-group-item list-group-item-action" data-bs-toggle="list">
                            <i class="fas fa-briefcase me-2"></i> Job Preferences
                        </a>
                        <a href="#education" class="list-group-item list-group-item-action" data-bs-toggle="list">
                            <i class="fas fa-graduation-cap me-2"></i> Education
                        </a>
                        <a href="#experience" class="list-group-item list-group-item-action" data-bs-toggle="list">
                            <i class="fas fa-history me-2"></i> Experience
                        </a>
                        <a href="#projects" class="list-group-item list-group-item-action" data-bs-toggle="list">
                            <i class="fas fa-project-diagram me-2"></i> Projects
                        </a>
                        <a href="#certifications" class="list-group-item list-group-item-action" data-bs-toggle="list">
                            <i class="fas fa-certificate me-2"></i> Certifications
                        </a>
                        <a href="#social-links" class="list-group-item list-group-item-action" data-bs-toggle="list">
                            <i class="fas fa-share-alt me-2"></i> Social Links
                        </a>
                        <a href="#visibility" class="list-group-item list-group-item-action" data-bs-toggle="list">
                            <i class="fas fa-eye me-2"></i> Visibility
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Quick Stats -->
            <div class="card shadow-sm border-0 mt-4">
                <div class="card-body">
                    <h6 class="mb-3">Profile Stats</h6>
                    <div class="list-group list-group-flush">
                        <div class="list-group-item d-flex justify-content-between align-items-center px-0 py-2 border-0">
                            <span class="text-muted">Education</span>
                            <span class="badge bg-primary rounded-pill">{{ $user->educations->count() }}</span>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center px-0 py-2 border-0">
                            <span class="text-muted">Experience</span>
                            <span class="badge bg-success rounded-pill">{{ $user->experiences->count() }}</span>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center px-0 py-2 border-0">
                            <span class="text-muted">Projects</span>
                            <span class="badge bg-info rounded-pill">{{ $user->projects->count() }}</span>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center px-0 py-2 border-0">
                            <span class="text-muted">Certifications</span>
                            <span class="badge bg-warning rounded-pill">{{ $user->certifications->count() }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Right Content -->
        <div class="col-lg-9">
            <div class="tab-content">
                <!-- Basic Information Tab -->
                <div class="tab-pane fade show active" id="basic-info">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white border-0 py-3">
                            <h5 class="mb-0">
                                <i class="fas fa-user text-primary me-2"></i>
                                Basic Information
                            </h5>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('job-seeker.profile.basic.update') }}" id="basic-info-form">
                                @csrf
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="professional_title" class="form-label">
                                            Professional Title <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" 
                                               class="form-control @error('professional_title') is-invalid @enderror" 
                                               id="professional_title" 
                                               name="professional_title" 
                                               value="{{ old('professional_title', $profile->professional_title) }}"
                                               placeholder="e.g. Senior Laravel Developer">
                                        @error('professional_title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted">What's your current role or desired position?</small>
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="experience_level" class="form-label">
                                            Experience Level
                                        </label>
                                        <select class="form-select @error('experience_level') is-invalid @enderror" 
                                                id="experience_level" 
                                                name="experience_level">
                                            <option value="">Select Level</option>
                                            <option value="fresher" {{ old('experience_level', $profile->experience_level) == 'fresher' ? 'selected' : '' }}>Fresher</option>
                                            <option value="junior" {{ old('experience_level', $profile->experience_level) == 'junior' ? 'selected' : '' }}>Junior (0-2 years)</option>
                                            <option value="mid" {{ old('experience_level', $profile->experience_level) == 'mid' ? 'selected' : '' }}>Mid (2-5 years)</option>
                                            <option value="senior" {{ old('experience_level', $profile->experience_level) == 'senior' ? 'selected' : '' }}>Senior (5+ years)</option>
                                        </select>
                                        @error('experience_level')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="summary" class="form-label">
                                        Professional Summary <span class="text-danger">*</span>
                                    </label>
                                    <textarea class="form-control @error('summary') is-invalid @enderror" 
                                              id="summary" 
                                              name="summary" 
                                              rows="5"
                                              placeholder="Write a brief summary about your professional background, skills, and career goals...">{{ old('summary', $profile->summary) }}</textarea>
                                    @error('summary')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Write 3-5 sentences that highlight your expertise</small>
                                    <div class="mt-1 text-end">
                                        <span id="summary-counter" class="text-muted">0 characters</span>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="date_of_birth" class="form-label">Date of Birth</label>
                                        <input type="date" 
                                               class="form-control @error('date_of_birth') is-invalid @enderror" 
                                               id="date_of_birth" 
                                               name="date_of_birth" 
                                               value="{{ old('date_of_birth', $profile->date_of_birth ? $profile->date_of_birth->format('Y-m-d') : '') }}">
                                        @error('date_of_birth')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="gender" class="form-label">Gender</label>
                                        <select class="form-select @error('gender') is-invalid @enderror" 
                                                id="gender" 
                                                name="gender">
                                            <option value="">Select Gender</option>
                                            <option value="male" {{ old('gender', $profile->gender) == 'male' ? 'selected' : '' }}>Male</option>
                                            <option value="female" {{ old('gender', $profile->gender) == 'female' ? 'selected' : '' }}>Female</option>
                                            <option value="other" {{ old('gender', $profile->gender) == 'other' ? 'selected' : '' }}>Other</option>
                                        </select>
                                        @error('gender')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="languages" class="form-label">Languages</label>
                                    <input type="text" 
                                           class="form-control @error('languages') is-invalid @enderror" 
                                           id="languages" 
                                           name="languages" 
                                           value="{{ old('languages', $profile->languages ? implode(', ', $profile->languages) : '') }}"
                                           placeholder="e.g. English, Bangla, Hindi">
                                    @error('languages')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Separate languages with commas</small>
                                </div>
                                
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary" id="save-basic-info">
                                        <i class="fas fa-save me-1"></i> Save Changes
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
                <!-- Job Preferences Tab -->
                <div class="tab-pane fade" id="job-preferences">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white border-0 py-3">
                            <h5 class="mb-0">
                                <i class="fas fa-briefcase text-success me-2"></i>
                                Job Preferences
                            </h5>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('job-seeker.profile.preferences.update') }}" id="preferences-form">
                                @csrf
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="preferred_job_title" class="form-label">
                                            Preferred Job Title
                                        </label>
                                        <input type="text" 
                                               class="form-control @error('preferred_job_title') is-invalid @enderror" 
                                               id="preferred_job_title" 
                                               name="preferred_job_title" 
                                               value="{{ old('preferred_job_title', $profile->preferred_job_title) }}"
                                               placeholder="e.g. Full Stack Developer">
                                        @error('preferred_job_title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="job_type_preference" class="form-label">
                                            Job Type Preference
                                        </label>
                                        <select class="form-select @error('job_type_preference') is-invalid @enderror" 
                                                id="job_type_preference" 
                                                name="job_type_preference">
                                            <option value="">Select Type</option>
                                            <option value="full_time" {{ old('job_type_preference', $profile->job_type_preference) == 'full_time' ? 'selected' : '' }}>Full Time</option>
                                            <option value="part_time" {{ old('job_type_preference', $profile->job_type_preference) == 'part_time' ? 'selected' : '' }}>Part Time</option>
                                            <option value="remote" {{ old('job_type_preference', $profile->job_type_preference) == 'remote' ? 'selected' : '' }}>Remote</option>
                                            <option value="hybrid" {{ old('job_type_preference', $profile->job_type_preference) == 'hybrid' ? 'selected' : '' }}>Hybrid</option>
                                        </select>
                                        @error('job_type_preference')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="expected_salary" class="form-label">
                                            Expected Salary
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-text">$</span>
                                            <input type="text" 
                                                   class="form-control @error('expected_salary') is-invalid @enderror" 
                                                   id="expected_salary" 
                                                   name="expected_salary" 
                                                   value="{{ old('expected_salary', $profile->expected_salary) }}"
                                                   placeholder="e.g. 50000-70000">
                                        </div>
                                        @error('expected_salary')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted">You can specify a range (e.g., 50000-70000)</small>
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="availability" class="form-label">
                                            Availability
                                        </label>
                                        <select class="form-select @error('availability') is-invalid @enderror" 
                                                id="availability" 
                                                name="availability">
                                            <option value="">Select Availability</option>
                                            <option value="immediate" {{ old('availability', $profile->availability) == 'immediate' ? 'selected' : '' }}>Immediately</option>
                                            <option value="notice_1_month" {{ old('availability', $profile->availability) == 'notice_1_month' ? 'selected' : '' }}>1 Month Notice</option>
                                            <option value="notice_2_months" {{ old('availability', $profile->availability) == 'notice_2_months' ? 'selected' : '' }}>2 Months Notice</option>
                                            <option value="notice_3_months" {{ old('availability', $profile->availability) == 'notice_3_months' ? 'selected' : '' }}>3 Months Notice</option>
                                        </select>
                                        @error('availability')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="preferred_location" class="form-label">
                                        Preferred Location
                                    </label>
                                    <input type="text" 
                                           class="form-control @error('preferred_location') is-invalid @enderror" 
                                           id="preferred_location" 
                                           name="preferred_location" 
                                           value="{{ old('preferred_location', $profile->preferred_location) }}"
                                           placeholder="e.g. Remote, Dhaka, Bangladesh">
                                    @error('preferred_location')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">You can specify multiple locations separated by commas</small>
                                </div>
                                
                                <div class="text-end">
                                    <button type="submit" class="btn btn-success" id="save-preferences">
                                        <i class="fas fa-save me-1"></i> Save Preferences
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
                <!-- Education Tab -->
                <div class="tab-pane fade" id="education">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white border-0 py-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">
                                    <i class="fas fa-graduation-cap text-info me-2"></i>
                                    Education
                                </h5>
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addEducationModal">
                                    <i class="fas fa-plus me-1"></i> Add Education
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            @if($user->educations->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Degree</th>
                                                <th>Institution</th>
                                                <th>Year</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($user->educations as $education)
                                                <tr>
                                                    <td>
                                                        <strong>{{ $education->degree }}</strong>
                                                        @if($education->field_of_study)
                                                            <br><small class="text-muted">{{ $education->field_of_study }}</small>
                                                        @endif
                                                    </td>
                                                    <td>{{ $education->institution }}</td>
                                                    <td>
                                                        {{ $education->start_year }}
                                                        @if($education->end_year)
                                                            - {{ $education->end_year }}
                                                        @elseif($education->is_current)
                                                            - Present
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($education->is_current)
                                                            <span class="badge bg-info">Current</span>
                                                        @else
                                                            <span class="badge bg-success">Completed</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="btn-group btn-group-sm">
                                                            <button type="button" class="btn btn-outline-primary edit-education-btn" 
                                                                    data-id="{{ $education->id }}"
                                                                    data-degree="{{ $education->degree }}"
                                                                    data-institution="{{ $education->institution }}"
                                                                    data-field="{{ $education->field_of_study }}"
                                                                    data-result="{{ $education->result }}"
                                                                    data-start-year="{{ $education->start_year }}"
                                                                    data-end-year="{{ $education->end_year }}"
                                                                    data-is-current="{{ $education->is_current }}"
                                                                    data-description="{{ $education->description }}">
                                                                <i class="fas fa-edit"></i>
                                                            </button>
                                                            <form method="POST" action="{{ route('job-seeker.education.destroy', $education) }}" class="d-inline delete-form">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-outline-danger delete-btn">
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
                            @else
                                <div class="text-center py-5">
                                    <i class="fas fa-graduation-cap fa-4x text-muted mb-3"></i>
                                    <h5>No Education Added</h5>
                                    <p class="text-muted">Add your educational background to improve your profile.</p>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addEducationModal">
                                        <i class="fas fa-plus me-1"></i> Add Your First Education
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                
                <!-- Experience Tab -->
                <div class="tab-pane fade" id="experience">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white border-0 py-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">
                                    <i class="fas fa-history text-success me-2"></i>
                                    Work Experience
                                </h5>
                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#addExperienceModal">
                                    <i class="fas fa-plus me-1"></i> Add Experience
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            @if($user->experiences->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Job Title</th>
                                                <th>Company</th>
                                                <th>Duration</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($user->experiences as $experience)
                                                <tr>
                                                    <td>
                                                        <strong>{{ $experience->job_title }}</strong>
                                                        @if($experience->employment_type)
                                                            <br><small class="text-muted">{{ str_replace('_', ' ', ucfirst($experience->employment_type)) }}</small>
                                                        @endif
                                                    </td>
                                                    <td>{{ $experience->company_name }}</td>
                                                    <td>
                                                        {{ $experience->start_date ? $experience->start_date->format('M Y') : '' }}
                                                        @if($experience->is_current)
                                                            - Present
                                                        @elseif($experience->end_date)
                                                            - {{ $experience->end_date->format('M Y') }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($experience->is_current)
                                                            <span class="badge bg-info">Current</span>
                                                        @else
                                                            <span class="badge bg-success">Completed</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="btn-group btn-group-sm">
                                                            <button type="button" class="btn btn-outline-success edit-experience-btn"
                                                                    data-id="{{ $experience->id }}"
                                                                    data-job-title="{{ $experience->job_title }}"
                                                                    data-company="{{ $experience->company_name }}"
                                                                    data-employment-type="{{ $experience->employment_type }}"
                                                                    data-location="{{ $experience->location }}"
                                                                    data-start-date="{{ $experience->start_date ? $experience->start_date->format('Y-m-d') : '' }}"
                                                                    data-end-date="{{ $experience->end_date ? $experience->end_date->format('Y-m-d') : '' }}"
                                                                    data-is-current="{{ $experience->is_current }}"
                                                                    data-description="{{ $experience->description }}"
                                                                    data-skills="{{ $experience->skills_used ? implode(', ', $experience->skills_used) : '' }}">
                                                                <i class="fas fa-edit"></i>
                                                            </button>
                                                            <form method="POST" action="{{ route('job-seeker.experience.destroy', $experience) }}" class="d-inline delete-form">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-outline-danger delete-btn">
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
                            @else
                                <div class="text-center py-5">
                                    <i class="fas fa-briefcase fa-4x text-muted mb-3"></i>
                                    <h5>No Experience Added</h5>
                                    <p class="text-muted">Add your work experience to showcase your professional background.</p>
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addExperienceModal">
                                        <i class="fas fa-plus me-1"></i> Add Your First Experience
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                
                <!-- Projects Tab -->
                <div class="tab-pane fade" id="projects">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white border-0 py-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">
                                    <i class="fas fa-project-diagram text-info me-2"></i>
                                    Projects
                                </h5>
                                <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#addProjectModal">
                                    <i class="fas fa-plus me-1"></i> Add Project
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            @if($user->projects->count() > 0)
                                <div class="row">
                                    @foreach($user->projects as $project)
                                        <div class="col-md-6 mb-4">
                                            <div class="card border h-100">
                                                <div class="card-body">
                                                    <h5 class="card-title">{{ $project->project_name }}</h5>
                                                    
                                                    @if($project->description)
                                                        <p class="card-text text-muted small mb-3">
                                                            {{ Str::limit($project->description, 100) }}
                                                        </p>
                                                    @endif
                                                    
                                                    @if($project->technologies && count($project->technologies) > 0)
                                                        <div class="mb-3">
                                                            @foreach(array_slice($project->technologies, 0, 3) as $tech)
                                                                <span class="badge bg-light text-dark border mb-1 me-1 small">
                                                                    {{ $tech }}
                                                                </span>
                                                            @endforeach
                                                            @if(count($project->technologies) > 3)
                                                                <span class="badge bg-secondary mb-1 small">
                                                                    +{{ count($project->technologies) - 3 }} more
                                                                </span>
                                                            @endif
                                                        </div>
                                                    @endif
                                                    
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="d-flex gap-2">
                                                            @if($project->github_link)
                                                                <a href="{{ $project->github_link }}" target="_blank" 
                                                                   class="btn btn-sm btn-outline-dark">
                                                                    <i class="fab fa-github me-1"></i> Code
                                                                </a>
                                                            @endif
                                                            @if($project->live_link)
                                                                <a href="{{ $project->live_link }}" target="_blank" 
                                                                   class="btn btn-sm btn-outline-primary">
                                                                    <i class="fas fa-external-link-alt me-1"></i> Live
                                                                </a>
                                                            @endif
                                                        </div>
                                                        <div class="btn-group btn-group-sm">
                                                            <button type="button" class="btn btn-outline-info edit-project-btn"
                                                                    data-id="{{ $project->id }}"
                                                                    data-name="{{ $project->project_name }}"
                                                                    data-start-date="{{ $project->start_date ? $project->start_date->format('Y-m-d') : '' }}"
                                                                    data-end-date="{{ $project->end_date ? $project->end_date->format('Y-m-d') : '' }}"
                                                                    data-is-ongoing="{{ $project->is_ongoing }}"
                                                                    data-description="{{ $project->description }}"
                                                                    data-technologies="{{ $project->technologies ? implode(', ', $project->technologies) : '' }}"
                                                                    data-github="{{ $project->github_link }}"
                                                                    data-live="{{ $project->live_link }}">
                                                                <i class="fas fa-edit"></i>
                                                            </button>
                                                            <form method="POST" action="{{ route('job-seeker.project.destroy', $project) }}" class="d-inline delete-form">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-outline-danger delete-btn">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-5">
                                    <i class="fas fa-project-diagram fa-4x text-muted mb-3"></i>
                                    <h5>No Projects Added</h5>
                                    <p class="text-muted">Showcase your projects to demonstrate your skills and experience.</p>
                                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#addProjectModal">
                                        <i class="fas fa-plus me-1"></i> Add Your First Project
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                
                <!-- Certifications Tab -->
                <div class="tab-pane fade" id="certifications">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white border-0 py-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">
                                    <i class="fas fa-certificate text-warning me-2"></i>
                                    Certifications
                                </h5>
                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#addCertificationModal">
                                    <i class="fas fa-plus me-1"></i> Add Certification
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            @if($user->certifications->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Certification</th>
                                                <th>Organization</th>
                                                <th>Issue Date</th>
                                                <th>Expiry</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($user->certifications as $certification)
                                                <tr>
                                                    <td>
                                                        <strong>{{ $certification->certification_name }}</strong>
                                                        @if($certification->credential_id)
                                                            <br><small class="text-muted">ID: {{ $certification->credential_id }}</small>
                                                        @endif
                                                    </td>
                                                    <td>{{ $certification->issuing_organization }}</td>
                                                    <td>{{ $certification->issue_date->format('M Y') }}</td>
                                                    <td>
                                                        @if($certification->does_not_expire)
                                                            <span class="text-success">Never Expires</span>
                                                        @elseif($certification->expiration_date)
                                                            {{ $certification->expiration_date->format('M Y') }}
                                                        @else
                                                            <span class="text-muted">N/A</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($certification->is_valid)
                                                            <span class="badge bg-success">Valid</span>
                                                        @else
                                                            <span class="badge bg-danger">Expired</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="btn-group btn-group-sm">
                                                            @if($certification->credential_url)
                                                                <a href="{{ $certification->credential_url }}" target="_blank" class="btn btn-outline-primary">
                                                                    <i class="fas fa-external-link-alt"></i>
                                                                </a>
                                                            @endif
                                                            <button type="button" class="btn btn-outline-warning edit-certification-btn"
                                                                    data-id="{{ $certification->id }}"
                                                                    data-name="{{ $certification->certification_name }}"
                                                                    data-organization="{{ $certification->issuing_organization }}"
                                                                    data-credential-id="{{ $certification->credential_id }}"
                                                                    data-credential-url="{{ $certification->credential_url }}"
                                                                    data-issue-date="{{ $certification->issue_date->format('Y-m-d') }}"
                                                                    data-expiration-date="{{ $certification->expiration_date ? $certification->expiration_date->format('Y-m-d') : '' }}"
                                                                    data-does-not-expire="{{ $certification->does_not_expire }}"
                                                                    data-description="{{ $certification->description }}">
                                                                <i class="fas fa-edit"></i>
                                                            </button>
                                                            <form method="POST" action="{{ route('job-seeker.certification.destroy', $certification) }}" class="d-inline delete-form">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-outline-danger delete-btn">
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
                            @else
                                <div class="text-center py-5">
                                    <i class="fas fa-certificate fa-4x text-muted mb-3"></i>
                                    <h5>No Certifications Added</h5>
                                    <p class="text-muted">Add your certifications to showcase your qualifications and skills.</p>
                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#addCertificationModal">
                                        <i class="fas fa-plus me-1"></i> Add Your First Certification
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                
                <!-- Social Links Tab -->
                <div class="tab-pane fade" id="social-links">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white border-0 py-3">
                            <h5 class="mb-0">
                                <i class="fas fa-share-alt text-primary me-2"></i>
                                Social Links & Portfolio
                            </h5>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('job-seeker.profile.social.update') }}" id="social-form">
                                @csrf
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="linkedin" class="form-label">
                                            <i class="fab fa-linkedin text-primary me-2"></i>
                                            LinkedIn Profile
                                        </label>
                                        <input type="url" 
                                               class="form-control @error('linkedin') is-invalid @enderror" 
                                               id="linkedin" 
                                               name="linkedin" 
                                               value="{{ old('linkedin', $profile->getSocialLink('linkedin')) }}"
                                               placeholder="https://linkedin.com/in/yourprofile">
                                        @error('linkedin')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted">Add your LinkedIn profile URL</small>
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="github" class="form-label">
                                            <i class="fab fa-github text-dark me-2"></i>
                                            GitHub Profile
                                        </label>
                                        <input type="url" 
                                               class="form-control @error('github') is-invalid @enderror" 
                                               id="github" 
                                               name="github" 
                                               value="{{ old('github', $profile->getSocialLink('github')) }}"
                                               placeholder="https://github.com/username">
                                        @error('github')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted">Add your GitHub profile URL</small>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="portfolio" class="form-label">
                                            <i class="fas fa-briefcase text-info me-2"></i>
                                            Portfolio/Behance
                                        </label>
                                        <input type="url" 
                                               class="form-control @error('portfolio') is-invalid @enderror" 
                                               id="portfolio" 
                                               name="portfolio" 
                                               value="{{ old('portfolio', $profile->getSocialLink('portfolio')) }}"
                                               placeholder="https://behance.net/username">
                                        @error('portfolio')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted">Your design portfolio or Behance profile</small>
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="portfolio_website" class="form-label">
                                            <i class="fas fa-globe text-success me-2"></i>
                                            Personal Website
                                        </label>
                                        <input type="url" 
                                               class="form-control @error('portfolio_website') is-invalid @enderror" 
                                               id="portfolio_website" 
                                               name="portfolio_website" 
                                               value="{{ old('portfolio_website', $profile->portfolio_website) }}"
                                               placeholder="https://yourwebsite.com">
                                        @error('portfolio_website')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted">Your personal portfolio website</small>
                                    </div>
                                </div>
                                
                                <div class="alert alert-info">
                                    <h6><i class="fas fa-info-circle me-2"></i> Tips for Social Links</h6>
                                    <ul class="mb-0">
                                        <li>LinkedIn helps recruiters verify your professional background</li>
                                        <li>GitHub showcases your coding projects and contributions</li>
                                        <li>Portfolio websites demonstrate your work and skills</li>
                                        <li>Complete profiles get 40% more interview calls</li>
                                    </ul>
                                </div>
                                
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary" id="save-social">
                                        <i class="fas fa-save me-1"></i> Save Social Links
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
                <!-- Visibility Tab -->
                <div class="tab-pane fade" id="visibility">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white border-0 py-3">
                            <h5 class="mb-0">
                                <i class="fas fa-eye text-secondary me-2"></i>
                                Profile Visibility
                            </h5>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('job-seeker.profile.visibility.update') }}" id="visibility-form">
                                @csrf
                                
                                <div class="mb-4">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch" 
                                               id="is_public" name="is_public" 
                                               {{ $profile->is_public ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_public">
                                            <strong>Make Profile Public</strong>
                                        </label>
                                    </div>
                                    <div class="mt-2">
                                        <small class="text-muted">
                                            When enabled, your profile will be visible to employers and recruiters. 
                                            When disabled, only you can see your profile.
                                        </small>
                                    </div>
                                </div>
                                
                                <div class="card border mb-4">
                                    <div class="card-body">
                                        <h6 class="mb-3">
                                            <i class="fas fa-chart-bar me-2"></i>
                                            Visibility Statistics
                                        </h6>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="rounded-circle bg-primary bg-opacity-10 d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                                        <i class="fas fa-eye text-primary"></i>
                                                    </div>
                                                    <div>
                                                        <h5 class="mb-0">0</h5>
                                                        <small class="text-muted">Profile Views</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="rounded-circle bg-success bg-opacity-10 d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                                        <i class="fas fa-briefcase text-success"></i>
                                                    </div>
                                                    <div>
                                                        <h5 class="mb-0">0</h5>
                                                        <small class="text-muted">Job Views</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="alert alert-warning">
                                    <h6><i class="fas fa-exclamation-triangle me-2"></i> Privacy Notice</h6>
                                    <p class="mb-0">
                                        When your profile is public, the following information will be visible to employers:
                                        your name, professional title, summary, skills, education, experience, projects, 
                                        and certifications. Your contact information (email, phone) remains private.
                                    </p>
                                </div>
                                
                                <div class="text-end">
                                    <button type="submit" class="btn btn-secondary" id="save-visibility">
                                        <i class="fas fa-save me-1"></i> Update Visibility Settings
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Education Modal -->
<div class="modal fade" id="addEducationModal" tabindex="-1" aria-labelledby="addEducationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addEducationModalLabel">Add Education</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('job-seeker.education.store') }}" id="addEducationForm">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Degree *</label>
                            <input type="text" class="form-control" name="degree" required placeholder="e.g. Bachelor of Science">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Institution *</label>
                            <input type="text" class="form-control" name="institution" required placeholder="e.g. University of Dhaka">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Field of Study</label>
                            <input type="text" class="form-control" name="field_of_study" placeholder="e.g. Computer Science">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Result/GPA</label>
                            <input type="text" class="form-control" name="result" placeholder="e.g. 3.8/4.0">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Start Year *</label>
                            <input type="number" class="form-control" name="start_year" min="1900" max="{{ date('Y') + 5 }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">End Year</label>
                            <input type="number" class="form-control" name="end_year" min="1900" max="{{ date('Y') + 5 }}">
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="checkbox" name="is_current" id="addIsCurrent">
                                <label class="form-check-label" for="addIsCurrent">Currently Studying</label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="description" rows="3" placeholder="Additional details about your education..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Education</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Education Modal -->
<div class="modal fade" id="editEducationModal" tabindex="-1" aria-labelledby="editEducationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editEducationModalLabel">Edit Education</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="" id="editEducationForm">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" name="id" id="editEducationId">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Degree *</label>
                            <input type="text" class="form-control" name="degree" id="editDegree" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Institution *</label>
                            <input type="text" class="form-control" name="institution" id="editInstitution" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Field of Study</label>
                            <input type="text" class="form-control" name="field_of_study" id="editField">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Result/GPA</label>
                            <input type="text" class="form-control" name="result" id="editResult">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Start Year *</label>
                            <input type="number" class="form-control" name="start_year" id="editStartYear" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">End Year</label>
                            <input type="number" class="form-control" name="end_year" id="editEndYear">
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="checkbox" name="is_current" id="editIsCurrent">
                                <label class="form-check-label" for="editIsCurrent">Currently Studying</label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="editDescription" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Education</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add Experience Modal -->
<div class="modal fade" id="addExperienceModal" tabindex="-1" aria-labelledby="addExperienceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addExperienceModalLabel">Add Work Experience</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('job-seeker.experience.store') }}" id="addExperienceForm">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Job Title *</label>
                            <input type="text" class="form-control" name="job_title" required placeholder="e.g. Senior Developer">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Company Name *</label>
                            <input type="text" class="form-control" name="company_name" required placeholder="e.g. Google Inc.">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Employment Type</label>
                            <select class="form-select" name="employment_type">
                                <option value="">Select Type</option>
                                <option value="full_time">Full Time</option>
                                <option value="part_time">Part Time</option>
                                <option value="contract">Contract</option>
                                <option value="internship">Internship</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Location</label>
                            <input type="text" class="form-control" name="location" placeholder="e.g. Remote, Dhaka">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Start Date *</label>
                            <input type="date" class="form-control" name="start_date" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">End Date</label>
                            <input type="date" class="form-control" name="end_date" id="addExpEndDate">
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="checkbox" name="is_current" id="addIsCurrentExp">
                                <label class="form-check-label" for="addIsCurrentExp">Currently Working Here</label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="description" rows="4" placeholder="Describe your responsibilities, achievements, and key contributions..."></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Skills Used</label>
                        <input type="text" class="form-control" name="skills_used" placeholder="e.g. Laravel, PHP, MySQL, JavaScript">
                        <small class="text-muted">Separate skills with commas</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Save Experience</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Experience Modal -->
<div class="modal fade" id="editExperienceModal" tabindex="-1" aria-labelledby="editExperienceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editExperienceModalLabel">Edit Work Experience</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="" id="editExperienceForm">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" name="id" id="editExperienceId">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Job Title *</label>
                            <input type="text" class="form-control" name="job_title" id="editJobTitle" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Company Name *</label>
                            <input type="text" class="form-control" name="company_name" id="editCompany" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Employment Type</label>
                            <select class="form-select" name="employment_type" id="editEmploymentType">
                                <option value="">Select Type</option>
                                <option value="full_time">Full Time</option>
                                <option value="part_time">Part Time</option>
                                <option value="contract">Contract</option>
                                <option value="internship">Internship</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Location</label>
                            <input type="text" class="form-control" name="location" id="editLocation">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Start Date *</label>
                            <input type="date" class="form-control" name="start_date" id="editStartDate" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">End Date</label>
                            <input type="date" class="form-control" name="end_date" id="editEndDate">
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="checkbox" name="is_current" id="editIsCurrentExp">
                                <label class="form-check-label" for="editIsCurrentExp">Currently Working Here</label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="editExpDescription" rows="4"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Skills Used</label>
                        <input type="text" class="form-control" name="skills_used" id="editSkills">
                        <small class="text-muted">Separate skills with commas</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Update Experience</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add Project Modal -->
<div class="modal fade" id="addProjectModal" tabindex="-1" aria-labelledby="addProjectModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProjectModalLabel">Add Project</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('job-seeker.project.store') }}" id="addProjectForm">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Project Name *</label>
                            <input type="text" class="form-control" name="project_name" required placeholder="e.g. E-commerce Website">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Start Date</label>
                            <input type="date" class="form-control" name="start_date">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">End Date</label>
                            <input type="date" class="form-control" name="end_date" id="addProjEndDate">
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="checkbox" name="is_ongoing" id="addIsOngoing">
                                <label class="form-check-label" for="addIsOngoing">Ongoing Project</label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description *</label>
                        <textarea class="form-control" name="description" rows="4" required placeholder="Describe your project, features, technologies used, and your role..."></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Technologies Used *</label>
                            <input type="text" class="form-control" name="technologies" required placeholder="e.g. Laravel, React, MySQL, Tailwind CSS">
                            <small class="text-muted">Separate technologies with commas</small>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">GitHub Link</label>
                            <input type="url" class="form-control" name="github_link" placeholder="https://github.com/username/project">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Live Demo Link</label>
                        <input type="url" class="form-control" name="live_link" placeholder="https://yourproject.com">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-info">Save Project</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Project Modal -->
<div class="modal fade" id="editProjectModal" tabindex="-1" aria-labelledby="editProjectModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProjectModalLabel">Edit Project</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="" id="editProjectForm">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" name="id" id="editProjectId">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Project Name *</label>
                            <input type="text" class="form-control" name="project_name" id="editProjectName" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Start Date</label>
                            <input type="date" class="form-control" name="start_date" id="editProjStartDate">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">End Date</label>
                            <input type="date" class="form-control" name="end_date" id="editProjEndDate">
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="checkbox" name="is_ongoing" id="editIsOngoing">
                                <label class="form-check-label" for="editIsOngoing">Ongoing Project</label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description *</label>
                        <textarea class="form-control" name="description" id="editProjDescription" rows="4" required></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Technologies Used *</label>
                            <input type="text" class="form-control" name="technologies" id="editTechnologies" required>
                            <small class="text-muted">Separate technologies with commas</small>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">GitHub Link</label>
                            <input type="url" class="form-control" name="github_link" id="editGithub">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Live Demo Link</label>
                        <input type="url" class="form-control" name="live_link" id="editLiveLink">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-info">Update Project</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add Certification Modal -->
<div class="modal fade" id="addCertificationModal" tabindex="-1" aria-labelledby="addCertificationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCertificationModalLabel">Add Certification</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('job-seeker.certification.store') }}" id="addCertificationForm">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Certification Name *</label>
                        <input type="text" class="form-control" name="certification_name" required placeholder="e.g. AWS Certified Solutions Architect">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Issuing Organization *</label>
                        <input type="text" class="form-control" name="issuing_organization" required placeholder="e.g. Amazon Web Services">
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Credential ID</label>
                            <input type="text" class="form-control" name="credential_id" placeholder="e.g. ABC123XYZ">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Credential URL</label>
                            <input type="url" class="form-control" name="credential_url" placeholder="https://certificate.url">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Issue Date *</label>
                            <input type="date" class="form-control" name="issue_date" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Expiration Date</label>
                            <input type="date" class="form-control" name="expiration_date" id="addCertExpiryDate">
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="checkbox" name="does_not_expire" id="addDoesNotExpire">
                                <label class="form-check-label" for="addDoesNotExpire">Does Not Expire</label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="description" rows="3" placeholder="Additional details about the certification..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-warning">Save Certification</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Certification Modal -->
<div class="modal fade" id="editCertificationModal" tabindex="-1" aria-labelledby="editCertificationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCertificationModalLabel">Edit Certification</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="" id="editCertificationForm">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" name="id" id="editCertificationId">
                    <div class="mb-3">
                        <label class="form-label">Certification Name *</label>
                        <input type="text" class="form-control" name="certification_name" id="editCertName" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Issuing Organization *</label>
                        <input type="text" class="form-control" name="issuing_organization" id="editOrganization" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Credential ID</label>
                            <input type="text" class="form-control" name="credential_id" id="editCredentialId">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Credential URL</label>
                            <input type="url" class="form-control" name="credential_url" id="editCredentialUrl">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Issue Date *</label>
                            <input type="date" class="form-control" name="issue_date" id="editIssueDate" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Expiration Date</label>
                            <input type="date" class="form-control" name="expiration_date" id="editExpirationDate">
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="checkbox" name="does_not_expire" id="editDoesNotExpire">
                                <label class="form-check-label" for="editDoesNotExpire">Does Not Expire</label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="editCertDescription" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-warning">Update Certification</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('styles')
<style>
    .list-group-item.active {
        background-color: #4e73df;
        border-color: #4e73df;
    }
    .tab-pane {
        animation: fadeIn 0.3s;
    }
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    .card {
        transition: transform 0.2s;
    }
    .card:hover {
        transform: translateY(-2px);
    }
    .badge {
        font-weight: 500;
    }
    .form-check-input:checked {
        background-color: #4e73df;
        border-color: #4e73df;
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Character counter for summary
    const summaryField = document.getElementById('summary');
    const counter = document.getElementById('summary-counter');
    
    if (summaryField && counter) {
        function updateCounter() {
            const length = summaryField.value.length;
            counter.textContent = length + ' characters';
            
            if (length < 100) {
                counter.classList.add('text-danger');
                counter.classList.remove('text-success');
            } else if (length > 1000) {
                counter.classList.add('text-danger');
                counter.classList.remove('text-success');
            } else {
                counter.classList.add('text-success');
                counter.classList.remove('text-danger');
            }
        }
        
        summaryField.addEventListener('input', updateCounter);
        updateCounter();
    }
    
    // Tab navigation
    const tabLinks = document.querySelectorAll('[data-bs-toggle="list"]');
    const urlHash = window.location.hash.substring(1);
    let activeTab = 'basic-info';
    
    // Parse hash for tab
    if (urlHash.includes('tab=')) {
        const params = new URLSearchParams(urlHash);
        activeTab = params.get('tab') || 'basic-info';
    } else if (urlHash) {
        activeTab = urlHash;
    }
    
    tabLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const tabId = this.getAttribute('href').substring(1);
            window.location.hash = tabId;
            // Activate the tab
            const bsTab = new bootstrap.Tab(this);
            bsTab.show();
        });
    });
    
    // Initialize active tab from hash
    if (activeTab) {
        const activeTabLink = document.querySelector(`[href="#${activeTab}"]`);
        if (activeTabLink) {
            const bsTab = new bootstrap.Tab(activeTabLink);
            bsTab.show();
        }
    }
    
    // Education modal editing
    const editEducationButtons = document.querySelectorAll('.edit-education-btn');
    editEducationButtons.forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const degree = this.getAttribute('data-degree');
            const institution = this.getAttribute('data-institution');
            const field = this.getAttribute('data-field');
            const result = this.getAttribute('data-result');
            const startYear = this.getAttribute('data-start-year');
            const endYear = this.getAttribute('data-end-year');
            const isCurrent = this.getAttribute('data-is-current') === '1';
            const description = this.getAttribute('data-description');
            
            // Set form values
            document.getElementById('editEducationId').value = id;
            document.getElementById('editDegree').value = degree || '';
            document.getElementById('editInstitution').value = institution || '';
            document.getElementById('editField').value = field || '';
            document.getElementById('editResult').value = result || '';
            document.getElementById('editStartYear').value = startYear || '';
            document.getElementById('editEndYear').value = endYear || '';
            document.getElementById('editIsCurrent').checked = isCurrent;
            document.getElementById('editDescription').value = description || '';
            
            // Update form action
            const form = document.getElementById('editEducationForm');
            form.action = `/profile/education/${id}`;
            
            // Show modal
            const modal = new bootstrap.Modal(document.getElementById('editEducationModal'));
            modal.show();
        });
    });
    
    // Experience modal editing
    const editExperienceButtons = document.querySelectorAll('.edit-experience-btn');
    editExperienceButtons.forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const jobTitle = this.getAttribute('data-job-title');
            const company = this.getAttribute('data-company');
            const employmentType = this.getAttribute('data-employment-type');
            const location = this.getAttribute('data-location');
            const startDate = this.getAttribute('data-start-date');
            const endDate = this.getAttribute('data-end-date');
            const isCurrent = this.getAttribute('data-is-current') === '1';
            const description = this.getAttribute('data-description');
            const skills = this.getAttribute('data-skills');
            
            // Set form values
            document.getElementById('editExperienceId').value = id;
            document.getElementById('editJobTitle').value = jobTitle || '';
            document.getElementById('editCompany').value = company || '';
            document.getElementById('editEmploymentType').value = employmentType || '';
            document.getElementById('editLocation').value = location || '';
            document.getElementById('editStartDate').value = startDate || '';
            document.getElementById('editEndDate').value = endDate || '';
            document.getElementById('editIsCurrentExp').checked = isCurrent;
            document.getElementById('editExpDescription').value = description || '';
            document.getElementById('editSkills').value = skills || '';
            
            // Handle isCurrent checkbox
            if (isCurrent) {
                document.getElementById('editEndDate').disabled = true;
            }
            
            // Update form action
            const form = document.getElementById('editExperienceForm');
            form.action = `/profile/experience/${id}`;
            
            // Show modal
            const modal = new bootstrap.Modal(document.getElementById('editExperienceModal'));
            modal.show();
        });
    });
    
    // Project modal editing
    const editProjectButtons = document.querySelectorAll('.edit-project-btn');
    editProjectButtons.forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const name = this.getAttribute('data-name');
            const startDate = this.getAttribute('data-start-date');
            const endDate = this.getAttribute('data-end-date');
            const isOngoing = this.getAttribute('data-is-ongoing') === '1';
            const description = this.getAttribute('data-description');
            const technologies = this.getAttribute('data-technologies');
            const github = this.getAttribute('data-github');
            const live = this.getAttribute('data-live');
            
            // Set form values
            document.getElementById('editProjectId').value = id;
            document.getElementById('editProjectName').value = name || '';
            document.getElementById('editProjStartDate').value = startDate || '';
            document.getElementById('editProjEndDate').value = endDate || '';
            document.getElementById('editIsOngoing').checked = isOngoing;
            document.getElementById('editProjDescription').value = description || '';
            document.getElementById('editTechnologies').value = technologies || '';
            document.getElementById('editGithub').value = github || '';
            document.getElementById('editLiveLink').value = live || '';
            
            // Handle isOngoing checkbox
            if (isOngoing) {
                document.getElementById('editProjEndDate').disabled = true;
            }
            
            // Update form action
            const form = document.getElementById('editProjectForm');
            form.action = `/profile/project/${id}`;
            
            // Show modal
            const modal = new bootstrap.Modal(document.getElementById('editProjectModal'));
            modal.show();
        });
    });
    
    // Certification modal editing
    const editCertificationButtons = document.querySelectorAll('.edit-certification-btn');
    editCertificationButtons.forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const name = this.getAttribute('data-name');
            const organization = this.getAttribute('data-organization');
            const credentialId = this.getAttribute('data-credential-id');
            const credentialUrl = this.getAttribute('data-credential-url');
            const issueDate = this.getAttribute('data-issue-date');
            const expirationDate = this.getAttribute('data-expiration-date');
            const doesNotExpire = this.getAttribute('data-does-not-expire') === '1';
            const description = this.getAttribute('data-description');
            
            // Set form values
            document.getElementById('editCertificationId').value = id;
            document.getElementById('editCertName').value = name || '';
            document.getElementById('editOrganization').value = organization || '';
            document.getElementById('editCredentialId').value = credentialId || '';
            document.getElementById('editCredentialUrl').value = credentialUrl || '';
            document.getElementById('editIssueDate').value = issueDate || '';
            document.getElementById('editExpirationDate').value = expirationDate || '';
            document.getElementById('editDoesNotExpire').checked = doesNotExpire;
            document.getElementById('editCertDescription').value = description || '';
            
            // Handle doesNotExpire checkbox
            if (doesNotExpire) {
                document.getElementById('editExpirationDate').disabled = true;
            }
            
            // Update form action
            const form = document.getElementById('editCertificationForm');
            form.action = `/profile/certifications/${id}`;
            
            // Show modal
            const modal = new bootstrap.Modal(document.getElementById('editCertificationModal'));
            modal.show();
        });
    });
    
    // Handle add experience "currently working" checkbox
    const addIsCurrentExp = document.getElementById('addIsCurrentExp');
    const addExpEndDate = document.getElementById('addExpEndDate');
    
    if (addIsCurrentExp && addExpEndDate) {
        addIsCurrentExp.addEventListener('change', function() {
            addExpEndDate.disabled = this.checked;
            if (this.checked) {
                addExpEndDate.value = '';
            }
        });
    }
    
    // Handle add project "ongoing" checkbox
    const addIsOngoing = document.getElementById('addIsOngoing');
    const addProjEndDate = document.getElementById('addProjEndDate');
    
    if (addIsOngoing && addProjEndDate) {
        addIsOngoing.addEventListener('change', function() {
            addProjEndDate.disabled = this.checked;
            if (this.checked) {
                addProjEndDate.value = '';
            }
        });
    }
    
    // Handle add certification "does not expire" checkbox
    const addDoesNotExpire = document.getElementById('addDoesNotExpire');
    const addCertExpiryDate = document.getElementById('addCertExpiryDate');
    
    if (addDoesNotExpire && addCertExpiryDate) {
        addDoesNotExpire.addEventListener('change', function() {
            addCertExpiryDate.disabled = this.checked;
            if (this.checked) {
                addCertExpiryDate.value = '';
            }
        });
    }
    
    // Handle edit experience "currently working" checkbox
    const editIsCurrentExp = document.getElementById('editIsCurrentExp');
    const editEndDate = document.getElementById('editEndDate');
    
    if (editIsCurrentExp && editEndDate) {
        editIsCurrentExp.addEventListener('change', function() {
            editEndDate.disabled = this.checked;
            if (this.checked) {
                editEndDate.value = '';
            }
        });
    }
    
    // Handle edit project "ongoing" checkbox
    const editIsOngoing = document.getElementById('editIsOngoing');
    const editProjEndDate = document.getElementById('editProjEndDate');
    
    if (editIsOngoing && editProjEndDate) {
        editIsOngoing.addEventListener('change', function() {
            editProjEndDate.disabled = this.checked;
            if (this.checked) {
                editProjEndDate.value = '';
            }
        });
    }
    
    // Handle edit certification "does not expire" checkbox
    const editDoesNotExpire = document.getElementById('editDoesNotExpire');
    const editExpirationDate = document.getElementById('editExpirationDate');
    
    if (editDoesNotExpire && editExpirationDate) {
        editDoesNotExpire.addEventListener('change', function() {
            editExpirationDate.disabled = this.checked;
            if (this.checked) {
                editExpirationDate.value = '';
            }
        });
    }
    
    // Delete confirmation
    const deleteForms = document.querySelectorAll('.delete-form');
    deleteForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            if (!confirm('Are you sure you want to delete this item? This action cannot be undone.')) {
                e.preventDefault();
            }
        });
    });
    
    // Form validation
    const forms = document.querySelectorAll('form[id$="-form"]');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const requiredFields = form.querySelectorAll('[required]');
            let isValid = true;
            
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    field.classList.add('is-invalid');
                    isValid = false;
                } else {
                    field.classList.remove('is-invalid');
                }
            });
            
            if (!isValid) {
                e.preventDefault();
                // Scroll to first invalid field
                const firstInvalid = form.querySelector('.is-invalid');
                if (firstInvalid) {
                    firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    firstInvalid.focus();
                }
            }
        });
    });
    
    // Remove invalid class on input
    document.querySelectorAll('form input, form textarea, form select').forEach(input => {
        input.addEventListener('input', function() {
            this.classList.remove('is-invalid');
        });
    });
});
</script>
@endpush
@endsection