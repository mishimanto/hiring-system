@extends('layouts.app')

@section('title', 'Register - ' . config('app.name'))

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Role Selection -->
                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">I want to register as:</label>
                            <div class="col-md-6">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="role" id="role_job_seeker" 
                                           value="job_seeker" {{ old('role', request('role') == 'job_seeker' ? 'selected' : '') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="role_job_seeker">
                                        <i class="fas fa-user-tie me-1"></i> Job Seeker
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="role" id="role_employer" 
                                           value="employer" {{ old('role', request('role') == 'employer' ? 'selected' : '') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="role_employer">
                                        <i class="fas fa-building me-1"></i> Employer
                                    </label>
                                </div>
                                @error('role')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Basic Information -->
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }} *</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" 
                                       name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }} *</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                                       name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="phone" class="col-md-4 col-form-label text-md-end">{{ __('Phone') }}</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" 
                                       name="phone" value="{{ old('phone') }}">

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Employer Specific Fields -->
                        <div id="employer_fields" style="display: none;">
                            <div class="row mb-3">
                                <label for="company_name" class="col-md-4 col-form-label text-md-end">Company Name *</label>

                                <div class="col-md-6">
                                    <input id="company_name" type="text" class="form-control @error('company_name') is-invalid @enderror" 
                                           name="company_name" value="{{ old('company_name') }}">

                                    @error('company_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="industry" class="col-md-4 col-form-label text-md-end">Industry</label>

                                <div class="col-md-6">
                                    <input id="industry" type="text" class="form-control @error('industry') is-invalid @enderror" 
                                           name="industry" value="{{ old('industry') }}">

                                    @error('industry')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }} *</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                                       name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }} *</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" 
                                       name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>

                                <a class="btn btn-link" href="{{ route('login') }}">
                                    {{ __('Already have an account?') }}
                                </a>
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
        const employerFields = document.getElementById('employer_fields');
        const roleEmployer = document.getElementById('role_employer');
        const roleJobSeeker = document.getElementById('role_job_seeker');
        const companyNameInput = document.getElementById('company_name');

        function toggleEmployerFields() {
            if (roleEmployer.checked) {
                employerFields.style.display = 'block';
                companyNameInput.required = true;
            } else {
                employerFields.style.display = 'none';
                companyNameInput.required = false;
            }
        }

        // Initial check
        toggleEmployerFields();

        // Add event listeners
        roleEmployer.addEventListener('change', toggleEmployerFields);
        roleJobSeeker.addEventListener('change', toggleEmployerFields);
    });
</script>
@endsection