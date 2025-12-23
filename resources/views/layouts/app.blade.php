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

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Swiper -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <!-- Custom Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            // Auto-dismiss alerts after 5 seconds
            setTimeout(function () {
                document.querySelectorAll('.alert').forEach(function (alert) {
                    new bootstrap.Alert(alert).close();
                });
            }, 5000);

            // Active menu item highlighting
            const currentUrl = window.location.href;
            document.querySelectorAll('.nav-link').forEach(function (link) {
                if (link.href === currentUrl) {
                    link.classList.add('active');
                }
            });

        });

        // Logout confirmation
        document.addEventListener('submit', function (e) {
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
            if (!document.querySelector('.toast-container')) {
                const container = document.createElement('div');
                container.className = 'toast-container position-fixed top-0 end-0 p-3';
                document.body.appendChild(container);
            }

            const toast = document.createElement('div');
            toast.className = `toast align-items-center text-bg-${type} border-0`;
            toast.setAttribute('role', 'alert');
            toast.innerHTML = `
                <div class="d-flex">
                    <div class="toast-body">${message}</div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                </div>
            `;

            document.querySelector('.toast-container').appendChild(toast);
            new bootstrap.Toast(toast).show();

            toast.addEventListener('hidden.bs.toast', function () {
                this.remove();
            });
        }

        // Global error logging
        window.addEventListener('error', function (e) {
            console.error('Global error:', e.error);
        });
    </script>

    @stack('scripts')
</body>
</html>
