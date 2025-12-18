@extends('layouts.app')

@section('title', $meta_title ?? 'About Us')
@section('meta_description', $meta_description ?? '')
@section('meta_keywords', $meta_keywords ?? '')

@section('content')
<!-- Main Content -->
<section class="py-5 bg-white">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <!-- About Content -->
                <div class="text-center mb-6 mb-lg-7">
                    <h1 class="fw-bold display-4 mb-5">About Us</h1>
                    <!-- <p class="lead text-muted mx-auto" style="max-width: 600px;">
                        Have questions about our job portal? We're here to help! Reach out to us using any of the methods below.
                    </p> -->
                </div>

                <!-- Mission & Vision -->
                <div class="row g-4 mb-5">
                    <div class="col-md-6">
                        <div class="card border-0 shadow h-100 hover-lift">
                            <div class="card-body p-4 text-center">
                                <div class="icon-box bg-primary bg-opacity-10 text-primary rounded-3 p-3 mb-4 mx-auto" style="width: 80px; height: 80px;">
                                    <i class="fas fa-bullseye fa-2x"></i>
                                </div>
                                <h4 class="fw-bold mb-3 text-dark">Our Mission</h4>
                                <p class="text-muted mb-0">
                                    To empower individuals by connecting them with meaningful career opportunities and to help businesses build exceptional teams through innovative hiring solutions.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card border-0 shadow h-100 hover-lift">
                            <div class="card-body p-4 text-center">
                                <div class="icon-box bg-success bg-opacity-10 text-success rounded-3 p-3 mb-4 mx-auto" style="width: 80px; height: 80px;">
                                    <i class="fas fa-eye fa-2x"></i>
                                </div>
                                <h4 class="fw-bold mb-3 text-dark">Our Vision</h4>
                                <p class="text-muted mb-0">
                                    To become the most trusted and comprehensive job portal that transforms how people find careers and how companies discover talent worldwide.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Stats Section -->
                <div class="row g-4 mb-5">
                    <div class="col-12">
                        <h3 class="fw-bold text-center mb-5 text-dark">Our Impact in Numbers</h3>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="stat-card text-center p-4">
                            <div class="stat-number display-4 fw-bold text-primary mb-2" data-count="{{ $activeJobsCount }}">0</div>
                            <div class="stat-label fw-semibold text-dark">Jobs Posted</div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="stat-card text-center p-4">
                            <div class="stat-number display-4 fw-bold text-success mb-2" data-count="{{ $usersCount }}">0</div>
                            <div class="stat-label fw-semibold text-dark">Active Users</div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="stat-card text-center p-4">
                            <div class="stat-number display-4 fw-bold text-warning mb-2" data-count="{{ $companiesCount }}">0</div>
                            <div class="stat-label fw-semibold text-dark">Companies</div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="stat-card text-center p-4">
                            <div class="stat-number display-4 fw-bold text-info mb-2" data-count="95">0</div>
                            <div class="stat-label fw-semibold text-dark">Success Rate</div>
                        </div>
                    </div>
                </div>

                <!-- Values Section -->
                <div class="row g-4">
                    <div class="col-12">
                        <h3 class="fw-bold text-center mb-5 text-dark">Our Core Values</h3>
                    </div>
                    <div class="col-md-4">
                        <div class="value-card text-center p-4 h-100">
                            <div class="value-icon mx-auto mb-4">
                                <i class="fas fa-user-check"></i>
                            </div>
                            <h5 class="fw-bold mb-3 text-dark">Integrity</h5>
                            <p class="text-muted mb-0">We believe in transparency, honesty, and ethical practices in everything we do.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="value-card text-center p-4 h-100">
                            <div class="value-icon mx-auto mb-4">
                                <i class="fas fa-users"></i>
                            </div>
                            <h5 class="fw-bold mb-3 text-dark">Collaboration</h5>
                            <p class="text-muted mb-0">We work together with our users and partners to achieve mutual success.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="value-card text-center p-4 h-100">
                            <div class="value-icon mx-auto mb-4">
                                <i class="fas fa-lightbulb"></i>
                            </div>
                            <h5 class="fw-bold mb-3 text-dark">Innovation</h5>
                            <p class="text-muted mb-0">We continuously improve our platform to provide cutting-edge solutions.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h3 class="fw-bold mb-4 text-dark">Ready to Start Your Journey?</h3>
                <p class="lead text-muted mb-4">Join thousands of professionals who found their perfect career match.</p>
                <div class="d-flex gap-3 justify-content-center">
                    <a href="{{ route('register') }}" class="btn btn-primary btn-lg px-4">
                        <i class="fas fa-user-plus me-2"></i>Join Now
                    </a>
                    <a href="{{ route('contact') }}" class="btn btn-outline-primary btn-lg px-4">
                        <i class="fas fa-envelope me-2"></i>Contact Us
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
    /* Header Styles */
    .about-header {
        background: linear-gradient(135deg, #4dabf7 0%, #15aabf 100%);
        position: relative;
        overflow: hidden;
    }
    
    .about-header::before {
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
        background: rgba(255, 255, 255, 0.2);
        padding: 15px;
        border-radius: 50%;
        width: 70px;
        height: 70px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    /* Card Hover Effects */
    .hover-lift {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .hover-lift:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important;
    }
    
    /* Stat Cards */
    .stat-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        transition: all 0.3s ease;
    }
    
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }
    
    /* Value Cards */
    .value-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        transition: all 0.3s ease;
        border-top: 3px solid transparent;
    }
    
    .value-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        border-top-color: #4dabf7;
    }
    
    .value-icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #4dabf7, #15aabf);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.5rem;
    }
    
    /* About Content Styles */
    .about-content h1,
    .about-content h2,
    .about-content h3,
    .about-content h4 {
        color: #2c3e50;
        margin-top: 1.5rem;
        margin-bottom: 1rem;
    }
    
    .about-content p {
        line-height: 1.8;
        margin-bottom: 1rem;
        color: #555;
    }
    
    .about-content ul,
    .about-content ol {
        padding-left: 1.5rem;
        margin-bottom: 1rem;
    }
    
    .about-content li {
        margin-bottom: 0.5rem;
    }
    
    /* Icon Box */
    .icon-box {
        width: 80px;
        height: 80px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 20px;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .about-header .display-4 {
            font-size: 2rem;
        }
        
        .about-header .display-5 {
            font-size: 1.5rem;
        }
        
        .icon-wrapper {
            width: 50px;
            height: 50px;
        }
        
        .stat-number.display-4 {
            font-size: 2.5rem;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    // Animated counter for stats
    document.addEventListener('DOMContentLoaded', function() {
        const statNumbers = document.querySelectorAll('.stat-number');
        
        // Check if element is in viewport
        function isInViewport(element) {
            const rect = element.getBoundingClientRect();
            return (
                rect.top >= 0 &&
                rect.left >= 0 &&
                rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
                rect.right <= (window.innerWidth || document.documentElement.clientWidth)
            );
        }
        
        // Animate counter
        function animateCounter(element) {
            const target = parseInt(element.getAttribute('data-count'));
            const duration = 2000; // 2 seconds
            const step = target / (duration / 16); // 60fps
            let current = 0;
            
            const timer = setInterval(() => {
                current += step;
                if (current >= target) {
                    current = target;
                    clearInterval(timer);
                }
                element.textContent = Math.floor(current) + (element.getAttribute('data-count') == '95' ? '%' : '+');
            }, 16);
        }
        
        // Start animation when in viewport
        function startAnimationOnScroll() {
            statNumbers.forEach(stat => {
                if (isInViewport(stat) && !stat.classList.contains('animated')) {
                    stat.classList.add('animated');
                    animateCounter(stat);
                }
            });
        }
        
        // Initial check
        startAnimationOnScroll();
        
        // Check on scroll
        window.addEventListener('scroll', startAnimationOnScroll);
    });
</script>
@endpush