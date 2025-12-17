@extends('layouts.app')

@section('title', $user->name . ' - ' . config('app.name'))

@section('content')
<div class="container py-5">
    <!-- Profile Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-md-3 text-center">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=4e73df&color=fff&size=150&bold=true" 
                                 alt="Profile" class="rounded-circle shadow" width="150" height="150">
                        </div>
                        <div class="col-md-9">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h1 class="mb-1">{{ $user->name }}</h1>
                                    <h4 class="text-primary mb-3">{{ $profile->professional_title ?? 'Job Seeker' }}</h4>
                                    
                                    <div class="d-flex flex-wrap gap-3 mb-3">
                                        @if($profile->experience_level)
                                            <span class="badge bg-info">
                                                <i class="fas fa-chart-line me-1"></i>
                                                {{ ucfirst($profile->experience_level) }}
                                            </span>
                                        @endif
                                        
                                        @if($profile->preferred_location)
                                            <span class="badge bg-secondary">
                                                <i class="fas fa-map-marker-alt me-1"></i>
                                                {{ $profile->preferred_location }}
                                            </span>
                                        @endif
                                        
                                        @if($profile->job_type_preference)
                                            <span class="badge bg-success">
                                                <i class="fas fa-briefcase me-1"></i>
                                                {{ str_replace('_', ' ', ucfirst($profile->job_type_preference)) }}
                                            </span>
                                        @endif
                                    </div>
                                    
                                    <!-- Contact Info -->
                                    <div class="row g-3">
                                        @if($user->email)
                                            <div class="col-auto">
                                                <i class="fas fa-envelope text-muted me-2"></i>
                                                <span class="text-muted">{{ $user->email }}</span>
                                            </div>
                                        @endif
                                        
                                        @if($user->phone)
                                            <div class="col-auto">
                                                <i class="fas fa-phone text-muted me-2"></i>
                                                <span class="text-muted">{{ $user->phone }}</span>
                                            </div>
                                        @endif
                                        
                                        @if($profile->portfolio_website)
                                            <div class="col-auto">
                                                <i class="fas fa-globe text-muted me-2"></i>
                                                <a href="{{ $profile->portfolio_website }}" target="_blank" class="text-decoration-none">
                                                    Portfolio
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                
                                <!-- Action Buttons -->
                                <div class="d-flex gap-2">
                                    @if($profile->social_links)
                                        @if($profile->getSocialLink('linkedin'))
                                            <a href="{{ $profile->getSocialLink('linkedin') }}" target="_blank" 
                                               class="btn btn-outline-primary btn-sm">
                                                <i class="fab fa-linkedin"></i>
                                            </a>
                                        @endif
                                        
                                        @if($profile->getSocialLink('github'))
                                            <a href="{{ $profile->getSocialLink('github') }}" target="_blank" 
                                               class="btn btn-outline-dark btn-sm">
                                                <i class="fab fa-github"></i>
                                            </a>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <!-- Left Column -->
        <div class="col-lg-8">
            <!-- About Section -->
            @if($profile->summary)
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="mb-0">
                            <i class="fas fa-user me-2 text-primary"></i>
                            About
                        </h5>
                    </div>
                    <div class="card-body">
                        <p class="mb-0">{{ $profile->summary }}</p>
                    </div>
                </div>
            @endif
            
            <!-- Experience Section -->
            @if($user->experiences->count() > 0)
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="mb-0">
                            <i class="fas fa-briefcase me-2 text-success"></i>
                            Work Experience
                        </h5>
                    </div>
                    <div class="card-body">
                        @foreach($user->experiences as $experience)
                            <div class="border-start border-3 border-success ps-3 mb-4 pb-4 {{ !$loop->last ? 'border-bottom-0' : '' }}">
                                <h6 class="mb-1">{{ $experience->job_title }}</h6>
                                <p class="text-muted mb-1">{{ $experience->company_name }}</p>
                                <small class="text-muted d-block mb-2">
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
                                    <small class="text-muted d-block mb-2">
                                        <i class="fas fa-map-marker-alt me-1"></i>
                                        {{ $experience->location }}
                                    </small>
                                @endif
                                
                                @if($experience->description)
                                    <p class="mb-0 mt-2">{{ $experience->description }}</p>
                                @endif
                                
                                @if($experience->skills_used && count($experience->skills_used) > 0)
                                    <div class="mt-2">
                                        @foreach($experience->skills_used as $skill)
                                            <span class="badge bg-light text-dark border mb-1 me-1">{{ $skill }}</span>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
            
            <!-- Education Section -->
            @if($user->educations->count() > 0)
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="mb-0">
                            <i class="fas fa-graduation-cap me-2 text-info"></i>
                            Education
                        </h5>
                    </div>
                    <div class="card-body">
                        @foreach($user->educations as $education)
                            <div class="border-start border-3 border-info ps-3 mb-4 pb-4 {{ !$loop->last ? 'border-bottom-0' : '' }}">
                                <h6 class="mb-1">{{ $education->degree }}</h6>
                                <p class="text-muted mb-1">{{ $education->institution }}</p>
                                <small class="text-muted d-block mb-2">
                                    <i class="fas fa-calendar-alt me-1"></i>
                                    {{ $education->period }}
                                </small>
                                
                                @if($education->field_of_study)
                                    <small class="text-muted d-block mb-2">
                                        <i class="fas fa-book me-1"></i>
                                        {{ $education->field_of_study }}
                                    </small>
                                @endif
                                
                                @if($education->result)
                                    <small class="text-muted d-block mb-2">
                                        <i class="fas fa-star me-1"></i>
                                        Result: {{ $education->result }}
                                    </small>
                                @endif
                                
                                @if($education->description)
                                    <p class="mb-0 mt-2">{{ $education->description }}</p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
            
            <!-- Projects Section -->
            @if($user->projects->count() > 0)
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="mb-0">
                            <i class="fas fa-project-diagram me-2 text-warning"></i>
                            Projects
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach($user->projects as $project)
                                <div class="col-md-6 mb-4">
                                    <div class="card border h-100">
                                        <div class="card-body">
                                            <h6 class="card-title">{{ $project->project_name }}</h6>
                                            
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
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>
        
        <!-- Right Column -->
        <div class="col-lg-4">
            <!-- Skills Section -->
            @if($user->skills)
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="mb-0">
                            <i class="fas fa-code me-2 text-danger"></i>
                            Skills
                        </h5>
                    </div>
                    <div class="card-body">
                        @php
                            $skills = $user->getSkillsArray();
                        @endphp
                        @foreach($skills as $skill)
                            <span class="badge bg-light text-dark border mb-2 me-1 px-3 py-2">
                                {{ $skill }}
                            </span>
                        @endforeach
                    </div>
                </div>
            @endif
            
            <!-- Languages -->
            @if($profile->languages && count($profile->languages) > 0)
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="mb-0">
                            <i class="fas fa-language me-2 text-primary"></i>
                            Languages
                        </h5>
                    </div>
                    <div class="card-body">
                        @foreach($profile->languages as $language)
                            <div class="mb-2">
                                <span class="d-block">{{ $language }}</span>
                                <div class="progress" style="height: 5px;">
                                    <div class="progress-bar bg-primary" style="width: 90%"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
            
            <!-- Certifications -->
            @if($user->certifications->count() > 0)
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="mb-0">
                            <i class="fas fa-certificate me-2 text-warning"></i>
                            Certifications
                        </h5>
                    </div>
                    <div class="card-body">
                        @foreach($user->certifications as $certification)
                            <div class="border-start border-3 border-warning ps-2 mb-3">
                                <h6 class="mb-1">{{ $certification->certification_name }}</h6>
                                <small class="text-muted d-block">{{ $certification->issuing_organization }}</small>
                                <small class="text-muted">
                                    Issued: {{ $certification->issue_date->format('M Y') }}
                                </small>
                                @if($certification->is_valid)
                                    <span class="badge bg-success mt-1 small">
                                        <i class="fas fa-check me-1"></i> Valid
                                    </span>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
            
            <!-- Contact Card -->
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="mb-0">
                        <i class="fas fa-id-card me-2 text-info"></i>
                        Contact Information
                    </h5>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled mb-0">
                        @if($user->email)
                            <li class="mb-3">
                                <i class="fas fa-envelope text-muted me-2"></i>
                                <a href="mailto:{{ $user->email }}" class="text-decoration-none">
                                    {{ $user->email }}
                                </a>
                            </li>
                        @endif
                        
                        @if($user->phone)
                            <li class="mb-3">
                                <i class="fas fa-phone text-muted me-2"></i>
                                <span>{{ $user->phone }}</span>
                            </li>
                        @endif
                        
                        @if($profile->portfolio_website)
                            <li class="mb-3">
                                <i class="fas fa-globe text-muted me-2"></i>
                                <a href="{{ $profile->portfolio_website }}" target="_blank" class="text-decoration-none">
                                    Portfolio Website
                                </a>
                            </li>
                        @endif
                        
                        @if($profile->social_links)
                            @if($profile->getSocialLink('linkedin'))
                                <li class="mb-3">
                                    <i class="fab fa-linkedin text-muted me-2"></i>
                                    <a href="{{ $profile->getSocialLink('linkedin') }}" target="_blank" class="text-decoration-none">
                                        LinkedIn Profile
                                    </a>
                                </li>
                            @endif
                            
                            @if($profile->getSocialLink('github'))
                                <li class="mb-3">
                                    <i class="fab fa-github text-muted me-2"></i>
                                    <a href="{{ $profile->getSocialLink('github') }}" target="_blank" class="text-decoration-none">
                                        GitHub Profile
                                    </a>
                                </li>
                            @endif
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .border-start {
        border-left-width: 4px !important;
    }
    .card {
        border-radius: 10px;
        overflow: hidden;
    }
    .badge {
        font-weight: 500;
        font-size: 0.85rem;
    }
    .progress {
        background-color: #e9ecef;
    }
</style>
@endpush
@endsection