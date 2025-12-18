@extends('layouts.app')

@section('title', $meta_title ?? 'Contact Us')

@section('content')

<div class="bg-gradient-light position-relative overflow-hidden">
    <!-- Background Shape -->
    <div class="position-absolute top-0 end-0 w-50 h-100 bg-light rounded-start-5"></div>
    
    <div class="container position-relative py-5 py-lg-8">
        <!-- Header -->
        <div class="text-center mb-6 mb-lg-7">
            <h1 class="fw-bold display-4 mb-5">Get in Touch</h1>
            <!-- <p class="lead text-muted mx-auto" style="max-width: 600px;">
                Have questions about our job portal? We're here to help! Reach out to us using any of the methods below.
            </p> -->
        </div>

        <div class="row g-5 align-items-start">
            
            <!-- Contact Info Card -->
            <div class="col-lg-5">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                    <div class="card-body p-5">
                        <h3 class="fw-bold mb-5 text-center">Contact Information</h3>
                        
                        <div class="mb-3 pb-2">
                            <div class="d-flex align-items-center mb-3">
                                <div class="icon-wrapper bg-primary bg-opacity-10 text-primary rounded-3 p-3 me-3">
                                    <i class="fas fa-map-marker-alt fs-4"></i>
                                </div>
                                <div>
                                    <h6 class="fw-semibold mb-1">Office Address</h6>
                                    <p class="text-muted mb-0">
                                        {{ $contact_address ?? 'Dhaka, Bangladesh' }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3 pb-2">
                            <div class="d-flex align-items-center mb-3">
                                <div class="icon-wrapper bg-success bg-opacity-10 text-success rounded-3 p-3 me-3">
                                    <i class="fas fa-phone fs-4"></i>
                                </div>
                                <div>
                                    <h6 class="fw-semibold mb-1">Phone Number</h6>
                                    <p class="text-muted mb-0">
                                        {{ $contact_phone ?? 'Not available' }}
                                    </p>
                                    <small class="text-muted">Mon-Fri, 9AM-6PM</small>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3 pb-2">
                            <div class="d-flex align-items-center mb-3">
                                <div class="icon-wrapper bg-info bg-opacity-10 text-info rounded-3 p-3 me-3">
                                    <i class="fas fa-envelope fs-4"></i>
                                </div>
                                <div>
                                    <h6 class="fw-semibold mb-1">Email Address</h6>
                                    <p class="text-muted mb-0">
                                        {{ $contact_email ?? 'info@example.com' }}
                                    </p>
                                    <!-- <small class="text-muted">We respond within 24 hours</small> -->
                                </div>
                            </div>
                        </div>

                        <div class="mb-4 pb-2">
                            <div class="d-flex align-items-center mb-3">
                                <div class="icon-wrapper bg-warning bg-opacity-10 text-warning rounded-3 p-3 me-3">
                                    <i class="fas fa-clock fs-4"></i>
                                </div>
                                <div>
                                    <h6 class="fw-semibold mb-1">Business Hours</h6>
                                    <p class="text-muted mb-0">
                                        {{ $working_hours ?? 'Monday - Friday, 9:00 AM - 6:00 PM' }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Social Media Links -->
                        <div class="mt-2">
                            <h6 class="fw-semibold mb-3">Follow Us</h6>

                            <div class="d-flex gap-3">

                                @if(!empty($social_links['facebook']))
                                    <a href="{{ $social_links['facebook'] }}" target="_blank"
                                    class="btn btn-light btn-icon rounded-circle">
                                        <i class="fab fa-facebook-f text-primary"></i>
                                    </a>
                                @endif

                                @if(!empty($social_links['twitter']))
                                    <a href="{{ $social_links['twitter'] }}" target="_blank"
                                    class="btn btn-light btn-icon rounded-circle">
                                        <i class="fab fa-twitter text-info"></i>
                                    </a>
                                @endif

                                @if(!empty($social_links['linkedin']))
                                    <a href="{{ $social_links['linkedin'] }}" target="_blank"
                                    class="btn btn-light btn-icon rounded-circle">
                                        <i class="fab fa-linkedin-in text-primary"></i>
                                    </a>
                                @endif

                                @if(!empty($social_links['instagram']))
                                    <a href="{{ $social_links['instagram'] }}" target="_blank"
                                    class="btn btn-light btn-icon rounded-circle">
                                        <i class="fab fa-instagram text-danger"></i>
                                    </a>
                                @endif

                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="col-lg-7">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                    <div class="card-body p-5">
                        <h3 class="fw-bold mb-4 text-center">Send us a Message</h3>
                        
                        <!-- @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-check-circle me-2 fs-5"></i>
                                <div>
                                    <strong>Message sent successfully!</strong><br>
                                    We'll get back to you within 24 hours.
                                </div>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif -->

                        <form action="{{ route('contact.submit') }}" method="POST" id="contactForm">
                            @csrf

                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">
                                        Full Name <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0">
                                            <i class="fas fa-user text-muted"></i>
                                        </span>
                                        <input type="text" name="name" value="{{ old('name') }}"
                                               class="form-control @error('name') is-invalid @enderror"
                                               placeholder="Enter your full name" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">
                                        Email Address <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0">
                                            <i class="fas fa-envelope text-muted"></i>
                                        </span>
                                        <input type="email" name="email" value="{{ old('email') }}"
                                               class="form-control @error('email') is-invalid @enderror"
                                               placeholder="your@email.com" required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Phone Number</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="fas fa-phone text-muted"></i>
                                    </span>
                                    <input type="tel" name="phone" value="{{ old('phone') }}"
                                           class="form-control"
                                           placeholder="+8801XXXXXXXXX">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    Subject <span class="text-danger">*</span>
                                </label>
                                <select name="subject"
                                        class="form-select @error('subject') is-invalid @enderror" required>
                                    <option value="">Select a subject</option>
                                    <option value="General Inquiry" {{ old('subject') == 'General Inquiry' ? 'selected' : '' }}>General Inquiry</option>
                                    <option value="Job Posting" {{ old('subject') == 'Job Posting' ? 'selected' : '' }}>Job Posting</option>
                                    <option value="Technical Support" {{ old('subject') == 'Technical Support' ? 'selected' : '' }}>Technical Support</option>
                                    <option value="Partnership" {{ old('subject') == 'Partnership' ? 'selected' : '' }}>Partnership</option>
                                    <option value="Feedback" {{ old('subject') == 'Feedback' ? 'selected' : '' }}>Feedback & Suggestions</option>
                                    <option value="Other" {{ old('subject') == 'Other' ? 'selected' : '' }}>Other</option>
                                </select>
                                @error('subject')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-semibold">
                                    Message <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light align-items-start pt-3 border-end-0">
                                        <i class="fas fa-comment text-muted"></i>
                                    </span>
                                    <textarea name="message" rows="5"
                                              class="form-control @error('message') is-invalid @enderror"
                                              placeholder="Please describe your inquiry in detail..."
                                              required>{{ old('message') }}</textarea>
                                    @error('message')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-text mt-2">
                                    Minimum 10 characters required
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary btn-lg w-100 py-3">
                                <i class="fas fa-paper-plane me-2"></i>Send Message
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Additional Info -->
                <!-- <div class="mt-4">
                    <div class="alert alert-light border rounded-3 mb-0">
                        <div class="d-flex">
                            <i class="fas fa-info-circle text-primary me-3 mt-1"></i>
                            <div>
                                <h6 class="fw-semibold mb-1">Need Immediate Assistance?</h6>
                                <p class="mb-0 text-muted">
                                    For urgent matters, please call us directly at 
                                    <strong>{{ $settings['contact_phone'] ?? '+8801XXXXXXXXX' }}</strong> 
                                    during business hours.
                                </p>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</div>

<!-- Map Section (Optional) -->
<div class="bg-light py-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-map-marked-alt text-primary fs-4 me-2"></i>
                            <h5 class="fw-bold mb-0">Find Our Office</h5>
                        </div>
                        <div class="ratio ratio-16x9 bg-light rounded-3 overflow-hidden">
                            <!-- Google Map Embed (Replace with your actual embed code) -->
                            <iframe 
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3651.928572114864!2d90.39313507597564!3d23.750634088240314!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b8bd552c2b3b%3A0x4e70f117856f0c22!2sBasundhara%20Residential%20Area%2C%20Dhaka!5e0!3m2!1sen!2sbd!4v1699790465439!5m2!1sen!2sbd" 
                                style="border:0;" 
                                allowfullscreen="" 
                                loading="lazy" 
                                referrerpolicy="no-referrer-when-downgrade"
                                class="w-100 h-100">
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
.bg-gradient-light {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
}

.icon-wrapper {
    transition: transform 0.3s ease;
    min-width: 54px;
}

.icon-wrapper:hover {
    transform: translateY(-2px);
}

.btn-icon {
    width: 42px;
    height: 42px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.btn-icon:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.form-control:focus, .form-select:focus {
    border-color: #4dabf7;
    box-shadow: 0 0 0 0.25rem rgba(77, 171, 247, 0.25);
}

.alert-success {
    border-left: 4px solid #28a745;
}

.ratio-16x9 {
    --bs-aspect-ratio: calc(9 / 16 * 100%);
}

/* Form validation styles */
.is-invalid {
    border-color: #dc3545;
    padding-right: calc(1.5em + 0.75rem);
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right calc(0.375em + 0.1875rem) center;
    background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
}

.invalid-feedback {
    display: block;
    margin-top: 0.25rem;
    font-size: 0.875em;
    color: #dc3545;
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('contactForm');
    
    // Form validation on submit
    form.addEventListener('submit', function(e) {
        const submitBtn = this.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        
        // Show loading state
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Sending...';
        submitBtn.disabled = true;
        
        // Re-enable after 5 seconds if still processing
        setTimeout(() => {
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalText;
        }, 5000);
    });
    
    // Auto-dismiss success alert after 5 seconds
    const successAlert = document.querySelector('.alert-success');
    if (successAlert) {
        setTimeout(() => {
            const alert = bootstrap.Alert.getInstance(successAlert);
            if (alert) {
                alert.close();
            }
        }, 5000);
    }
});
</script>
@endpush