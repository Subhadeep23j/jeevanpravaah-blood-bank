<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'JeevanPravaah')</title>
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
            width: 120%;
            height: 3px;
            background: linear-gradient(90deg, #ef4444, #f87171, #fca5a5);
            border-radius: 2px;
            transform: translateX(-50%) scaleX(0);
            animation: navUnderline 0.4s ease-out forwards;
            box-shadow: 0 2px 8px rgba(239, 68, 68, 0.4);
        }

        @keyframes navUnderline {
            0% {
                transform: translateX(-50%) scaleX(0);
                opacity: 0;
            }

            50% {
                opacity: 1;
            }

            100% {
                transform: translateX(-50%) scaleX(1);
                opacity: 1;
            }
        }

        .nav-link:active {
            transform: translateY(-1px) scale(0.98);
        }

        .feature-icon-bg {
            background: linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%);
        }

        .timeline-item {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.6s ease-out;
        }

        .timeline-item.animate {
            opacity: 1;
            transform: translateY(0);
        }

        .floating-animation {
            animation: floating 6s ease-in-out infinite;
        }

        @keyframes floating {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-15px);
            }
        }

        .heart-pulse {
            animation: heart-pulse 1.5s ease-in-out infinite;
        }

        @keyframes heart-pulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }
        }

        /* NAVBAR FIXED POSITIONING - CRITICAL STYLES */
        .navbar-fixed {
            position: fixed !important;
            top: 0;
            left: 0;
            right: 0;
            width: 100% !important;
            min-height: 54px !important;
            z-index: 1000 !important;
            backdrop-filter: blur(16px) saturate(180%);
            background-color: rgba(255, 255, 255, 0.9);
            border-bottom: 1px solid rgba(209, 213, 219, 0.3);
            box-shadow: 0 1px 0 rgba(0, 0, 0, 0.04);
            /* subtle base shadow */
            transition: background-color 0.3s ease, backdrop-filter 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
        }

        #main-navbar {
            position: fixed !important;
            top: 0;
            left: 0;
            right: 0;
            width: 100% !important;
            min-height: 48px !important;
            z-index: 1000 !important;
            box-shadow: none;
        }

        /* Elevated shadow on scroll */
        #main-navbar.nav-shadow {
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
            border-bottom-color: transparent;
        }

        /* Guard against transforms creating containing block above header */
        body,
        html,
        #pageContent {
            transform: none !important;
            perspective: none !important;
        }

        /* Enhanced Hamburger Menu Icon Animation */
        .hamburger {
            width: 24px;
            height: 18px;
            position: relative;
            cursor: pointer;
        }

        .hamburger-line {
            display: block;
            width: 100%;
            height: 2px;
            background: currentColor;
            border-radius: 2px;
            position: absolute;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            transform-origin: center;
        }

        .hamburger-line:nth-child(1) {
            top: 0;
        }

        .hamburger-line:nth-child(2) {
            top: 50%;
            transform: translateY(-50%);
        }

        .hamburger-line:nth-child(3) {
            bottom: 0;
        }

        /* Animated states */
        #mobile-menu-button.menu-open .hamburger-line:nth-child(1) {
            top: 50%;
            transform: translateY(-50%) rotate(45deg);
        }

        #mobile-menu-button.menu-open .hamburger-line:nth-child(2) {
            opacity: 0;
            transform: translateY(-50%) scale(0);
        }

        #mobile-menu-button.menu-open .hamburger-line:nth-child(3) {
            bottom: 50%;
            transform: translateY(50%) rotate(-45deg);
        }

        /* Enhanced Hamburger Menu Icon Animation */
        .hamburger {
            width: 24px;
            height: 18px;
            position: relative;
            cursor: pointer;
        }

        .hamburger-line {
            display: block;
            width: 100%;
            height: 2px;
            background: currentColor;
            border-radius: 2px;
            position: absolute;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            transform-origin: center;
        }

        .hamburger-line:nth-child(1) {
            top: 0;
        }

        .hamburger-line:nth-child(2) {
            top: 50%;
            transform: translateY(-50%);
        }

        .hamburger-line:nth-child(3) {
            bottom: 0;
        }

        /* Animated states */
        #mobile-menu-button.menu-open .hamburger-line:nth-child(1) {
            top: 50%;
            transform: translateY(-50%) rotate(45deg);
        }

        #mobile-menu-button.menu-open .hamburger-line:nth-child(2) {
            opacity: 0;
            transform: translateY(-50%) scale(0);
        }

        #mobile-menu-button.menu-open .hamburger-line:nth-child(3) {
            bottom: 50%;
            transform: translateY(50%) rotate(-45deg);
        }

        /* Navigation Login Button Animations */
        nav a[href="/login"] {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            transform-origin: center;
        }

        nav a[href="/login"]:hover {
            transform: translateY(-2px) scale(1.05);
            box-shadow: 0 8px 25px rgba(239, 68, 68, 0.4), 0 0 20px rgba(239, 68, 68, 0.3);
        }

        nav a[href="/login"]:hover svg {
            animation: iconBounce 0.6s ease-in-out;
        }

        @keyframes iconBounce {

            0%,
            100% {
                transform: translateX(0);
            }

            25% {
                transform: translateX(-3px);
            }

            75% {
                transform: translateX(3px);
            }
        }

        nav a[href="/login"]:active {
            transform: translateY(-1px) scale(1.02);
        }

        /* Mobile menu container animation */
        #mobile-menu {
            overflow: hidden;
            max-height: 0;
            opacity: 0;
            transform: translateY(-8px) scaleY(0.98);
            transform-origin: top;
            visibility: hidden;
            pointer-events: none;
            transition: max-height 0.35s cubic-bezier(0.4, 0, 0.2, 1),
                opacity 0.3s cubic-bezier(0.4, 0, 0.2, 1),
                transform 0.35s cubic-bezier(0.4, 0, 0.2, 1),
                visibility 0s linear 0.35s;
        }

        #mobile-menu.menu-opened {
            max-height: 420px;
            opacity: 1;
            transform: translateY(0) scaleY(1);
            visibility: visible;
            pointer-events: auto;
            transition: max-height 0.45s cubic-bezier(0.2, 0.8, 0.2, 1),
                opacity 0.35s cubic-bezier(0.4, 0, 0.2, 1),
                transform 0.45s cubic-bezier(0.2, 0.8, 0.2, 1),
                visibility 0s linear 0s;
        }

        /* Staggered animation for menu items */
        #mobile-menu nav a {
            transform: translateX(-20px);
            opacity: 0;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        #mobile-menu nav a:hover {
            transform: translateX(5px) scale(1.02);
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.1) 0%, rgba(251, 191, 36, 0.1) 100%);
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.15);
            border-left: 3px solid #ef4444;
        }

        /* Mobile nav icon animations */
        .nav-icon {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            transform-origin: center;
        }

        #mobile-menu nav a:hover .nav-icon {
            transform: scale(1.15) rotate(5deg);
            filter: drop-shadow(0 2px 4px rgba(239, 68, 68, 0.3));
        }

        #mobile-menu nav a {
            position: relative;
            overflow: hidden;
        }

        #mobile-menu nav a::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            width: 0;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(239, 68, 68, 0.1), transparent);
            transition: width 0.4s ease;
            z-index: -1;
        }

        #mobile-menu nav a:hover::before {
            width: 100%;
        }

        /* Staggered icon entrance animation */
        #mobile-menu nav a .nav-icon {
            opacity: 0;
            transform: translateX(-10px) scale(0.8);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        #mobile-menu.menu-opened nav a .nav-icon {
            opacity: 1;
            transform: translateX(0) scale(1);
        }

        #mobile-menu.menu-opened nav a:nth-child(1) .nav-icon {
            transition-delay: 0.2s;
        }

        #mobile-menu.menu-opened nav a:nth-child(2) .nav-icon {
            transition-delay: 0.25s;
        }

        #mobile-menu.menu-opened nav a:nth-child(3) .nav-icon {
            transition-delay: 0.3s;
        }

        #mobile-menu.menu-opened nav a:nth-child(4) .nav-icon {
            transition-delay: 0.35s;
        }

        #mobile-menu.menu-opened nav a:nth-child(5) .nav-icon {
            transition-delay: 0.4s;
        }

        #mobile-menu.menu-opened nav a {
            transform: translateX(0);
            opacity: 1;
        }

        #mobile-menu.menu-opened nav a:nth-child(1) {
            transition-delay: 0.1s;
        }

        #mobile-menu.menu-opened nav a:nth-child(2) {
            transition-delay: 0.15s;
        }

        #mobile-menu.menu-opened nav a:nth-child(3) {
            transition-delay: 0.2s;
        }

        #mobile-menu.menu-opened nav a:nth-child(4) {
            transition-delay: 0.25s;
        }

        #mobile-menu.menu-opened nav a:nth-child(5) {
            transition-delay: 0.3s;
        }

        #mobile-menu nav div {
            transform: translateX(-20px);
            opacity: 0;
            transition: all 0.3s ease;
        }

        #mobile-menu.menu-opened nav div {
            transform: translateX(0);
            opacity: 1;
            transition: all 0.3s ease;
            transition-delay: 0.3s;
        }

        #mobile-menu nav div {
            transform: translateX(-20px);
            opacity: 0;
            transition: all 0.3s ease;
        }

        /* Mobile menu button enhanced animation */
        #mobile-menu-button {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        #mobile-menu-button:hover {
            transform: scale(1.1);
        }

        #mobile-menu-button:active {
            transform: scale(0.95);
        }

        /* Hamburger to X animation */
        #mobile-menu-button svg {
            transition: transform 0.3s ease;
        }

        #mobile-menu-button.menu-open svg {
            transform: rotate(90deg);
        }

        html,
        body {
            margin: 0 !important;
            height: 100%;
        }

        html {
            /* Reserve space for scrollbar to avoid layout shift (Chromium/modern browsers) */
            scrollbar-gutter: stable both-edges;
        }

        body {
            padding-top: 0 !important;
            overflow-y: auto;
            -webkit-overflow-scrolling: touch;
        }

        /* While loader active, lock scroll to prevent mid-load jump */
        body.is-loading {
            overflow-y: hidden;
        }

        main {
            /* Will receive dynamic padding via JS */
        }

        /* Simple loader container styles for your existing loader */
        .page-loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            /* Transparent glass overlay with backdrop blur */
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

        /* Page transition effects */
        .page-content {
            /* Visible by default so content is present under the transparent loader */
            opacity: 1;
            transition: filter 0.3s ease, opacity 0.3s ease;
            will-change: filter;
        }

        .page-content.loaded {
            opacity: 1;
        }

        /* While loader is visible, show and blur the underlying page content */
        .page-loader:not(.hidden)~#pageContent {
            opacity: 1;
            /* make content visible under transparent overlay */
            filter: blur(8px);
        }

        /* Extra safety: if body is in loading state, blur content */
        body.is-loading #pageContent {
            filter: blur(8px);
        }

        @media (max-width: 900px) {
            #main-navbar nav.hidden.md\:flex {
                gap: 1.25rem;
            }
        }
    </style>
    @stack('head')
</head>

<body class="bg-gray-50 text-gray-800 overflow-x-hidden is-loading">
    {{-- Include Your Existing Loader --}}
    @include('layouts.loader')

    {{-- Conditionally show header based on authentication --}}
    @auth
        {{-- Authenticated header with user profile dropdown --}}
        @include('layouts.auth-header')
    @else
        {{-- Public header with login button --}}
        @include('layouts.header')
    @endauth

    <!-- Page Content -->
    <div id="pageContent" class="page-content">
        <main>
            @yield('content')
        </main>
        @include('layouts.footer')
    </div>
    @stack('scripts')

    <script>
        // Page Loader Functionality for your existing loader
        document.addEventListener('DOMContentLoaded', function() {
            const loader = document.getElementById('pageLoader');
            const content = document.getElementById('pageContent');
            document.body.classList.add('is-loading');

            // Minimum load time to avoid flash
            const minLoadTime = 700; // ms
            const startTime = Date.now();

            // Wait for all resources to load
            window.addEventListener('load', function() {
                const elapsedTime = Date.now() - startTime;
                const remainingTime = Math.max(0, minLoadTime - elapsedTime);

                setTimeout(function() {
                    // Show content first to avoid brief opacity drop when hiding overlay
                    if (content) {
                        content.classList.add('loaded');
                    }
                    // Then hide loader
                    if (loader) {
                        loader.classList.add('hidden');
                    }
                    document.body.classList.remove('is-loading');
                }, remainingTime);
            });
        });

        // Show loader on internal navigation (links/forms) to avoid white flash before next page renders
        (function() {
            function shouldUseLoaderForLink(a) {
                if (!a) return false;
                const href = a.getAttribute('href');
                if (!href || href.startsWith('#') || href.startsWith('mailto:') || href.startsWith('tel:'))
                    return false;
                if (a.target === '_blank' || a.hasAttribute('download') || a.dataset.noLoader === 'true') return false;
                // Consider internal if starts with "/" or same origin
                try {
                    const url = new URL(href, window.location.href);
                    return url.origin === window.location.origin;
                } catch {
                    return false;
                }
            }

            function showLoaderOverlay() {
                const loader = document.getElementById('pageLoader');
                if (loader) {
                    loader.classList.remove('hidden');
                }
                document.body.classList.add('is-loading');
            }

            document.addEventListener('click', function(e) {
                const a = e.target.closest('a');
                if (shouldUseLoaderForLink(a)) {
                    // Show overlay before navigating
                    showLoaderOverlay();
                }
            }, true);

            document.addEventListener('submit', function(e) {
                const form = e.target;
                if (!form || form.target === '_blank' || form.dataset.noLoader === 'true') return;
                showLoaderOverlay();
            }, true);
        })();

        // NAVBAR FIXED POSITIONING SCRIPT
        document.addEventListener('DOMContentLoaded', function() {
            const navbar = document.getElementById('main-navbar');
            const mainEl = document.querySelector('main');

            function applyOffset() {
                if (navbar && mainEl) {
                    const h = navbar.offsetHeight; // actual height
                    mainEl.style.paddingTop = h + 'px';
                }
            }
            if (navbar) {
                applyOffset();
                window.addEventListener('resize', applyOffset);
            }
        });

        // Global navbar scroll behavior + shadow toggle
        function updateNavbarOnScroll() {
            const navbar = document.getElementById('main-navbar');
            if (!navbar) return;
            const scrolled = window.scrollY > 2;
            if (scrolled) {
                navbar.classList.add('nav-shadow');
                navbar.style.backdropFilter = 'blur(20px) saturate(180%)';
                navbar.style.backgroundColor = 'rgba(255, 255, 255, 0.95)';
            } else {
                navbar.classList.remove('nav-shadow');
                navbar.style.backdropFilter = 'blur(16px) saturate(180%)';
                navbar.style.backgroundColor = 'rgba(255, 255, 255, 0.9)';
            }
        }

        window.addEventListener('scroll', updateNavbarOnScroll, {
            passive: true
        });
        window.addEventListener('load', updateNavbarOnScroll);
        document.addEventListener('DOMContentLoaded', updateNavbarOnScroll);

        // Mobile menu toggle functionality
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');

            if (mobileMenuButton && mobileMenu) {
                mobileMenuButton.addEventListener('click', function() {
                    const isOpen = mobileMenu.classList.contains('menu-opened');
                    if (isOpen) {
                        mobileMenu.classList.remove('menu-opened');
                        mobileMenuButton.classList.remove('menu-open');
                    } else {
                        mobileMenu.classList.add('menu-opened');
                        mobileMenuButton.classList.add('menu-open');
                    }
                });

                // Close mobile menu when clicking on a link
                const mobileLinks = mobileMenu.querySelectorAll('a');
                mobileLinks.forEach(link => {
                    link.addEventListener('click', function() {
                        mobileMenu.classList.remove('menu-opened');
                        mobileMenuButton.classList.remove('menu-open');
                    });
                });

                // Close menu when clicking outside
                document.addEventListener('click', function(event) {
                    if (!mobileMenuButton.contains(event.target) && !mobileMenu.contains(event.target)) {
                        if (mobileMenu.classList.contains('menu-opened')) {
                            mobileMenu.classList.remove('menu-opened');
                            mobileMenuButton.classList.remove('menu-open');
                        }
                    }
                });
            }
        }); // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Removed exit fade animation to avoid white flash; loader overlay handles transitions
    </script>
</body>

</html>
