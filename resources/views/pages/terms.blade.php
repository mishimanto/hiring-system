@extends('layouts.app')

@section('title', $meta_title ?? 'Terms & Conditions')
@section('meta_description', $meta_description ?? '')
@section('meta_keywords', $meta_keywords ?? '')

@section('content')
<!-- Header Section -->
<!-- <section class="terms-header py-5 bg-gradient-primary">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center text-white">
                <div class="d-flex align-items-center justify-content-center gap-3 mb-4">
                    <div class="icon-wrapper bg-white bg-opacity-20 p-3 rounded-circle">
                        <i class="fas fa-file-contract fa-2x"></i>
                    </div>
                    <h1 class="display-4 fw-bold">Terms & Conditions</h1>
                </div>
                <p class="lead mb-0 opacity-90">
                    Please read these terms carefully before using our services.
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
                    <h1 class="fw-bold display-4 mb-5">Terms & Conditions</h1>
                    <!-- <p class="lead text-muted mx-auto" style="max-width: 600px;">
                        Have questions about our job portal? We're here to help! Reach out to us using any of the methods below.
                    </p> -->
                </div>
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <!-- Last Updated -->
                <div class="last-updated mb-5">
                    <div class="alert alert-warning border-0 shadow-sm">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-history fa-lg me-3 text-warning"></i>
                            <div>
                                <strong>Last Updated:</strong> {{ date('F d, Y') }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Acceptance Section -->
                <div class="acceptance-section mb-5">
                    <div class="card border-warning border-2">
                        <div class="card-body">
                            <div class="d-flex align-items-start gap-3">
                                <i class="fas fa-exclamation-triangle fa-2x text-warning mt-1"></i>
                                <div>
                                    <h5 class="fw-bold text-dark mb-2">Important Notice</h5>
                                    <p class="mb-0 text-dark">
                                        By accessing or using {{ $site_name ?? config('app.name', 'Job Portal') }}, you agree to be bound by these Terms & Conditions. If you do not agree with any part of these terms, you must not use our services.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Terms Content -->
                <div class="terms-content mb-5">

                        <div class="terms-sections">
                            <!-- Introduction -->
                            <div class="terms-section mb-5" id="introduction">
                                <div class="section-header mb-4">
                                    <div class="d-flex align-items-center gap-3 mb-3">
                                        <div class="section-icon">
                                            <i class="fas fa-info-circle text-primary"></i>
                                        </div>
                                        <h2 class="h3 fw-bold mb-0 text-dark">1. Introduction</h2>
                                    </div>
                                </div>
                                <div class="section-content">
                                    <p class="text-dark mb-3">
                                        Welcome to <strong>{{ $site_name ?? config('app.name', 'Job Portal') }}</strong>. These Terms & Conditions govern your use of our job portal and services. By accessing or using our platform, you agree to comply with and be bound by these terms.
                                    </p>
                                    <p class="text-dark">
                                        We reserve the right to modify these terms at any time. Continued use of the platform after changes constitutes acceptance of the modified terms.
                                    </p>
                                </div>
                            </div>

                            <!-- User Accounts -->
                            <div class="terms-section mb-5" id="user-accounts">
                                <div class="section-header mb-4">
                                    <div class="d-flex align-items-center gap-3 mb-3">
                                        <div class="section-icon">
                                            <i class="fas fa-user-circle text-primary"></i>
                                        </div>
                                        <h2 class="h3 fw-bold mb-0 text-dark">2. User Accounts</h2>
                                    </div>
                                </div>
                                <div class="section-content">
                                    <div class="row g-4 mb-4">
                                        <div class="col-md-6">
                                            <div class="info-card p-4 h-100">
                                                <div class="info-icon mb-3">
                                                    <i class="fas fa-user-check fa-2x text-primary"></i>
                                                </div>
                                                <h5 class="fw-bold mb-3 text-dark">Account Creation</h5>
                                                <ul class="text-muted list-unstyled">
                                                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Provide accurate information</li>
                                                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Maintain account security</li>
                                                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i>One account per user</li>
                                                    <li><i class="fas fa-check text-success me-2"></i>Immediate updates on changes</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="info-card p-4 h-100">
                                                <div class="info-icon mb-3">
                                                    <i class="fas fa-shield-alt fa-2x text-primary"></i>
                                                </div>
                                                <h5 class="fw-bold mb-3 text-dark">Account Security</h5>
                                                <ul class="text-muted list-unstyled">
                                                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Keep credentials confidential</li>
                                                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Notify us of unauthorized access</li>
                                                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i>You're responsible for all activities</li>
                                                    <li><i class="fas fa-check text-success me-2"></i>Use strong passwords</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- User Responsibilities -->
                            <div class="terms-section mb-5" id="responsibilities">
                                <div class="section-header mb-4">
                                    <div class="d-flex align-items-center gap-3 mb-3">
                                        <div class="section-icon">
                                            <i class="fas fa-tasks text-primary"></i>
                                        </div>
                                        <h2 class="h3 fw-bold mb-0 text-dark">3. User Responsibilities</h2>
                                    </div>
                                </div>
                                <div class="section-content">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead class="table-light">
                                                <tr>
                                                    <th width="30%">User Type</th>
                                                    <th>Responsibilities</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><strong>Job Seekers</strong></td>
                                                    <td>
                                                        <ul class="mb-0">
                                                            <li>Provide accurate resume information</li>
                                                            <li>Apply only to relevant job openings</li>
                                                            <li>Maintain professional conduct</li>
                                                            <li>Update profile regularly</li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Employers</strong></td>
                                                    <td>
                                                        <ul class="mb-0">
                                                            <li>Post genuine job openings</li>
                                                            <li>Provide accurate company information</li>
                                                            <li>Respond to applications professionally</li>
                                                            <li>Comply with employment laws</li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <!-- Content Guidelines -->
                            <div class="terms-section mb-5" id="content-guidelines">
                                <div class="section-header mb-4">
                                    <div class="d-flex align-items-center gap-3 mb-3">
                                        <div class="section-icon">
                                            <i class="fas fa-pencil-alt text-primary"></i>
                                        </div>
                                        <h2 class="h3 fw-bold mb-0 text-dark">4. Content Guidelines</h2>
                                    </div>
                                </div>
                                <div class="section-content">
                                    <div class="prohibited-content">
                                        <h5 class="fw-bold text-dark mb-3">Prohibited Content:</h5>
                                        <div class="row g-3">
                                            @php
                                                $prohibitedItems = [
                                                    'false_or_misleading' => ['fas fa-ban', 'False or misleading information'],
                                                    'discriminatory' => ['fas fa-user-slash', 'Discriminatory content'],
                                                    'spam' => ['fas fa-exclamation-triangle', 'Spam or unsolicited promotions'],
                                                    'malicious' => ['fas fa-virus', 'Malicious software or links'],
                                                    'harassment' => ['fas fa-comment-slash', 'Harassment or bullying'],
                                                    'illegal' => ['fas fa-gavel', 'Illegal activities'],
                                                    'copyright' => ['fas fa-copyright', 'Copyright infringement'],
                                                    'confidential' => ['fas fa-lock', 'Confidential information'],
                                                    'inappropriate' => ['fas fa-exclamation-circle', 'Inappropriate or offensive content'],
                                                    'impersonation' => ['fas fa-user-secret', 'Impersonation of others']
                                                ];
                                            @endphp
                                            
                                            @foreach(array_chunk($prohibitedItems, 2, true) as $chunk)
                                                <div class="col-md-6">
                                                    @foreach($chunk as $item)
                                                        <div class="d-flex align-items-center gap-3 mb-3 p-3 border rounded">
                                                            <i class="{{ $item[0] }} text-danger"></i>
                                                            <span class="text-dark">{{ $item[1] }}</span>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Intellectual Property -->
                            <div class="terms-section mb-5" id="intellectual-property">
                                <div class="section-header mb-4">
                                    <div class="d-flex align-items-center gap-3 mb-3">
                                        <div class="section-icon">
                                            <i class="fas fa-copyright text-primary"></i>
                                        </div>
                                        <h2 class="h3 fw-bold mb-0 text-dark">5. Intellectual Property</h2>
                                    </div>
                                </div>
                                <div class="section-content">
                                    <div class="row g-4">
                                        <div class="col-md-6">
                                            <div class="ip-card text-center p-4 h-100">
                                                <div class="ip-icon mb-3">
                                                    <i class="fas fa-sitemap fa-2x text-primary"></i>
                                                </div>
                                                <h5 class="fw-bold text-dark">Platform Content</h5>
                                                <p class="text-muted">
                                                    All content on our platform (logos, design, text, graphics) is owned by {{ $site_name ?? 'Job Portal' }} and protected by copyright laws.
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="ip-card text-center p-4 h-100">
                                                <div class="ip-icon mb-3">
                                                    <i class="fas fa-user-edit fa-2x text-primary"></i>
                                                </div>
                                                <h5 class="fw-bold text-dark">User Content</h5>
                                                <p class="text-muted">
                                                    You retain ownership of your content but grant us a license to use, display, and distribute it on our platform.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Limitation of Liability -->
                            <div class="terms-section mb-5" id="liability">
                                <div class="section-header mb-4">
                                    <div class="d-flex align-items-center gap-3 mb-3">
                                        <div class="section-icon">
                                            <i class="fas fa-balance-scale text-primary"></i>
                                        </div>
                                        <h2 class="h3 fw-bold mb-0 text-dark">6. Limitation of Liability</h2>
                                    </div>
                                </div>
                                <div class="section-content">
                                    <div class="alert alert-light border">
                                        <p class="mb-0 text-dark">
                                            <strong>{{ $site_name ?? 'Job Portal' }}</strong> is not responsible for:
                                        </p>
                                        <ul class="mb-0 mt-2">
                                            <li>Job application outcomes or hiring decisions</li>
                                            <li>Accuracy of job postings by employers</li>
                                            <li>User interactions or communications</li>
                                            <li>Technical issues beyond our control</li>
                                            <li>Third-party websites linked from our platform</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- Termination -->
                            <div class="terms-section mb-5" id="termination">
                                <div class="section-header mb-4">
                                    <div class="d-flex align-items-center gap-3 mb-3">
                                        <div class="section-icon">
                                            <i class="fas fa-power-off text-primary"></i>
                                        </div>
                                        <h2 class="h3 fw-bold mb-0 text-dark">7. Termination</h2>
                                    </div>
                                </div>
                                <div class="section-content">
                                    <div class="termination-info">
                                        <div class="row g-4">
                                            <div class="col-md-6">
                                                <div class="term-card p-4 h-100">
                                                    <h5 class="fw-bold text-dark mb-3">By User</h5>
                                                    <p class="text-muted mb-0">
                                                        You may terminate your account at any time by contacting us or using the account deletion feature.
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="term-card p-4 h-100">
                                                    <h5 class="fw-bold text-dark mb-3">By Platform</h5>
                                                    <p class="text-muted mb-0">
                                                        We reserve the right to suspend or terminate accounts that violate these terms or engage in harmful activities.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Governing Law -->
                            <div class="terms-section mb-5" id="governing-law">
                                <div class="section-header mb-4">
                                    <div class="d-flex align-items-center gap-3 mb-3">
                                        <div class="section-icon">
                                            <i class="fas fa-globe text-primary"></i>
                                        </div>
                                        <h2 class="h3 fw-bold mb-0 text-dark">8. Governing Law</h2>
                                    </div>
                                </div>
                                <div class="section-content">
                                    <p class="text-dark">
                                        These Terms & Conditions are governed by and construed in accordance with the laws of [Your Country/State]. Any disputes shall be resolved in the courts located in [Your Jurisdiction].
                                    </p>
                                </div>
                            </div>

                            <!-- Contact Information -->
                            <div class="terms-section" id="contact">
                                <div class="section-header mb-4">
                                    <div class="d-flex align-items-center gap-3 mb-3">
                                        <div class="section-icon">
                                            <i class="fas fa-headset text-primary"></i>
                                        </div>
                                        <h2 class="h3 fw-bold mb-0 text-dark">9. Contact Us</h2>
                                    </div>
                                </div>
                                <div class="section-content">
                                    <div class="contact-info bg-light p-4 rounded-3">
                                        <p class="text-dark mb-3">For questions about these Terms & Conditions, please contact us:</p>
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <div class="d-flex align-items-center gap-3">
                                                    <i class="fas fa-envelope text-primary"></i>
                                                    <div>
                                                        <small class="text-muted d-block">Email</small>
                                                        <strong class="text-dark">{{ $contact_email ?? 'legal@example.com' }}</strong>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="d-flex align-items-center gap-3">
                                                    <i class="fas fa-map-marker-alt text-primary"></i>
                                                    <div>
                                                        <small class="text-muted d-block">Address</small>
                                                        <strong class="text-dark">{{ $contact_address ?? '[Your Company Address]' }}</strong>
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
                <!-- <div class="terms-navigation mb-5">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-light">
                            <h5 class="fw-bold mb-0 text-dark">Quick Navigation</h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-2">
                                <div class="col-md-4 col-6">
                                    <a href="#introduction" class="btn btn-outline-primary w-100 text-start">
                                        <i class="fas fa-info-circle me-2"></i>Introduction
                                    </a>
                                </div>
                                <div class="col-md-4 col-6">
                                    <a href="#user-accounts" class="btn btn-outline-primary w-100 text-start">
                                        <i class="fas fa-user-circle me-2"></i>User Accounts
                                    </a>
                                </div>
                                <div class="col-md-4 col-6">
                                    <a href="#responsibilities" class="btn btn-outline-primary w-100 text-start">
                                        <i class="fas fa-tasks me-2"></i>Responsibilities
                                    </a>
                                </div>
                                <div class="col-md-4 col-6">
                                    <a href="#content-guidelines" class="btn btn-outline-primary w-100 text-start">
                                        <i class="fas fa-pencil-alt me-2"></i>Content Guidelines
                                    </a>
                                </div>
                                <div class="col-md-4 col-6">
                                    <a href="#liability" class="btn btn-outline-primary w-100 text-start">
                                        <i class="fas fa-balance-scale me-2"></i>Liability
                                    </a>
                                </div>
                                <div class="col-md-4 col-6">
                                    <a href="#contact" class="btn btn-outline-primary w-100 text-start">
                                        <i class="fas fa-headset me-2"></i>Contact Us
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

<!-- Acceptance Footer -->
<section class="py-4 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <div class="acceptance-box p-3 bg-white border rounded shadow-sm">
                    <div class="form-check d-inline-block">
                        <input class="form-check-input" type="checkbox" id="termsAcceptance">
                        <label class="form-check-label text-dark" for="termsAcceptance">
                            I have read and agree to the Terms & Conditions
                        </label>
                    </div>
                    <button class="btn btn-primary ms-3" id="continueBtn" disabled>
                        Continue to Platform <i class="fas fa-arrow-right ms-2"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
    /* Header Styles */
    .bg-gradient-primary {
        background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
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
    .terms-section {
        padding-bottom: 2rem;
        border-bottom: 1px solid #eee;
        scroll-margin-top: 80px;
    }
    
    .terms-section:last-child {
        border-bottom: none;
    }
    
    .section-icon {
        width: 40px;
        height: 40px;
        background: rgba(37, 117, 252, 0.1);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
    }
    
    /* Card Styles */
    .info-card, .ip-card, .term-card {
        background: white;
        border-radius: 15px;
        border: 1px solid #e9ecef;
        transition: all 0.3s ease;
    }
    
    .info-card:hover, .ip-card:hover, .term-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        border-color: #2575fc;
    }
    
    .info-icon, .ip-icon {
        width: 60px;
        height: 60px;
        background: rgba(37, 117, 252, 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
    }
    
    /* Table Styles */
    .table th {
        background-color: #f8f9fa;
        font-weight: 600;
    }
    
    /* Prohibited Items */
    .border.rounded {
        border: 1px solid #e9ecef !important;
    }
    
    /* Acceptance Box */
    .acceptance-box {
        max-width: 600px;
        margin: 0 auto;
    }
    
    /* Quick Navigation */
    .btn-outline-primary.text-start {
        text-align: left !important;
        white-space: normal;
        height: 100%;
        transition: all 0.3s ease;
    }
    
    .btn-outline-primary.text-start:hover {
        background-color: #2575fc;
        color: white;
        transform: translateY(-2px);
    }
    
    /* Alert Styles */
    .alert-warning {
        background: rgba(255, 193, 7, 0.1);
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
            padding: 0.5rem;
        }
        
        .acceptance-box {
            padding: 1rem !important;
        }
        
        .acceptance-box .btn {
            margin-top: 1rem;
            margin-left: 0 !important;
            width: 100%;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    // Smooth scroll for navigation
    document.addEventListener('DOMContentLoaded', function() {
        const navLinks = document.querySelectorAll('.terms-navigation a[href^="#"]');
        
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
        
        // Terms acceptance toggle
        const termsCheckbox = document.getElementById('termsAcceptance');
        const continueBtn = document.getElementById('continueBtn');
        
        termsCheckbox.addEventListener('change', function() {
            continueBtn.disabled = !this.checked;
        });
        
        // Continue button action
        continueBtn.addEventListener('click', function() {
            if (!termsCheckbox.checked) {
                alert('Please accept the Terms & Conditions to continue.');
                return;
            }
            
            // Store acceptance in localStorage (optional)
            localStorage.setItem('termsAccepted', 'true');
            
            // Redirect to homepage or previous page
            window.location.href = '/';
        });
        
        // Check if already accepted
        if (localStorage.getItem('termsAccepted') === 'true') {
            termsCheckbox.checked = true;
            continueBtn.disabled = false;
        }
    });
</script>
@endpush