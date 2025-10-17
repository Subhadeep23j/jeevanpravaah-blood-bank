<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'JeevanPravaah - Dashboard')</title>
    <link rel="shortcut icon" href="{{ asset('assets/logo.svg') }}" type="image/x-icon">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine.js for dropdown functionality -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @stack('head')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');

        * {
            font-family: 'Inter', sans-serif;
        }

        .glass-morphism {
            backdrop-filter: blur(16px) saturate(180%);
            background-color: rgba(255, 255, 255, 0.9);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .glass-card {
            backdrop-filter: blur(10px) saturate(180%);
            background-color: rgba(255, 255, 255, 0.95);
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        .hero-gradient {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 30%, #cbd5e1 70%, #94a3b8 100%);
        }

        .pulse-glow {
            animation: pulse-glow 2s ease-in-out infinite alternate;
            transition: all 0.3s ease;
        }

        .pulse-glow:hover {
            animation: heartBeat 0.6s ease-in-out;
            transform: scale(1.1);
            box-shadow: 0 0 25px rgba(239, 68, 68, 0.6), 0 0 50px rgba(239, 68, 68, 0.4);
        }

        @keyframes heartBeat {

            0%,
            100% {
                transform: scale(1.1);
            }

            25% {
                transform: scale(1.25);
            }

            50% {
                transform: scale(1.1);
            }

            75% {
                transform: scale(1.2);
            }
        }

        @keyframes pulse-glow {
            0% {
                box-shadow: 0 0 20px rgba(239, 68, 68, 0.3);
            }

            100% {
                box-shadow: 0 0 30px rgba(239, 68, 68, 0.5);
            }
        }

        .hover-lift {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .hover-lift:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .nav-link {
            position: relative;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            transform-origin: center;
        }

        .nav-link:hover {
            transform: translateY(-2px) scale(1.05);
            text-shadow: 0 2px 8px rgba(239, 68, 68, 0.3);
        }

        .nav-link:hover::after {
            content: '';
            position: absolute;
            bottom: -6px;
            left: 50%;
            transform: translateX(-50%);
            width: 30px;
            height: 3px;
            background: linear-gradient(90deg, #ef4444, #f97316);
            border-radius: 2px;
            animation: navUnderline 0.4s ease-out forwards;
        }

        @keyframes navUnderline {
            from {
                width: 0;
            }

            to {
                width: 30px;
            }
        }

        .nav-link:active {
            transform: translateY(0) scale(0.98);
        }

        /* NAVBAR FIXED POSITIONING - CRITICAL STYLES */
        .navbar-fixed {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            width: 100%;
            z-index: 9999;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }

        #main-navbar {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        #main-navbar.nav-shadow {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        html,
        body {
            margin: 0 !important;
            height: 100%;
        }

        html {
            scrollbar-gutter: stable both-edges;
        }

        body {
            padding-top: 0 !important;
            overflow-y: auto;
            -webkit-overflow-scrolling: touch;
        }

        body.is-loading {
            overflow-y: hidden;
        }

        main {
            /* Will receive dynamic padding via JS */
        }

        .page-loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.25);
            -webkit-backdrop-filter: blur(10px) saturate(140%);
            backdrop-filter: blur(10px) saturate(140%);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10000;
            transition: opacity 0.4s ease, backdrop-filter 0.3s ease;
        }

        .page-loader.hidden {
            opacity: 0;
            pointer-events: none;
        }

        .page-content {
            opacity: 1;
            transition: filter 0.3s ease, opacity 0.3s ease;
            will-change: filter;
        }

        .page-content.loaded {
            opacity: 1;
        }

        .page-loader:not(.hidden)~#pageContent {
            opacity: 1;
            filter: blur(8px);
        }

        body.is-loading #pageContent {
            filter: blur(8px);
        }
    </style>
    @stack('head')
</head>

<body class="bg-gray-50 text-gray-800 overflow-x-hidden is-loading">
    {{-- Include Your Existing Loader --}}
    @include('layouts.loader')

    {{-- Authenticated Header --}}
    @include('layouts.auth-header')

    <!-- Page Content -->
    <div id="pageContent" class="page-content">
        <main>
            @yield('content')
        </main>
        @include('layouts.footer')
    </div>
    @stack('scripts')

    <script>
        // Page Loader Functionality
        document.addEventListener('DOMContentLoaded', function() {
            const loader = document.getElementById('pageLoader');
            const content = document.getElementById('pageContent');
            document.body.classList.add('is-loading');

            const minLoadTime = 700;
            const startTime = Date.now();

            window.addEventListener('load', function() {
                const elapsedTime = Date.now() - startTime;
                const remainingTime = Math.max(0, minLoadTime - elapsedTime);

                setTimeout(function() {
                    if (content) {
                        content.classList.add('loaded');
                    }
                    if (loader) {
                        loader.classList.add('hidden');
                    }
                    document.body.classList.remove('is-loading');
                }, remainingTime);
            });
        });

        // Mobile menu toggle
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');

            if (mobileMenuButton && mobileMenu) {
                mobileMenuButton.addEventListener('click', function() {
                    mobileMenuButton.classList.toggle('menu-open');
                    mobileMenu.classList.toggle('menu-opened');
                });
            }
        });

        // Navbar shadow on scroll
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('main-navbar');
            if (window.scrollY > 10) {
                navbar.classList.add('nav-shadow');
            } else {
                navbar.classList.remove('nav-shadow');
            }
        });
    </script>
</body>

</html>
