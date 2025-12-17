@extends('layouts.app')

@section('title', $meta_title)
@section('meta_description', $meta_description)
@section('meta_keywords', $meta_keywords)

@section('content')
<!-- Hero Section -->
<section class="contact-hero bg-gradient-primary py-5 position-relative overflow-hidden">
    <div class="container position-relative z-1">
        <div class="row align-items-center">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="display-5 fw-bold text-white mb-3">Contact Us</h1>
                <!-- <p class="lead text-white mb-4">We're here to help and answer any questions you might have. We look forward to hearing from you!</p> -->
                <div class="d-flex flex-wrap justify-content-center gap-3">
                    <a href="tel:{{ $contact_phone ?? '' }}" class="btn btn-light btn-lg rounded-pill px-4 shadow-sm">
                        <i class="fas fa-phone me-2"></i>
                        Call Now
                    </a>
                    <a href="mailto:{{ $contact_email ?? '' }}" class="btn btn-outline-light btn-lg rounded-pill px-4">
                        <i class="fas fa-envelope me-2"></i>
                        Send Email
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="position-absolute top-0 start-0 w-100 h-100">
        <div class="position-absolute top-0 start-0 w-100 h-100 bg-primary opacity-10"></div>
    </div>
</section>

<!-- Contact Section -->
<section class="py-5">
    <div class="container">
        <div class="row g-4">
            <!-- Contact Information -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-lg h-100">
                    <div class="card-body p-4">
                        <h2 class="h4 fw-bold text-primary mb-4">Get in Touch</h2>
                        
                        <div class="contact-info">
                            <!-- Phone -->
                            <div class="d-flex align-items-start mb-4">
                                <div class="bg-primary bg-opacity-10 p-3 rounded-circle me-3">
                                    <i class="fas fa-phone fa-lg text-primary"></i>
                                </div>
                                <div>
                                    <h4 class="h6 fw-bold mb-1">Phone Number</h4>
                                    <p class="mb-0 text-muted">{{ $contact_phone ?? 'Not available' }}</p>
                                    <small class="text-muted">Mon-Fri 9am-6pm</small>
                                </div>
                            </div>
                            
                            <!-- Email -->
                            <div class="d-flex align-items-start mb-4">
                                <div class="bg-success bg-opacity-10 p-3 rounded-circle me-3">
                                    <i class="fas fa-envelope fa-lg text-success"></i>
                                </div>
                                <div>
                                    <h4 class="h6 fw-bold mb-1">Email Address</h4>
                                    <p class="mb-0 text-muted">{{ $contact_email ?? 'Not available' }}</p>
                                    <small class="text-muted">We'll reply within 24 hours</small>
                                </div>
                            </div>
                            
                            <!-- Address -->
                            <div class="d-flex align-items-start mb-4">
                                <div class="bg-info bg-opacity-10 p-3 rounded-circle me-3">
                                    <i class="fas fa-map-marker-alt fa-lg text-info"></i>
                                </div>
                                <div>
                                    <h4 class="h6 fw-bold mb-1">Office Location</h4>
                                    <p class="mb-0 text-muted">{{ $contact_address ?? 'Not available' }}</p>
                                    <small class="text-muted">Dhaka, Bangladesh</small>
                                </div>
                            </div>
                            
                            <!-- Social Links -->
                            <div class="mt-4 pt-3 border-top">
                                <h4 class="h6 fw-bold mb-3">Follow Us</h4>
                                <div class="d-flex gap-2">
                                    <a href="#" class="btn btn-outline-primary btn-sm rounded-circle p-2">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                    <a href="#" class="btn btn-outline-info btn-sm rounded-circle p-2">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                    <a href="#" class="btn btn-outline-primary btn-sm rounded-circle p-2">
                                        <i class="fab fa-linkedin-in"></i>
                                    </a>
                                    <a href="#" class="btn btn-outline-danger btn-sm rounded-circle p-2">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Contact Form -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-lg">
                    <div class="card-body p-4 p-lg-5">
                        <div class="text-center mb-4">
                            <h2 class="h3 fw-bold text-dark">Send us a Message</h2>
                            <p class="text-muted mb-0">Fill out the form below and we'll get back to you as soon as possible.</p>
                        </div>
                        
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-check-circle me-2"></i>
                                    <div>{{ session('success') }}</div>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        
                        <form action="{{ route('contact.submit') }}" method="POST" class="needs-validation" novalidate>
                            @csrf
                            
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="name" class="form-label fw-semibold">
                                        <i class="fas fa-user text-primary me-1"></i>
                                        Full Name *
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0">
                                            <i class="fas fa-user text-muted"></i>
                                        </span>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                               id="name" name="name" value="{{ old('name') }}" 
                                               placeholder="Enter your full name" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="email" class="form-label fw-semibold">
                                        <i class="fas fa-envelope text-primary me-1"></i>
                                        Email Address *
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0">
                                            <i class="fas fa-at text-muted"></i>
                                        </span>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                               id="email" name="email" value="{{ old('email') }}" 
                                               placeholder="Enter your email" required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-12">
                                    <label for="subject" class="form-label fw-semibold">
                                        <i class="fas fa-tag text-primary me-1"></i>
                                        Subject *
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0">
                                            <i class="fas fa-heading text-muted"></i>
                                        </span>
                                        <input type="text" class="form-control @error('subject') is-invalid @enderror" 
                                               id="subject" name="subject" value="{{ old('subject') }}" 
                                               placeholder="What is this regarding?" required>
                                        @error('subject')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-12">
                                    <label for="message" class="form-label fw-semibold">
                                        <i class="fas fa-comment text-primary me-1"></i>
                                        Your Message *
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 align-items-start pt-3">
                                            <i class="fas fa-edit text-muted"></i>
                                        </span>
                                        <textarea class="form-control @error('message') is-invalid @enderror" 
                                                  id="message" name="message" rows="6" 
                                                  placeholder="Please describe your inquiry in detail..." 
                                                  required>{{ old('message') }}</textarea>
                                        @error('message')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-text text-end mt-1">
                                        <span id="charCount">0</span> / 1000 characters
                                    </div>
                                </div>
                                
                                <div class="col-12">
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" id="agreeTerms" required>
                                        <label class="form-check-label small text-muted" for="agreeTerms">
                                            I agree to the <a href="{{ route('terms') }}" class="text-primary">Terms & Conditions</a> 
                                            and <a href="{{ route('privacy') }}" class="text-primary">Privacy Policy</a>
                                        </label>
                                    </div>
                                </div>
                                
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary btn-lg px-5 py-3 w-100">
                                        <i class="fas fa-paper-plane me-2"></i>
                                        Send Message
                                    </button>
                                </div>
                                
                                <div class="col-12 text-center mt-3">
                                    <p class="small text-muted mb-0">
                                        <i class="fas fa-clock text-primary me-1"></i>
                                        Average response time: 24 hours
                                    </p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- FAQ Section -->
        <div class="row mt-5">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h3 class="h4 fw-bold text-center mb-4">Frequently Asked Questions</h3>
                        <div class="accordion" id="contactFAQ">
                            <div class="accordion-item border-0">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                        How long does it take to get a response?
                                    </button>
                                </h2>
                                <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#contactFAQ">
                                    <div class="accordion-body">
                                        We typically respond to all inquiries within 24 hours during business days.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item border-0">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                        Can I apply for a job through this contact form?
                                    </button>
                                </h2>
                                <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#contactFAQ">
                                    <div class="accordion-body">
                                        For job applications, please visit our <a href="{{ route('jobs.index') }}" class="text-primary">Jobs page</a> and apply directly to the job postings.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item border-0">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                        Do you have physical office hours?
                                    </button>
                                </h2>
                                <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#contactFAQ">
                                    <div class="accordion-body">
                                        Our office is open Monday through Friday, from 9:00 AM to 6:00 PM.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
    .contact-hero {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    .contact-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="%23ffffff" fill-opacity="0.1" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,112C672,96,768,96,864,112C960,128,1056,160,1152,160C1248,160,1344,128,1392,112L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>');
        background-size: cover;
        background-position: center;
    }
    
    .input-group-text {
        transition: all 0.3s ease;
    }
    
    .input-group:focus-within .input-group-text {
        background-color: #e3f2fd !important;
        border-color: #0d6efd !important;
    }
    
    .form-control:focus {
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.1);
        border-color: #0d6efd;
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        transition: all 0.3s ease;
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
    }
    
    .accordion-button:not(.collapsed) {
        background-color: #f8f9fa;
        color: #0d6efd;
        box-shadow: none;
    }
    
    .accordion-button:focus {
        box-shadow: none;
        border-color: rgba(0,0,0,.125);
    }
</style>
@endpush

@push('scripts')
<script>
    // Character counter for message
    const messageTextarea = document.getElementById('message');
    const charCount = document.getElementById('charCount');
    
    if (messageTextarea && charCount) {
        messageTextarea.addEventListener('input', function() {
            const length = this.value.length;
            charCount.textContent = length;
            
            if (length > 1000) {
                charCount.classList.add('text-danger');
            } else {
                charCount.classList.remove('text-danger');
            }
        });
        
        // Initialize count
        charCount.textContent = messageTextarea.value.length;
    }
    
    // Form validation
    (function () {
        'use strict'
        var forms = document.querySelectorAll('.needs-validation')
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script>
@endpush