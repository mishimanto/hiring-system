@include('layouts.partials.head')

<body class="font-sans antialiased">
    <div class="min-vh-100 d-flex flex-column">
        @include('layouts.partials.navigation')
        
        <!-- Main Content -->
        <main class="flex-grow-1">
            <div class="container-fluid px-0">
                @include('layouts.partials.alerts')
                @yield('content')
            </div>
        </main>

        @include('layouts.partials.footer')
    </div>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- Custom Scripts -->
    <script>
        // Auto-dismiss alerts after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                var alerts = document.querySelectorAll('.alert');
                alerts.forEach(function(alert) {
                    var bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                });
            }, 5000);
            
            // Active menu item highlighting
            var currentUrl = window.location.href;
            var navLinks = document.querySelectorAll('.nav-link');
            navLinks.forEach(function(link) {
                if (link.href === currentUrl) {
                    link.classList.add('active');
                }
            });
            
            // Theme toggle functionality
            function toggleTheme() {
                const html = document.documentElement;
                const currentTheme = html.getAttribute('data-bs-theme');
                const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
                html.setAttribute('data-bs-theme', newTheme);
                localStorage.setItem('theme', newTheme);
            }
            
            // Set theme on load
            const savedTheme = localStorage.getItem('theme') || 'light';
            document.documentElement.setAttribute('data-bs-theme', savedTheme);
            
            // Add theme toggle button if needed
            // You can add a theme toggle button in your navbar if you want
        });
        
        // Form submission confirmation
        document.addEventListener('submit', function(e) {
            if (e.target.id === 'logout-form') {
                e.preventDefault();
                if (confirm('Are you sure you want to logout?')) {
                    e.target.submit();
                }
            }
            
            if (e.target.classList.contains('confirm-submit')) {
                e.preventDefault();
                const message = e.target.getAttribute('data-confirm') || 'Are you sure?';
                if (confirm(message)) {
                    e.target.submit();
                }
            }
        });
        
        // Toast notifications
        function showToast(message, type = 'info') {
            // Create toast container if it doesn't exist
            if (!document.querySelector('.toast-container')) {
                const container = document.createElement('div');
                container.className = 'toast-container position-fixed top-0 end-0 p-3';
                document.body.appendChild(container);
            }
            
            const toastId = 'toast-' + Date.now();
            const toast = document.createElement('div');
            toast.className = `toast align-items-center text-bg-${type} border-0`;
            toast.id = toastId;
            toast.setAttribute('role', 'alert');
            toast.innerHTML = `
                <div class="d-flex">
                    <div class="toast-body">${message}</div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                </div>
            `;
            
            document.querySelector('.toast-container').appendChild(toast);
            const bsToast = new bootstrap.Toast(toast);
            bsToast.show();
            
            toast.addEventListener('hidden.bs.toast', function() {
                this.remove();
            });
        }
        
        // Global error handling
        window.addEventListener('error', function(e) {
            console.error('Global error:', e.error);
        });
    </script>

    @stack('scripts')
</body>
</html>