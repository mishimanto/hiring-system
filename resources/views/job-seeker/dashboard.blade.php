@extends('layouts.app')

@section('title', 'Job Seeker Dashboard - ' . config('app.name'))

@section('content')
<div class="container py-5">
    <div class="row">
        <!-- Left Sidebar - Profile Summary -->
        <div class="col-lg-3 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center p-4">
                    <!-- Profile Picture -->
                    <div class="mb-4">
                        <div class="position-relative d-inline-block">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=4e73df&color=fff&size=120&bold=true" 
                                 alt="Profile" class="rounded-circle shadow" width="120" height="120">
                            <span class="position-absolute bottom-0 end-0 bg-success rounded-circle p-2 border border-3 border-white">
                                <i class="fas fa-check text-white" style="font-size: 12px;"></i>
                            </span>
                        </div>
                    </div>
                    
                    <!-- Name and Title -->
                    <h4 class="mb-1">{{ Auth::user()->name }}</h4>
                    <p class="text-muted mb-3">
                        <i class="fas fa-briefcase me-1"></i>
                        {{ Auth::user()->jobSeekerProfile->professional_title ?? 'Job Seeker' }}
                    </p>
                    
                    <!-- Profile Completion -->
                    <div class="mb-4">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-sm text-muted">Profile Completion</span>
                            <span class="text-sm fw-bold">{{ Auth::user()->jobSeekerProfile->profile_completion ?? 0 }}%</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-gradient-primary" role="progressbar" 
                                 style="width: {{ Auth::user()->jobSeekerProfile->profile_completion ?? 0 }}%;" 
                                 aria-valuenow="{{ Auth::user()->jobSeekerProfile->profile_completion ?? 0 }}" 
                                 aria-valuemin="0" 
                                 aria-valuemax="100">
                            </div>
                        </div>
                        @if((Auth::user()->jobSeekerProfile->profile_completion ?? 0) < 70)
                            <small class="text-warning d-block mt-2">
                                <i class="fas fa-exclamation-circle me-1"></i>
                                Complete your profile for better job matches
                            </small>
                        @endif
                    </div>
                    
                    <!-- Quick Stats -->
                    <div class="list-group list-group-flush border-top">
                        <div class="list-group-item d-flex justify-content-between align-items-center px-0 py-2 border-0">
                            <span>
                                <i class="fas fa-file-alt text-primary me-2"></i>
                                Applications
                            </span>
                            <span class="badge bg-primary rounded-pill">{{ Auth::user()->applications()->count() }}</span>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center px-0 py-2 border-0">
                            <span>
                                <i class="fas fa-eye text-info me-2"></i>
                                Profile Views
                            </span>
                            <span class="badge bg-info rounded-pill">0</span>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center px-0 py-2 border-0">
                            <span>
                                <i class="fas fa-star text-warning me-2"></i>
                                Shortlisted
                            </span>
                            <span class="badge bg-warning rounded-pill">0</span>
                        </div>
                    </div>
                    
                    <!-- Quick Actions -->
                    <div class="mt-4">
                        <a href="{{ route('job-seeker.profile.edit') }}" class="btn btn-primary btn-sm w-100 mb-2">
                            <i class="fas fa-user-edit me-1"></i> Edit Profile
                        </a>
                        <a href="{{ route('jobs.index') }}" class="btn btn-outline-primary btn-sm w-100 mb-2">
                            <i class="fas fa-search me-1"></i> Find Jobs
                        </a>
                        <a href="{{ route('applications.index') }}" class="btn btn-outline-secondary btn-sm w-100">
                            <i class="fas fa-history me-1"></i> Applications
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Skills Card -->
            <div class="card shadow-sm border-0 mt-4">
                <div class="card-header bg-white border-0 py-3">
                    <h6 class="mb-0">
                        <i class="fas fa-code me-2 text-primary"></i>
                        Top Skills
                    </h6>
                </div>
                <div class="card-body">
                    @if(Auth::user()->skills)
                        @php
                            $skills = json_decode(Auth::user()->skills, true);
                            $skills = is_array($skills) ? array_slice($skills, 0, 8) : [];
                        @endphp
                        @foreach($skills as $skill)
                            <span class="badge bg-light text-dark border mb-2 me-1 px-3 py-2">
                                {{ $skill }}
                            </span>
                        @endforeach
                        @if(count($skills) === 0)
                            <p class="text-muted text-center mb-0">No skills added</p>
                        @endif
                    @else
                        <p class="text-muted text-center mb-0">No skills added</p>
                    @endif
                    <a href="{{ route('profile.edit') }}" class="btn btn-link btn-sm d-block mt-2">
                        <i class="fas fa-plus me-1"></i> Add More Skills
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="col-lg-9">
            <!-- Welcome Card -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h3 class="text-primary mb-2">Welcome back, {{ Auth::user()->name }}!</h3>
                            <p class="text-muted mb-0">
                                @if(Auth::user()->jobSeekerProfile && Auth::user()->jobSeekerProfile->summary)
                                    {{ Str::limit(Auth::user()->jobSeekerProfile->summary, 200) }}
                                @else
                                    Complete your profile to get personalized job recommendations and increase your chances of getting hired.
                                @endif
                            </p>
                        </div>
                        <div class="col-md-4 text-md-end mt-3 mt-md-0">
                            <div class="d-grid gap-2">
                                <a href="{{ route('jobs.index') }}" class="btn btn-primary btn-lg">
                                    <i class="fas fa-search me-2"></i> Browse Jobs
                                </a>
                                <a href="{{ route('job-seeker.profile.edit') }}" class="btn btn-outline-primary">
                                    <i class="fas fa-user-edit me-2"></i> Edit Profile
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Profile Sections -->
            <div class="row">
                <!-- Education -->
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center py-3">
                            <h5 class="mb-0">
                                <i class="fas fa-graduation-cap text-primary me-2"></i>
                                Education
                            </h5>
                            <a href="{{ route('job-seeker.profile.edit') }}" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-plus"></i>
                            </a>
                        </div>
                        <div class="card-body">
                            @if(Auth::user()->educations->count() > 0)
                                @foreach(Auth::user()->educations->take(2) as $education)
                                    <div class="border-start border-3 border-primary ps-3 mb-3">
                                        <h6 class="mb-1">{{ $education->degree }}</h6>
                                        <p class="text-muted mb-1">{{ $education->institution }}</p>
                                        <small class="text-muted">
                                            <i class="fas fa-calendar-alt me-1"></i>
                                            {{ $education->start_year }} - 
                                            {{ $education->is_current ? 'Present' : $education->end_year }}
                                        </small>
                                        @if($education->result)
                                            <div class="mt-1">
                                                <span class="badge bg-light text-dark">
                                                    Result: {{ $education->result }}
                                                </span>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                                @if(Auth::user()->educations->count() > 2)
                                    <div class="text-center">
                                        <a href="{{ route('job-seeker.profile.edit') }}" class="text-primary">
                                            +{{ Auth::user()->educations->count() - 2 }} more
                                        </a>
                                    </div>
                                @endif
                            @else
                                <div class="text-center py-4">
                                    <i class="fas fa-graduation-cap fa-3x text-muted mb-3"></i>
                                    <p class="text-muted mb-2">No education added yet</p>
                                    <a href="{{ route('job-seeker.profile.edit') }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-plus me-1"></i> Add Education
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                
                <!-- Experience -->
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center py-3">
                            <h5 class="mb-0">
                                <i class="fas fa-briefcase text-success me-2"></i>
                                Experience
                            </h5>
                            <a href="{{ route('job-seeker.profile.edit') }}" class="btn btn-sm btn-outline-success">
                                <i class="fas fa-plus"></i>
                            </a>
                        </div>
                        <div class="card-body">
                            @if(Auth::user()->experiences->count() > 0)
                                @foreach(Auth::user()->experiences->take(2) as $experience)
                                    <div class="border-start border-3 border-success ps-3 mb-3">
                                        <h6 class="mb-1">{{ $experience->job_title }}</h6>
                                        <p class="text-muted mb-1">{{ $experience->company_name }}</p>
                                        <small class="text-muted d-block">
                                            <i class="fas fa-calendar-alt me-1"></i>
                                            {{ $experience->period }}
                                            @if($experience->duration)
                                                <span class="ms-2">
                                                    <i class="fas fa-clock me-1"></i>
                                                    {{ $experience->duration }}
                                                </span>
                                            @endif
                                        </small>
                                        @if($experience->location)
                                            <small class="text-muted">
                                                <i class="fas fa-map-marker-alt me-1"></i>
                                                {{ $experience->location }}
                                            </small>
                                        @endif
                                    </div>
                                @endforeach
                                @if(Auth::user()->experiences->count() > 2)
                                    <div class="text-center">
                                        <a href="{{ route('job-seeker.profile.edit') }}" class="text-success">
                                            +{{ Auth::user()->experiences->count() - 2 }} more
                                        </a>
                                    </div>
                                @endif
                            @else
                                <div class="text-center py-4">
                                    <i class="fas fa-briefcase fa-3x text-muted mb-3"></i>
                                    <p class="text-muted mb-2">No experience added yet</p>
                                    <a href="{{ route('job-seeker.profile.edit') }}" class="btn btn-sm btn-success">
                                        <i class="fas fa-plus me-1"></i> Add Experience
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                
                <!-- Projects -->
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center py-3">
                            <h5 class="mb-0">
                                <i class="fas fa-project-diagram text-info me-2"></i>
                                Projects
                            </h5>
                            <a href="{{ route('job-seeker.profile.edit') }}" class="btn btn-sm btn-outline-info">
                                <i class="fas fa-plus"></i>
                            </a>
                        </div>
                        <div class="card-body">
                            @if(Auth::user()->projects->count() > 0)
                                @foreach(Auth::user()->projects->take(2) as $project)
                                    <div class="border-start border-3 border-info ps-3 mb-3">
                                        <h6 class="mb-1">{{ $project->project_name }}</h6>
                                        @if($project->technologies && count($project->technologies) > 0)
                                            <div class="mb-2">
                                                @foreach(array_slice($project->technologies, 0, 3) as $tech)
                                                    <span class="badge bg-light text-dark border mb-1 me-1">
                                                        {{ $tech }}
                                                    </span>
                                                @endforeach
                                                @if(count($project->technologies) > 3)
                                                    <span class="badge bg-secondary mb-1">
                                                        +{{ count($project->technologies) - 3 }} more
                                                    </span>
                                                @endif
                                            </div>
                                        @endif
                                        <div class="d-flex gap-2 mt-2">
                                            @if($project->github_link)
                                                <a href="{{ $project->github_link }}" target="_blank" 
                                                   class="btn btn-sm btn-outline-dark">
                                                    <i class="fab fa-github me-1"></i> GitHub
                                                </a>
                                            @endif
                                            @if($project->live_link)
                                                <a href="{{ $project->live_link }}" target="_blank" 
                                                   class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-external-link-alt me-1"></i> Live Demo
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                                @if(Auth::user()->projects->count() > 2)
                                    <div class="text-center">
                                        <a href="{{ route('job-seeker.profile.edit') }}" class="text-info">
                                            +{{ Auth::user()->projects->count() - 2 }} more
                                        </a>
                                    </div>
                                @endif
                            @else
                                <div class="text-center py-4">
                                    <i class="fas fa-project-diagram fa-3x text-muted mb-3"></i>
                                    <p class="text-muted mb-2">No projects added yet</p>
                                    <a href="{{ route('job-seeker.profile.edit') }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-plus me-1"></i> Add Project
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                
                <!-- Certifications -->
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center py-3">
                            <h5 class="mb-0">
                                <i class="fas fa-certificate text-warning me-2"></i>
                                Certifications
                            </h5>
                            <a href="{{ route('job-seeker.profile.edit') }}" class="btn btn-sm btn-outline-warning">
                                <i class="fas fa-plus"></i>
                            </a>
                        </div>
                        <div class="card-body">
                            @if(Auth::user()->certifications->count() > 0)
                                @foreach(Auth::user()->certifications->take(2) as $certification)
                                    <div class="border-start border-3 border-warning ps-3 mb-3">
                                        <h6 class="mb-1">{{ $certification->certification_name }}</h6>
                                        <p class="text-muted mb-1">{{ $certification->issuing_organization }}</p>
                                        <small class="text-muted d-block">
                                            <i class="fas fa-calendar-alt me-1"></i>
                                            Issued: {{ $certification->issue_date->format('M Y') }}
                                            @if($certification->expiration_date && !$certification->does_not_expire)
                                                <span class="ms-2">
                                                    <i class="fas fa-calendar-times me-1"></i>
                                                    Expires: {{ $certification->expiration_date->format('M Y') }}
                                                </span>
                                            @endif
                                        </small>
                                        @if($certification->is_valid)
                                            <span class="badge bg-success mt-2">
                                                <i class="fas fa-check me-1"></i> Valid
                                            </span>
                                        @endif
                                    </div>
                                @endforeach
                                @if(Auth::user()->certifications->count() > 2)
                                    <div class="text-center">
                                        <a href="{{ route('job-seeker.profile.edit') }}" class="text-warning">
                                            +{{ Auth::user()->certifications->count() - 2 }} more
                                        </a>
                                    </div>
                                @endif
                            @else
                                <div class="text-center py-4">
                                    <i class="fas fa-certificate fa-3x text-muted mb-3"></i>
                                    <p class="text-muted mb-2">No certifications added yet</p>
                                    <a href="{{ route('job-seeker.profile.edit') }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-plus me-1"></i> Add Certification
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Quick Actions -->
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="mb-0">
                        <i class="fas fa-bolt text-danger me-2"></i>
                        Quick Actions
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-sm-6 col-md-3">
                            <a href="{{ route('profile.edit') }}" class="card h-100 border-0 shadow-sm text-decoration-none">
                                <div class="card-body text-center">
                                    <div class="rounded-circle bg-primary bg-opacity-10 d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                                        <i class="fas fa-file-alt text-primary fa-2x"></i>
                                    </div>
                                    <h6 class="mb-0">Update Resume</h6>
                                    <small class="text-muted">Upload your CV</small>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <a href="{{ route('jobs.index') }}" class="card h-100 border-0 shadow-sm text-decoration-none">
                                <div class="card-body text-center">
                                    <div class="rounded-circle bg-success bg-opacity-10 d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                                        <i class="fas fa-search text-success fa-2x"></i>
                                    </div>
                                    <h6 class="mb-0">Find Jobs</h6>
                                    <small class="text-muted">Browse opportunities</small>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <a href="{{ route('applications.index') }}" class="card h-100 border-0 shadow-sm text-decoration-none">
                                <div class="card-body text-center">
                                    <div class="rounded-circle bg-info bg-opacity-10 d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                                        <i class="fas fa-history text-info fa-2x"></i>
                                    </div>
                                    <h6 class="mb-0">Applications</h6>
                                    <small class="text-muted">View your applications</small>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <a href="{{ route('job-seeker.profile.edit') }}" class="card h-100 border-0 shadow-sm text-decoration-none">
                                <div class="card-body text-center">
                                    <div class="rounded-circle bg-warning bg-opacity-10 d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                                        <i class="fas fa-user-cog text-warning fa-2x"></i>
                                    </div>
                                    <h6 class="mb-0">Profile Settings</h6>
                                    <small class="text-muted">Manage profile</small>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .card {
        transition: transform 0.2s;
    }
    .card:hover {
        transform: translateY(-5px);
    }
    .progress-bar {
        border-radius: 10px;
    }
    .border-start {
        border-left-width: 4px !important;
    }
    .badge {
        font-weight: 500;
    }
    .btn-outline-primary:hover {
        background-color: #4e73df;
        color: white;
    }
    .bg-gradient-primary {
        background: linear-gradient(45deg, #4e73df, #224abe);
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Profile completion alert
    @if(Auth::user()->jobSeekerProfile && Auth::user()->jobSeekerProfile->profile_completion < 50)
        const alertHTML = `
            <div class="alert alert-warning alert-dismissible fade show shadow-sm mb-4" role="alert">
                <div class="d-flex align-items-center">
                    <i class="fas fa-exclamation-triangle fa-2x me-3"></i>
                    <div>
                        <h5 class="alert-heading mb-1">Complete Your Profile!</h5>
                        <p class="mb-0">
                            Your profile is only {{ Auth::user()->jobSeekerProfile->profile_completion }}% complete. 
                            Complete it to get 3x more job matches.
                            <a href="{{ route('job-seeker.profile.edit') }}" class="alert-link fw-bold">Complete Now →</a>
                        </p>
                    </div>
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
                </div>
            </div>
        `;
        
        // Insert at the beginning of main content
        document.querySelector('.col-lg-9').insertAdjacentHTML('afterbegin', alertHTML);
    @endif
    
    // Animate progress bar
    const progressBar = document.querySelector('.progress-bar');
    if (progressBar) {
        const width = progressBar.style.width;
        progressBar.style.width = '0%';
        setTimeout(() => {
            progressBar.style.width = width;
        }, 300);
    }
});
</script>
@endpush
@endsection