{{-- User Authenticated Dashboard/Welcome Page --}}
@extends('layouts.auth-app')

@section('title', 'Dashboard - JeevanPravaah')

@section('content')
    <!-- Hero Section -->
    <section class="relative min-h-screen flex items-center justify-center hero-gradient pt-16">
        <!-- Simplified background pattern for better performance -->
        <div class="absolute inset-0 opacity-30">
            <div class="absolute top-1/4 left-1/4 w-64 h-64 bg-red-100 rounded-full filter blur-3xl"></div>
            <div class="absolute bottom-1/4 right-1/4 w-80 h-80 bg-red-200 rounded-full filter blur-3xl"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <!-- Welcome message for authenticated user -->
            <div class="mb-8" data-aos="fade-down">
                <div
                    class="inline-flex items-center gap-2 px-6 py-3 bg-white/90 backdrop-blur-sm rounded-full shadow-lg mb-4">
                    <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="text-sm font-semibold text-gray-700">Welcome back, <span
                            class="text-red-500">{{ Auth::user()->name ?? 'User' }}</span>!</span>
                </div>
            </div>

            <!-- Optimized animated heart icon -->
            <div class="mb-6" data-aos="fade-down">
                <div
                    class="w-16 h-16 mx-auto bg-red-500 rounded-full flex items-center justify-center shadow-lg pulse-effect">
                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24" aria-label="Heart icon">
                        <path
                            d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                    </svg>
                </div>
            </div>

            <!-- Optimized typography with better hierarchy -->
            <h1 class="text-4xl sm:text-5xl lg:text-6xl xl:text-7xl font-black mb-6 text-gray-900 leading-tight tracking-tight"
                data-aos="fade-up">
                Continue Saving Lives with <span class="text-red-500 relative">
                    Jeevan Pravaah
                    <div class="absolute -bottom-2 left-0 w-full h-1 bg-gradient-to-r from-red-400 to-red-500 rounded-full">
                    </div>
                </span>
            </h1>

            <p class="text-lg sm:text-xl lg:text-2xl text-gray-600 mb-8 leading-relaxed max-w-4xl mx-auto font-medium"
                data-aos="fade-up" data-aos-delay="200">
                You're part of an amazing community of heroes. Every donation saves up to <strong class="text-red-500">three
                    lives</strong>.<br>
                Ready to make a difference today?
            </p>

            <!-- Improved CTA buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center mb-12" data-aos="fade-up" data-aos-delay="400">
                <a href="/donate"
                    class="group px-8 py-4 bg-red-500 hover:bg-red-600 text-white font-bold rounded-full transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl focus:outline-none focus:ring-4 focus:ring-red-300 inline-flex items-center justify-center">
                    <svg class="w-5 h-5 mr-2 group-hover:animate-pulse" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
                            clip-rule="evenodd" />
                    </svg>
                    Donate Blood Now
                </a>
                <a href="#features"
                    class="px-8 py-4 bg-white border-2 border-red-500 text-red-500 hover:bg-red-500 hover:text-white font-bold rounded-full transition-all duration-300 hover:shadow-lg focus:outline-none focus:ring-4 focus:ring-red-300">
                    View My History
                </a>
            </div>

            <!-- Optimized Stats Section -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mt-12 max-w-5xl mx-auto" data-aos="fade-up"
                data-aos-delay="600">
                <div class="glass-card rounded-2xl p-4 sm:p-6 hover-lift text-center group cursor-pointer">
                    <div class="text-2xl sm:text-3xl font-black text-red-500 mb-1 stats-counter group-hover:scale-110 transition-transform duration-300"
                        data-target="25000">0</div>
                    <div class="text-sm sm:text-base text-gray-600 font-semibold">Lives Saved</div>
                    <div class="text-xs text-gray-400 mt-1">and counting...</div>
                </div>
                <div class="glass-card rounded-2xl p-4 sm:p-6 hover-lift text-center group cursor-pointer">
                    <div class="text-2xl sm:text-3xl font-black text-red-500 mb-1 stats-counter group-hover:scale-110 transition-transform duration-300"
                        data-target="15000">0</div>
                    <div class="text-sm sm:text-base text-gray-600 font-semibold">Active Donors</div>
                    <div class="text-xs text-gray-400 mt-1">verified heroes</div>
                </div>
                <div class="glass-card rounded-2xl p-4 sm:p-6 hover-lift text-center group cursor-pointer">
                    <div class="text-2xl sm:text-3xl font-black text-red-500 mb-1 stats-counter group-hover:scale-110 transition-transform duration-300"
                        data-target="500">0</div>
                    <div class="text-sm sm:text-base text-gray-600 font-semibold">Hospitals</div>
                    <div class="text-xs text-gray-400 mt-1">partner network</div>
                </div>
                <div class="glass-card rounded-2xl p-4 sm:p-6 hover-lift text-center group cursor-pointer">
                    <div class="text-2xl sm:text-3xl font-black text-red-500 mb-1 stats-counter group-hover:scale-110 transition-transform duration-300"
                        data-target="24">0</div>
                    <div class="text-sm sm:text-base text-gray-600 font-semibold">Cities</div>
                    <div class="text-xs text-gray-400 mt-1">nationwide</div>
                </div>
            </div>
        </div>

        <!-- Scroll indicator -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
            <a href="#features" class="text-gray-400 hover:text-red-500 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3">
                    </path>
                </svg>
            </a>
        </div>
    </section>

    <!-- Quick Actions Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-black text-gray-900 text-center mb-12">Quick Actions</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Card 1 -->
                <div class="glass-card rounded-2xl p-6 hover-lift text-center cursor-pointer">
                    <div class="w-16 h-16 mx-auto bg-red-100 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Schedule Donation</h3>
                    <p class="text-gray-600 mb-4">Book your next blood donation appointment</p>
                    <a href="#" class="text-red-500 font-semibold hover:underline">Schedule Now →</a>
                </div>

                <!-- Card 2 -->
                <div class="glass-card rounded-2xl p-6 hover-lift text-center cursor-pointer">
                    <div class="w-16 h-16 mx-auto bg-blue-100 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                            <path fill-rule="evenodd"
                                d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">View History</h3>
                    <p class="text-gray-600 mb-4">Check your donation records and impact</p>
                    <a href="#" class="text-blue-500 font-semibold hover:underline">View History →</a>
                </div>

                <!-- Card 3 -->
                <div class="glass-card rounded-2xl p-6 hover-lift text-center cursor-pointer">
                    <div class="w-16 h-16 mx-auto bg-green-100 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Update Profile</h3>
                    <p class="text-gray-600 mb-4">Keep your information up to date</p>
                    <a href="#" class="text-green-500 font-semibold hover:underline">Edit Profile →</a>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        // Stats counter animation
        function animateCounter(element) {
            const target = parseInt(element.getAttribute('data-target'));
            const duration = 2000;
            const step = target / (duration / 16);
            let current = 0;

            const counter = setInterval(() => {
                current += step;
                if (current >= target) {
                    element.textContent = target.toLocaleString();
                    clearInterval(counter);
                } else {
                    element.textContent = Math.floor(current).toLocaleString();
                }
            }, 16);
        }

        // Trigger animation when stats are visible
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const counters = entry.target.querySelectorAll('.stats-counter');
                    counters.forEach(counter => animateCounter(counter));
                    observer.unobserve(entry.target);
                }
            });
        });

        document.addEventListener('DOMContentLoaded', () => {
            const statsSection = document.querySelector('.grid');
            if (statsSection) observer.observe(statsSection);
        });
    </script>
@endpush
