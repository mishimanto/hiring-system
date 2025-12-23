<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register - {{ config('app.name', 'Job Portal') }}</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #4dabf7;
            --secondary-color: #15aabf;
            --success-color: #40c057;
            --dark-color: #2b2d42;
            --light-color: #f8f9fa;
            --gray-color: #6c757d;
            --border-radius: 12px;
            --box-shadow: 0 8px 30px rgba(0,0,0,0.08);
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            color: var(--dark-color);
        }

        .register-container {
            width: 100%;
            max-width: 700px;
            margin: 0 auto;
        }

        .register-wrapper {
            display: flex;
            background: white;
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--box-shadow);
            min-height: auto;
        }

        /* Left Panel - Brand/Info */
        .register-left {
            flex: 1;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            padding: 50px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .register-left::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23ffffff' fill-opacity='0.1' fill-rule='evenodd'/%3E%3C/svg%3E");
            opacity: 0.1;
        }

        .brand-logo {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 40px;
        }

        .brand-logo i {
            font-size: 2.5rem;
            background: rgba(255, 255, 255, 0.2);
            padding: 15px;
            border-radius: 50%;
        }

        .brand-logo h1 {
            font-size: 1.8rem;
            font-weight: 700;
            margin: 0;
        }

        .welcome-text h2 {
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 15px;
            line-height: 1.3;
        }

        .welcome-text p {
            font-size: 1rem;
            opacity: 0.9;
            margin-bottom: 30px;
            line-height: 1.6;
        }

        .features-list {
            list-style: none;
            padding: 0;
            margin: 30px 0;
        }

        .features-list li {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            font-size: 0.95rem;
        }

        .features-list i {
            margin-right: 12px;
            background: rgba(255, 255, 255, 0.2);
            padding: 8px;
            border-radius: 50%;
            font-size: 0.9rem;
        }

        .testimonial {
            background: rgba(255, 255, 255, 0.15);
            padding: 20px;
            border-radius: var(--border-radius);
            margin-top: 30px;
            border-left: 4px solid white;
        }

        .testimonial p {
            font-style: italic;
            margin-bottom: 10px;
            font-size: 0.95rem;
        }

        .testimonial .author {
            font-weight: 600;
            font-size: 0.9rem;
        }

        /* Right Panel - Register Form */
        .register-right {
            flex: 1.2;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .register-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .register-header h2 {
            font-size: 2rem;
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 10px;
        }

        .register-header p {
            color: var(--gray-color);
            font-size: 1rem;
        }

        /* Form Styles */
        .register-form {
            width: 100%;
        }

        .form-group {
            margin-bottom: 20px;
            position: relative;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--dark-color);
            font-size: 0.95rem;
        }

        .form-label .required {
            color: #dc3545;
            margin-left: 4px;
        }

        .input-with-icon {
            position: relative;
        }

        .input-with-icon i {
            position: absolute;
            
            padding: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-color);
            font-size: 1.1rem;
        }

        /* Eye button inside input */
        .input-with-icon .password-eye {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-color);
            font-size: 1.1rem;
            cursor: pointer;
            background: none;
            border: none;
            padding: 0;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px 12px 45px;
            border: 2px solid #e9ecef;
            border-radius: var(--border-radius);
            font-size: 1rem;
            font-family: 'Poppins', sans-serif;
            transition: var(--transition);
            background-color: #fff;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(77, 171, 247, 0.2);
        }

        .form-control.is-invalid {
            border-color: #dc3545;
        }
        
        .invalid-feedback {
            display: block;
            margin-top: 5px;
            color: #dc3545;
            font-size: 0.85rem;
        }

        /* Role Selection */
        .role-selection {
            margin-bottom: 25px;
            padding: 20px;
            background: #f8f9fa;
            border-radius: var(--border-radius);
            border: 2px solid #e9ecef;
        }

        .role-selection h5 {
            margin-bottom: 15px;
            color: var(--dark-color);
            font-weight: 600;
        }

        .role-options {
            display: flex;
            gap: 20px;
        }

        .role-option {
            flex: 1;
            text-align: center;
        }

        .role-input {
            display: none;
        }

        .role-label {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 10px 10px;
            border: 2px solid #e9ecef;
            border-radius: var(--border-radius);
            cursor: pointer;
            transition: var(--transition);
            background: white;
        }

        .role-label:hover {
            border-color: var(--primary-color);
            background: rgba(77, 171, 247, 0.05);
        }

        .role-input:checked + .role-label {
            border-color: var(--primary-color);
            background: rgba(77, 171, 247, 0.1);
            box-shadow: 0 0 0 2px rgba(77, 171, 247, 0.2);
        }

        .role-icon {
            font-size: 2rem;
            margin-bottom: 10px;
            color: var(--gray-color);
            transition: var(--transition);
        }

        .role-input:checked + .role-label .role-icon {
            color: var(--primary-color);
        }

        .role-name {
            font-weight: 600;
            color: var(--dark-color);
        }

        .role-desc {
            font-size: 0.85rem;
            color: var(--gray-color);
        }

        /* Employer Fields */
        .employer-fields {
            background: #f8f9fa;
            padding: 20px;
            border-radius: var(--border-radius);
            border: 2px solid #e9ecef;
            margin: 20px 0;
            animation: slideDown 0.3s ease;
            display: none;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Submit Button */
        .btn-register {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            border: none;
            border-radius: var(--border-radius);
            font-size: 1.05rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            margin-top: 20px;
            font-family: 'Poppins', sans-serif;
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(77, 171, 247, 0.3);
        }

        .btn-register:active {
            transform: translateY(0);
        }

        /* Login Link */
        .login-link {
            text-align: center;
            margin-top: 25px;
            padding-top: 25px;
            border-top: 1px solid #e9ecef;
            color: var(--gray-color);
            font-size: 0.95rem;
        }

        .login-link a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            margin-left: 5px;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        /* Session Status */
        .session-status {
            padding: 15px;
            background: #d4edda;
            color: #155724;
            border-radius: var(--border-radius);
            margin-bottom: 25px;
            border-left: 4px solid #28a745;
            font-size: 0.95rem;
        }

        .session-status.error {
            background: #f8d7da;
            color: #721c24;
            border-left-color: #dc3545;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .register-wrapper {
                flex-direction: column;
            }
            
            .register-left, .register-right {
                padding: 40px 30px;
            }
            
            .role-options {
                flex-direction: column;
                gap: 10px;
            }
        }

        @media (max-width: 576px) {
            body {
                padding: 10px;
            }
            
            .register-container {
                max-width: 100%;
            }
            
            .register-left, .register-right {
                padding: 30px 20px;
            }
            
            .brand-logo h1 {
                font-size: 1.5rem;
            }
            
            .welcome-text h2 {
                font-size: 1.8rem;
            }
            
            .register-header h2 {
                font-size: 1.6rem;
            }
        }

        /* Animation */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .register-right {
            animation: fadeIn 0.6s ease-out;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-wrapper">
            
            <!-- Right Panel - Register Form -->
            <div class="register-right">
                <div class="register-header">
                    <h2>Create Account</h2>
                    <!-- <p>Fill in your details to get started</p> -->
                </div>
                
                <!-- Validation Errors -->
                @if ($errors->any())
                    <div class="session-status error">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif
                
                <form method="POST" action="{{ route('register') }}" class="register-form" id="registerForm">
                    @csrf

                    <!-- Role Selection -->
                    <div class="role-selection">
                        <h5 class="text-center mb-3">Register as:</h5>
                        <div class="role-options">
                            <div class="role-option">
                                <input class="role-input" type="radio" name="role" id="role_job_seeker" 
                                       value="job_seeker" {{ old('role', request('role') == 'job_seeker' ? 'selected' : '') ? 'checked' : '' }}>
                                <label class="role-label" for="role_job_seeker">
                                    <!-- <i class="fas fa-user-tie role-icon"></i> -->
                                    <span class="role-name">Job Seeker</span>
                                    <!-- <span class="role-desc">Find your dream job</span> -->
                                </label>
                            </div>
                            <div class="role-option">
                                <input class="role-input" type="radio" name="role" id="role_employer" 
                                       value="employer" {{ old('role', request('role') == 'employer' ? 'selected' : '') ? 'checked' : '' }}>
                                <label class="role-label" for="role_employer">
                                    <!-- <i class="fas fa-building role-icon"></i> -->
                                    <span class="role-name">Employer</span>
                                    <!-- <span class="role-desc">Post jobs & hire talent</span> -->
                                </label>
                            </div>
                        </div>
                        @error('role')
                            <div class="invalid-feedback d-block mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Basic Information -->
                    <div class="form-group">
                        <!-- <label class="form-label" for="name">
                            Full Name <span class="required">*</span>
                        </label> -->
                        <div class="input-with-icon">
                            <i class="fas fa-user"></i>
                            <input 
                                id="name" 
                                type="text" 
                                name="name" 
                                value="{{ old('name') }}" 
                                class="form-control @error('name') is-invalid @enderror" 
                                placeholder="Enter your full name" 
                                required 
                                autocomplete="name" 
                                autofocus
                            >
                        </div>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <!-- <label class="form-label" for="email">
                            Email Address <span class="required">*</span>
                        </label> -->
                        <div class="input-with-icon">
                            <i class="fas fa-envelope"></i>
                            <input 
                                id="email" 
                                type="email" 
                                name="email" 
                                value="{{ old('email') }}" 
                                class="form-control @error('email') is-invalid @enderror" 
                                placeholder="Enter your email address" 
                                required 
                                autocomplete="email"
                            >
                        </div>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <!-- <label class="form-label" for="phone">Phone Number</label> -->
                        <div class="input-with-icon">
                            <i class="fas fa-phone"></i>
                            <input 
                                id="phone" 
                                type="text" 
                                name="phone" 
                                value="{{ old('phone') }}" 
                                class="form-control @error('phone') is-invalid @enderror" 
                                placeholder="Enter your phone number"
                            >
                        </div>
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Employer Specific Fields -->
                    <div class="employer-fields" id="employerFields">
                        <div class="form-group">
                            <!-- <label class="form-label" for="company_name">
                                Company Name <span class="required">*</span>
                            </label> -->
                            <div class="input-with-icon">
                                <i class="fas fa-building"></i>
                                <input 
                                    id="company_name" 
                                    type="text" 
                                    name="company_name" 
                                    value="{{ old('company_name') }}" 
                                    class="form-control @error('company_name') is-invalid @enderror" 
                                    placeholder="Enter your company name"
                                >
                            </div>
                            @error('company_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <!-- <label class="form-label" for="industry">Industry</label> -->
                            <div class="input-with-icon">
                                <i class="fas fa-industry"></i>
                                <input 
                                    id="industry" 
                                    type="text" 
                                    name="industry" 
                                    value="{{ old('industry') }}" 
                                    class="form-control @error('industry') is-invalid @enderror" 
                                    placeholder="e.g., Information Technology"
                                >
                            </div>
                            @error('industry')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <!-- <label class="form-label" for="password">
                            Password <span class="required">*</span>
                        </label> -->
                        <div class="input-with-icon">
                            <i class="fas fa-lock"></i>
                            <input 
                                id="password" 
                                type="password" 
                                name="password" 
                                class="form-control @error('password') is-invalid @enderror" 
                                placeholder="Create a strong password" 
                                required 
                                autocomplete="new-password"
                            >
                            <button type="button" class="password-eye" id="togglePassword">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <!-- <label class="form-label" for="password_confirmation">
                            Confirm Password <span class="required">*</span>
                        </label> -->
                        <div class="input-with-icon">
                            <i class="fas fa-lock"></i>
                            <input 
                                id="password_confirmation" 
                                type="password" 
                                name="password_confirmation" 
                                class="form-control" 
                                placeholder="Confirm your password" 
                                required 
                                autocomplete="new-password"
                            >
                            <button type="button" class="password-eye" id="toggleConfirmPassword">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn-register">
                        <i class="fas fa-user-plus me-2"></i>Create Account
                    </button>
                </form>

                <!-- Login Link -->
                <div class="login-link">
                    Already have an account?
                    <a href="{{ route('login') }}">Sign in here</a>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const employerFields = document.getElementById('employerFields');
            const roleEmployer = document.getElementById('role_employer');
            const roleJobSeeker = document.getElementById('role_job_seeker');
            const companyNameInput = document.getElementById('company_name');
            const passwordInput = document.getElementById('password');
            const confirmPasswordInput = document.getElementById('password_confirmation');
            const form = document.getElementById('registerForm');
            
            // Password toggle visibility
            document.getElementById('togglePassword').addEventListener('click', function() {
                const icon = this.querySelector('i');
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    passwordInput.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            });
            
            // Confirm password toggle visibility
            document.getElementById('toggleConfirmPassword').addEventListener('click', function() {
                const icon = this.querySelector('i');
                if (confirmPasswordInput.type === 'password') {
                    confirmPasswordInput.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    confirmPasswordInput.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            });
            
            // Toggle employer fields
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
            
            // Add event listeners for role selection
            roleEmployer.addEventListener('change', toggleEmployerFields);
            roleJobSeeker.addEventListener('change', toggleEmployerFields);
            
            // Form validation
            function validateEmail(email) {
                const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return re.test(email);
            }
            
            // Real-time email validation
            const emailInput = document.getElementById('email');
            emailInput.addEventListener('blur', function() {
                if (this.value && !validateEmail(this.value)) {
                    this.classList.add('is-invalid');
                } else {
                    this.classList.remove('is-invalid');
                }
            });
            
            // Password strength check
            passwordInput.addEventListener('input', function() {
                const value = this.value;
                if (value.length < 8 && value.length > 0) {
                    this.classList.add('is-invalid');
                } else {
                    this.classList.remove('is-invalid');
                }
                
                // Check password match
                if (confirmPasswordInput.value && value !== confirmPasswordInput.value) {
                    confirmPasswordInput.classList.add('is-invalid');
                } else {
                    confirmPasswordInput.classList.remove('is-invalid');
                }
            });
            
            // Confirm password match check
            confirmPasswordInput.addEventListener('input', function() {
                if (this.value !== passwordInput.value) {
                    this.classList.add('is-invalid');
                } else {
                    this.classList.remove('is-invalid');
                }
            });
            
            // Form submission validation
            form.addEventListener('submit', function(e) {
                let isValid = true;
                
                // Check role selection
                if (!roleEmployer.checked && !roleJobSeeker.checked) {
                    isValid = false;
                    alert('Please select a role (Job Seeker or Employer)');
                }
                
                // Validate email
                if (!validateEmail(emailInput.value)) {
                    emailInput.classList.add('is-invalid');
                    isValid = false;
                }
                
                // Validate password
                if (passwordInput.value.length < 8) {
                    passwordInput.classList.add('is-invalid');
                    isValid = false;
                }
                
                // Validate password match
                if (passwordInput.value !== confirmPasswordInput.value) {
                    confirmPasswordInput.classList.add('is-invalid');
                    isValid = false;
                }
                
                // Validate employer fields if employer selected
                if (roleEmployer.checked && !companyNameInput.value.trim()) {
                    companyNameInput.classList.add('is-invalid');
                    isValid = false;
                }
                
                if (!isValid) {
                    e.preventDefault();
                    
                    // Show error message
                    if (!document.querySelector('.session-status.error')) {
                        const errorDiv = document.createElement('div');
                        errorDiv.className = 'session-status error';
                        errorDiv.innerHTML = '<div>Please fix the errors in the form.</div>';
                        form.parentNode.insertBefore(errorDiv, form);
                    }
                }
            });
            
            // Auto-focus on name field
            const nameInput = document.getElementById('name');
            if (!nameInput.value.trim()) {
                setTimeout(() => {
                    nameInput.focus();
                }, 100);
            }
        });
    </script>
</body>
</html>