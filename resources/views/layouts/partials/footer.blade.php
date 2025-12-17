<footer class="footer py-5 mt-auto">
    <div class="container">
        <div class="row">
            <!-- About Column -->
            <div class="col-lg-4 col-md-6 mb-4">
                <h5 class="mb-4">About {{ setting('site_name', 'Job Portal') }}</h5>
                <p class="text-light mb-4">
                    {{ setting('meta_description', 'Your trusted job portal connecting employers with talented professionals.') }}
                </p>
                <div class="social-icons">
                    @if(setting('facebook_url'))
                        <a href="{{ setting('facebook_url') }}" target="_blank" class="text-white">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                    @endif
                    @if(setting('twitter_url'))
                        <a href="{{ setting('twitter_url') }}" target="_blank" class="text-white">
                            <i class="fab fa-twitter"></i>
                        </a>
                    @endif
                    @if(setting('linkedin_url'))
                        <a href="{{ setting('linkedin_url') }}" target="_blank" class="text-white">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    @endif
                    @if(setting('instagram_url'))
                        <a href="{{ setting('instagram_url') }}" target="_blank" class="text-white">
                            <i class="fab fa-instagram"></i>
                        </a>
                    @endif
                </div>
            </div>

            <!-- Quick Links -->
            <div class="col-lg-2 col-md-6 mb-4">
                <h5 class="mb-4">Quick Links</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="{{ route('home') }}" class="text-light">Home</a></li>
                    <li class="mb-2"><a href="{{ route('jobs.index') }}" class="text-light">Browse Jobs</a></li>
                    <li class="mb-2"><a href="{{ route('about') }}" class="text-light">About Us</a></li>
                    @auth
                        <li class="mb-2"><a href="{{ route('dashboard') }}" class="text-light">Dashboard</a></li>
                    @endauth
                </ul>
            </div>

            <!-- Contact Info -->
            <div class="col-lg-3 col-md-6 mb-4">
                <h5 class="mb-4">Contact Us</h5>
                <ul class="list-unstyled text-light">
                    <li class="mb-3">
                        <i class="fas fa-phone me-2"></i>
                        {{ setting('contact_phone', 'Not set') }}
                    </li>
                    <li class="mb-3">
                        <i class="fas fa-envelope me-2"></i>
                        {{ setting('contact_email', 'Not set') }}
                    </li>
                    <li class="mb-3">
                        <i class="fas fa-map-marker-alt me-2"></i>
                        {{ setting('contact_address', 'Not set') }}
                    </li>
                </ul>
            </div>

            <!-- Legal Links -->
            <div class="col-lg-3 col-md-6 mb-4">
                <h5 class="mb-4">Legal</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="{{ route('terms') }}" class="text-light">Terms & Conditions</a></li>
                    <li class="mb-2"><a href="{{ route('privacy') }}" class="text-light">Privacy Policy</a></li>
                    <li class="mb-2"><a href="{{ route('about') }}" class="text-light">About Us</a></li>
                    @if(setting('contact_email'))
                        <li class="mb-2">
                            <a href="mailto:{{ setting('contact_email') }}" class="text-light">
                                Contact Support
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>

        <hr class="my-4" style="border-color: rgba(255,255,255,0.1);">

        <div class="row align-items-center">
            <div class="col-md-6">
                <p class="mb-0 text-light">
                    &copy; {{ date('Y') }} {{ setting('site_name', 'Job Portal') }}. All rights reserved.
                </p>
            </div>
            <div class="col-md-6 text-md-end">
                <p class="mb-0 text-light">
                    Developed with by {{ setting('site_name', 'Job Portal') }} Team
                </p>
            </div>
        </div>
    </div>
</footer>