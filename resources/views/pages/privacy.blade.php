@extends('layouts.app')

@section('title', $meta_title ?? 'Privacy Policy')
@section('meta_description', $meta_description ?? '')
@section('meta_keywords', $meta_keywords ?? '')

@section('content')
<!-- Header Section -->
<!-- <section class="privacy-header py-5 bg-gradient-primary">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center text-white">
                <div class="d-flex align-items-center justify-content-center gap-3 mb-4">
                    <div class="icon-wrapper bg-white bg-opacity-20 p-3 rounded-circle">
                        <i class="fas fa-shield-alt fa-2x"></i>
                    </div>
                    <h1 class="display-4 fw-bold">Privacy Policy</h1>
                </div>
                <p class="lead mb-0 opacity-90">
                    Your privacy is important to us. Read our policy to understand how we protect your information.
                </p>
            </div>
        </div>
    </div>
</section> -->

<!-- Main Content -->
<section class="py-5 bg-white">
    <div class="container">
         <!-- About Content -->
                <div class="text-center mb-6 mb-lg-7">
                    <h1 class="fw-bold display-4 mb-5">Privacy Policy</h1>
                    <!-- <p class="lead text-muted mx-auto" style="max-width: 600px;">
                        Have questions about our job portal? We're here to help! Reach out to us using any of the methods below.
                    </p> -->
                </div>
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <!-- Last Updated -->
                <div class="last-updated mb-5">
                    <div class="alert alert-info border-0 shadow-sm">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-history fa-lg me-3 text-info"></i>
                            <div>
                                <strong>Last Updated:</strong> {{ date('F d, Y') }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Privacy Content -->
                <div class="privacy-content mb-5">
                   
                        <div class="privacy-sections">
                            <!-- Introduction -->
                            <div class="privacy-section mb-5" id="introduction">
                                <div class="section-header mb-4">
                                    <div class="d-flex align-items-center gap-3 mb-3">
                                        <h2 class="h3 fw-bold mb-0 text-dark">Introduction</h2>
                                    </div>
                                </div>
                                <div class="section-content">
                                    <p class="text-dark mb-3">
                                        At <strong>{{ $site_name ?? config('app.name', 'Job Portal') }}</strong>, we are committed to protecting your privacy and ensuring the security of your personal information. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you use our job portal services.
                                    </p>
                                    <p class="text-dark">
                                        Please read this privacy policy carefully. By accessing or using our services, you acknowledge that you have read, understood, and agree to be bound by all the terms of this privacy policy.
                                    </p>
                                </div>
                            </div>

                            <!-- Information We Collect -->
                            <div class="privacy-section mb-5" id="information-collected">
                                <div class="section-header mb-4">
                                    <div class="d-flex align-items-center gap-3 mb-3">
                                        <div class="section-icon">
                                            <i class="fas fa-database text-primary"></i>
                                        </div>
                                        <h2 class="h3 fw-bold mb-0 text-dark">Information We Collect</h2>
                                    </div>
                                </div>
                                <div class="section-content">
                                    <div class="row g-4">
                                        <div class="col-md-6">
                                            <div class="info-card p-4 h-100">
                                                <div class="info-icon mb-3">
                                                    <i class="fas fa-user-circle fa-2x text-primary"></i>
                                                </div>
                                                <h5 class="fw-bold mb-3 text-dark">Personal Information</h5>
                                                <ul class="text-muted list-unstyled">
                                                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Name and contact details</li>
                                                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Email address and phone number</li>
                                                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Professional background</li>
                                                    <li><i class="fas fa-check text-success me-2"></i>Resume and cover letters</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="info-card p-4 h-100">
                                                <div class="info-icon mb-3">
                                                    <i class="fas fa-laptop fa-2x text-primary"></i>
                                                </div>
                                                <h5 class="fw-bold mb-3 text-dark">Technical Information</h5>
                                                <ul class="text-muted list-unstyled">
                                                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i>IP address and browser type</li>
                                                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Device information</li>
                                                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Usage data and cookies</li>
                                                    <li><i class="fas fa-check text-success me-2"></i>Location data</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- How We Use Your Information -->
                            <div class="privacy-section mb-5" id="data-usage">
                                <div class="section-header mb-4">
                                    <div class="d-flex align-items-center gap-3 mb-3">
                                        <div class="section-icon">
                                            <i class="fas fa-cogs text-primary"></i>
                                        </div>
                                        <h2 class="h3 fw-bold mb-0 text-dark">How We Use Your Information</h2>
                                    </div>
                                </div>
                                <div class="section-content">
                                    <div class="row g-3">
                                        <div class="col-md-4">
                                            <div class="use-card text-center p-3 h-100">
                                                <div class="use-icon mb-3">
                                                    <i class="fas fa-briefcase fa-2x text-primary"></i>
                                                </div>
                                                <h6 class="fw-bold text-dark">Job Matching</h6>
                                                <p class="small text-muted mb-0">Connect you with relevant job opportunities</p>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="use-card text-center p-3 h-100">
                                                <div class="use-icon mb-3">
                                                    <i class="fas fa-envelope fa-2x text-primary"></i>
                                                </div>
                                                <h6 class="fw-bold text-dark">Communication</h6>
                                                <p class="small text-muted mb-0">Send important updates and notifications</p>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="use-card text-center p-3 h-100">
                                                <div class="use-icon mb-3">
                                                    <i class="fas fa-chart-line fa-2x text-primary"></i>
                                                </div>
                                                <h6 class="fw-bold text-dark">Improvement</h6>
                                                <p class="small text-muted mb-0">Enhance our services and user experience</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Data Protection -->
                            <div class="privacy-section mb-5" id="data-protection">
                                <div class="section-header mb-4">
                                    <div class="d-flex align-items-center gap-3 mb-3">
                                        <div class="section-icon">
                                            <i class="fas fa-lock text-primary"></i>
                                        </div>
                                        <h2 class="h3 fw-bold mb-0 text-dark">Data Protection</h2>
                                    </div>
                                </div>
                                <div class="section-content">
                                    <div class="security-features">
                                        <div class="row g-4">
                                            <div class="col-md-6">
                                                <div class="d-flex align-items-start gap-3">
                                                    <div class="feature-icon">
                                                        <i class="fas fa-shield-alt text-success fa-lg"></i>
                                                    </div>
                                                    <div>
                                                        <h5 class="fw-bold text-dark mb-2">Security Measures</h5>
                                                        <p class="text-muted mb-0">We implement industry-standard security measures including encryption, firewalls, and secure servers to protect your data.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="d-flex align-items-start gap-3">
                                                    <div class="feature-icon">
                                                        <i class="fas fa-user-shield text-success fa-lg"></i>
                                                    </div>
                                                    <div>
                                                        <h5 class="fw-bold text-dark mb-2">Access Control</h5>
                                                        <p class="text-muted mb-0">Strict access controls ensure that only authorized personnel can access your personal information.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Your Rights -->
                            <div class="privacy-section mb-5" id="your-rights">
                                <div class="section-header mb-4">
                                    <div class="d-flex align-items-center gap-3 mb-3">
                                        <div class="section-icon">
                                            <i class="fas fa-user-check text-primary"></i>
                                        </div>
                                        <h2 class="h3 fw-bold mb-0 text-dark">Your Rights</h2>
                                    </div>
                                </div>
                                <div class="section-content">
                                    <div class="rights-list">
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <div class="right-item d-flex align-items-center gap-3 p-3">
                                                    <i class="fas fa-eye text-primary"></i>
                                                    <span class="text-dark">Right to access your data</span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="right-item d-flex align-items-center gap-3 p-3">
                                                    <i class="fas fa-edit text-primary"></i>
                                                    <span class="text-dark">Right to correct your data</span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="right-item d-flex align-items-center gap-3 p-3">
                                                    <i class="fas fa-trash-alt text-primary"></i>
                                                    <span class="text-dark">Right to delete your data</span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="right-item d-flex align-items-center gap-3 p-3">
                                                    <i class="fas fa-ban text-primary"></i>
                                                    <span class="text-dark">Right to object to processing</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Contact Information -->
                            <div class="privacy-section" id="contact-us">
                                <div class="section-header mb-4">
                                    <div class="d-flex align-items-center gap-3 mb-3">
                                        <div class="section-icon">
                                            <i class="fas fa-headset text-primary"></i>
                                        </div>
                                        <h2 class="h3 fw-bold mb-0 text-dark">Contact Us</h2>
                                    </div>
                                </div>
                                <div class="section-content">
                                    <div class="contact-info bg-light p-4 rounded-3">
                                        <p class="text-dark mb-3">If you have any questions about this Privacy Policy or our data practices, please contact us:</p>
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <div class="d-flex align-items-center gap-3">
                                                    <i class="fas fa-envelope text-primary"></i>
                                                    <div>
                                                        <small class="text-muted d-block">Email</small>
                                                        <strong class="text-dark">{{ $contact_email ?? 'privacy@example.com' }}</strong>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="d-flex align-items-center gap-3">
                                                    <i class="fas fa-phone text-primary"></i>
                                                    <div>
                                                        <small class="text-muted d-block">Phone</small>
                                                        <strong class="text-dark">{{ $contact_phone ?? '+1 (123) 456-7890' }}</strong>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                </div>

                <!-- Quick Navigation -->
                <!-- <div class="privacy-navigation mb-5">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-light">
                            <h5 class="fw-bold mb-0 text-dark">Quick Navigation</h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-2">
                                <div class="col-md-3 col-6">
                                    <a href="#introduction" class="btn btn-outline-primary w-100 text-start">
                                        <i class="fas fa-info-circle me-2"></i>Introduction
                                    </a>
                                </div>
                                <div class="col-md-3 col-6">
                                    <a href="#information-collected" class="btn btn-outline-primary w-100 text-start">
                                        <i class="fas fa-database me-2"></i>Data Collected
                                    </a>
                                </div>
                                <div class="col-md-3 col-6">
                                    <a href="#data-usage" class="btn btn-outline-primary w-100 text-start">
                                        <i class="fas fa-cogs me-2"></i>Data Usage
                                    </a>
                                </div>
                                <div class="col-md-3 col-6">
                                    <a href="#your-rights" class="btn btn-outline-primary w-100 text-start">
                                        <i class="fas fa-user-check me-2"></i>Your Rights
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</section>

<!-- Footer Note -->
<section class="py-4 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <p class="mb-0 text-muted">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    This Privacy Policy is subject to change. Please check back periodically for updates.
                </p>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
    /* Header Styles */
    .bg-gradient-primary {
        background: linear-gradient(135deg, #4dabf7 0%, #15aabf 100%);
        position: relative;
        overflow: hidden;
    }
    
    .bg-gradient-primary::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23ffffff' fill-opacity='0.1' fill-rule='evenodd'/%3E%3C/svg%3E");
        opacity: 0.1;
    }
    
    .icon-wrapper {
        width: 70px;
        height: 70px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    /* Section Styles */
    .privacy-section {
        padding-bottom: 2rem;
        border-bottom: 1px solid #eee;
        scroll-margin-top: 80px;
    }
    
    .privacy-section:last-child {
        border-bottom: none;
    }
    
    .section-icon {
        width: 40px;
        height: 40px;
        background: rgba(77, 171, 247, 0.1);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
    }
    
    /* Card Styles */
    .info-card {
        background: white;
        border-radius: 15px;
        border: 1px solid #e9ecef;
        transition: all 0.3s ease;
    }
    
    .info-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        border-color: #4dabf7;
    }
    
    .use-card {
        background: white;
        border-radius: 12px;
        border: 1px solid #e9ecef;
        transition: all 0.3s ease;
    }
    
    .use-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        background: #f8f9fa;
    }
    
    .use-icon {
        width: 60px;
        height: 60px;
        background: rgba(77, 171, 247, 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
    }
    
    /* Rights List */
    .right-item {
        background: white;
        border-radius: 10px;
        border: 1px solid #e9ecef;
        transition: all 0.3s ease;
    }
    
    .right-item:hover {
        background: #f8f9fa;
        border-color: #4dabf7;
        transform: translateX(5px);
    }
    
    /* Feature Icons */
    .feature-icon {
        width: 40px;
        height: 40px;
        background: rgba(40, 167, 69, 0.1);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    
    /* Content Styles */
    .privacy-content h1,
    .privacy-content h2,
    .privacy-content h3,
    .privacy-content h4 {
        color: #2c3e50;
        margin-top: 1.5rem;
        margin-bottom: 1rem;
    }
    
    .privacy-content p {
        line-height: 1.8;
        margin-bottom: 1rem;
        color: #555;
    }
    
    .privacy-content ul,
    .privacy-content ol {
        padding-left: 1.5rem;
        margin-bottom: 1rem;
    }
    
    .privacy-content li {
        margin-bottom: 0.5rem;
    }
    
    /* Navigation Buttons */
    .btn-outline-primary.text-start {
        text-align: left !important;
        white-space: normal;
        height: 100%;
    }
    
    /* Last Updated Alert */
    .alert-info {
        background: rgba(23, 162, 184, 0.1);
        border: none;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .display-4 {
            font-size: 2rem;
        }
        
        .icon-wrapper {
            width: 50px;
            height: 50px;
        }
        
        .btn-outline-primary.text-start {
            font-size: 0.9rem;
        }
        
        .use-card, .right-item {
            padding: 1rem !important;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    // Smooth scroll for navigation
    document.addEventListener('DOMContentLoaded', function() {
        const navLinks = document.querySelectorAll('.privacy-navigation a[href^="#"]');
        
        navLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                
                const targetId = this.getAttribute('href');
                if (targetId === '#') return;
                
                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 80,
                        behavior: 'smooth'
                    });
                }
            });
        });
    });
</script>
@endpush