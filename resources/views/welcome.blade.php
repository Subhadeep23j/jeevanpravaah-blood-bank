{{-- HMR test: this comment exists only to trigger a reload --}}
@extends('layouts.app')

@section('title', 'JeevanPravaah - Modern Blood Bank')

@section('content')
    <!-- Hero Section -->
    <section class="relative min-h-screen flex items-center justify-center hero-gradient pt-16">
        <!-- Simplified background pattern for better performance -->
        <div class="absolute inset-0 opacity-30">
            <div class="absolute top-1/4 left-1/4 w-64 h-64 bg-red-100 rounded-full filter blur-3xl"></div>
            <div class="absolute bottom-1/4 right-1/4 w-80 h-80 bg-red-200 rounded-full filter blur-3xl"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
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
                Save Lives with <span class="text-red-500 relative">
                    Jeevan Pravaah
                    <div class="absolute -bottom-2 left-0 w-full h-1 bg-gradient-to-r from-red-400 to-red-500 rounded-full">
                    </div>
                </span>
            </h1>

            <p class="text-lg sm:text-xl lg:text-2xl text-gray-600 mb-8 leading-relaxed max-w-4xl mx-auto font-medium"
                data-aos="fade-up" data-aos-delay="200">
                Connect blood donors with those in need. Every donation saves up to <strong class="text-red-500">three
                    lives</strong>.<br>
                Join our community of life savers today.
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
                    Learn More
                </a>
            </div>

            <!-- Optimized Stats Section -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mt-12 max-w-5xl mx-auto" data-aos="fade-up"
                data-aos-delay="600">
                <div class="glass-card rounded-2xl p-4 sm:p-6 hover-lift text-center group cursor-pointer">
                    <div class="text-2xl sm:text-3xl font-black text-red-500 mb-1 stats-counter group-hover:scale-110 transition-transform duration-300"
                        data-target="{{ $stats['lives_saved'] > 0 ? $stats['lives_saved'] : 25000 }}">0</div>
                    <div class="text-sm sm:text-base text-gray-600 font-semibold">Lives Saved</div>
                    <div class="text-xs text-gray-400 mt-1">and counting...</div>
                </div>
                <div class="glass-card rounded-2xl p-4 sm:p-6 hover-lift text-center group cursor-pointer">
                    <div class="text-2xl sm:text-3xl font-black text-red-500 mb-1 stats-counter group-hover:scale-110 transition-transform duration-300"
                        data-target="{{ $stats['active_donors'] > 0 ? $stats['active_donors'] : $stats['registered_users'] }}">
                        0</div>
                    <div class="text-sm sm:text-base text-gray-600 font-semibold">Active Donors</div>
                    <div class="text-xs text-gray-400 mt-1">verified heroes</div>
                </div>
                <div class="glass-card rounded-2xl p-4 sm:p-6 hover-lift text-center group cursor-pointer">
                    <div class="text-2xl sm:text-3xl font-black text-red-500 mb-1 stats-counter group-hover:scale-110 transition-transform duration-300"
                        data-target="{{ $stats['registered_users'] > 0 ? $stats['registered_users'] : 500 }}">0</div>
                    <div class="text-sm sm:text-base text-gray-600 font-semibold">Registered Users</div>
                    <div class="text-xs text-gray-400 mt-1">growing community</div>
                </div>
                <div class="glass-card rounded-2xl p-4 sm:p-6 hover-lift text-center group cursor-pointer">
                    <div class="text-2xl sm:text-3xl font-black text-red-500 mb-1 stats-counter group-hover:scale-110 transition-transform duration-300"
                        data-target="{{ $stats['cities'] > 0 ? $stats['cities'] : 24 }}">0</div>
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

    <!-- Enhanced Features Section -->
    <section id="features" class="py-16 sm:py-24 bg-white relative overflow-hidden">
        <!-- Background decoration -->
        <div
            class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-bl from-red-50 to-transparent rounded-full transform translate-x-32 -translate-y-32">
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 sm:mb-16" data-aos="fade-up">
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black mb-4 text-gray-900">
                    Why Choose <span class="text-red-500">JeevanPravaah?</span>
                </h2>
                <div class="w-24 h-1 bg-gradient-to-r from-red-400 to-red-500 mx-auto rounded-full mb-6"></div>
                <p class="text-lg sm:text-xl text-gray-600 max-w-3xl mx-auto font-medium leading-relaxed">
                    We make blood donation simple, safe, and meaningful for everyone involved
                </p>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                <div class="group glass-card rounded-3xl p-6 sm:p-8 hover-lift relative overflow-hidden border-2 border-transparent hover:border-red-100 transition-all duration-300"
                    data-aos="fade-up" data-aos-delay="100">
                    <div
                        class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-red-400 to-red-500 transform origin-left scale-x-0 group-hover:scale-x-100 transition-transform duration-300">
                    </div>
                    <div
                        class="w-14 h-14 bg-gradient-to-br from-red-50 to-red-100 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-7 h-7 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl sm:text-2xl font-bold text-gray-800 mb-4 group-hover:text-red-600 transition-colors">
                        Instant Matching</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Our AI-powered algorithm instantly connects donors with recipients based on blood type, location,
                        and real-time availability.
                    </p>
                </div>

                <div class="group glass-card rounded-3xl p-6 sm:p-8 hover-lift relative overflow-hidden border-2 border-transparent hover:border-red-100 transition-all duration-300"
                    data-aos="fade-up" data-aos-delay="200">
                    <div
                        class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-red-400 to-red-500 transform origin-left scale-x-0 group-hover:scale-x-100 transition-transform duration-300">
                    </div>
                    <div
                        class="w-14 h-14 bg-gradient-to-br from-red-50 to-red-100 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-7 h-7 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                            </path>
                        </svg>
                    </div>
                    <h3
                        class="text-xl sm:text-2xl font-bold text-gray-800 mb-4 group-hover:text-red-600 transition-colors">
                        100% Verified</h3>
                    <p class="text-gray-600 leading-relaxed">
                        All donors undergo comprehensive medical screening. Every donation follows WHO safety protocols and
                        quality guidelines.
                    </p>
                </div>

                <div class="group glass-card rounded-3xl p-6 sm:p-8 hover-lift relative overflow-hidden border-2 border-transparent hover:border-red-100 transition-all duration-300 sm:col-span-2 lg:col-span-1"
                    data-aos="fade-up" data-aos-delay="300">
                    <div
                        class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-red-400 to-red-500 transform origin-left scale-x-0 group-hover:scale-x-100 transition-transform duration-300">
                    </div>
                    <div
                        class="w-14 h-14 bg-gradient-to-br from-red-50 to-red-100 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-7 h-7 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3
                        class="text-xl sm:text-2xl font-bold text-gray-800 mb-4 group-hover:text-red-600 transition-colors">
                        24/7 Emergency</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Round-the-clock emergency support with instant notifications. Because every second counts when
                        saving lives.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Streamlined How It Works -->
    <section class="py-16 sm:py-24 bg-gradient-to-b from-gray-50 to-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 sm:mb-16" data-aos="fade-up">
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black text-gray-900 mb-4">
                    How It <span class="text-red-500">Works</span>
                </h2>
                <div class="w-24 h-1 bg-gradient-to-r from-red-400 to-red-500 mx-auto rounded-full mb-6"></div>
                <p class="text-lg sm:text-xl text-gray-600 font-medium">Three simple steps to save lives</p>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8 relative">
                <!-- Connection lines for desktop -->
                <div
                    class="hidden lg:block absolute top-1/2 left-1/3 w-1/3 h-0.5 bg-gradient-to-r from-red-200 to-red-300 transform -translate-y-1/2">
                </div>
                <div
                    class="hidden lg:block absolute top-1/2 right-1/3 w-1/3 h-0.5 bg-gradient-to-r from-red-200 to-red-300 transform -translate-y-1/2">
                </div>

                <div class="text-center group" data-aos="fade-up" data-aos-delay="100">
                    <div class="relative mb-6">
                        <div
                            class="w-20 h-20 bg-gradient-to-br from-red-500 to-red-600 rounded-full flex items-center justify-center mx-auto shadow-lg group-hover:scale-110 transition-all duration-300">
                            <span class="text-2xl font-black text-white">1</span>
                        </div>
                        <div class="absolute inset-0 w-20 h-20 bg-red-300 rounded-full mx-auto animate-ping opacity-20">
                        </div>
                    </div>
                    <h3
                        class="text-xl sm:text-2xl font-bold text-gray-800 mb-4 group-hover:text-red-600 transition-colors">
                        Quick Registration</h3>
                    <p class="text-gray-600 leading-relaxed max-w-xs mx-auto">
                        Sign up in 2 minutes and get verified by our healthcare partners instantly.
                    </p>
                </div>

                <div class="text-center group" data-aos="fade-up" data-aos-delay="200">
                    <div class="relative mb-6">
                        <div
                            class="w-20 h-20 bg-gradient-to-br from-red-500 to-red-600 rounded-full flex items-center justify-center mx-auto shadow-lg group-hover:scale-110 transition-all duration-300">
                            <span class="text-2xl font-black text-white">2</span>
                        </div>
                        <div class="absolute inset-0 w-20 h-20 bg-red-300 rounded-full mx-auto animate-ping opacity-20"
                            style="animation-delay: 0.5s;"></div>
                    </div>
                    <h3
                        class="text-xl sm:text-2xl font-bold text-gray-800 mb-4 group-hover:text-red-600 transition-colors">
                        Smart Matching</h3>
                    <p class="text-gray-600 leading-relaxed max-w-xs mx-auto">
                        Get instant notifications when someone nearby urgently needs your blood type.
                    </p>
                </div>

                <div class="text-center group sm:col-span-2 lg:col-span-1" data-aos="fade-up" data-aos-delay="300">
                    <div class="relative mb-6">
                        <div
                            class="w-20 h-20 bg-gradient-to-br from-red-500 to-red-600 rounded-full flex items-center justify-center mx-auto shadow-lg group-hover:scale-110 transition-all duration-300">
                            <span class="text-2xl font-black text-white">3</span>
                        </div>
                        <div class="absolute inset-0 w-20 h-20 bg-red-300 rounded-full mx-auto animate-ping opacity-20"
                            style="animation-delay: 1s;"></div>
                    </div>
                    <h3
                        class="text-xl sm:text-2xl font-bold text-gray-800 mb-4 group-hover:text-red-600 transition-colors">
                        Save Lives</h3>
                    <p class="text-gray-600 leading-relaxed max-w-xs mx-auto">
                        Donate at verified centers and make a real difference. Track your impact!
                    </p>
                </div>
            </div>

            <!-- Enhanced CTA -->
            <div class="text-center mt-12" data-aos="fade-up" data-aos-delay="400">
                <a href="/donate"
                    class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white font-bold rounded-full transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl group">
                    <svg class="w-5 h-5 mr-2 group-hover:animate-pulse" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
                            clip-rule="evenodd" />
                    </svg>
                    Start Your Hero Journey
                </a>
            </div>
        </div>
    </section>

    <!-- Enhanced Final CTA Section -->
    <section class="py-20 sm:py-28 bg-gradient-to-br from-red-50 via-red-100 to-red-100 relative overflow-hidden">
        <!-- Animated background elements -->
        <div
            class="absolute top-0 left-0 w-72 h-72 bg-gradient-to-br from-red-200 to-transparent rounded-full filter blur-3xl opacity-30 animate-pulse">
        </div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-gradient-to-tl from-red-200 to-transparent rounded-full filter blur-3xl opacity-30 animate-pulse"
            style="animation-delay: 1s;"></div>

        <div class="relative z-10 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <!-- Floating heart icon -->
            <div class="mb-8" data-aos="zoom-in">
                <div
                    class="w-20 h-20 mx-auto bg-gradient-to-br from-red-500 to-red-600 rounded-full flex items-center justify-center shadow-2xl pulse-effect">
                    <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                    </svg>
                </div>
            </div>

            <h2 class="text-4xl sm:text-5xl lg:text-6xl font-black mb-6 text-gray-900 leading-tight" data-aos="fade-up">
                Ready to <span class="text-red-500">Save Lives?</span>
            </h2>
            <div class="w-32 h-1.5 bg-gradient-to-r from-red-400 via-red-500 to-red-600 mx-auto mb-8 rounded-full"
                data-aos="fade-up" data-aos-delay="200"></div>

            <p class="text-xl sm:text-2xl text-gray-700 mb-8 leading-relaxed max-w-4xl mx-auto font-medium"
                data-aos="fade-up" data-aos-delay="300">
                Join <strong
                    class="text-red-600">{{ number_format($stats['registered_users'] > 0 ? $stats['registered_users'] : 25000) }}+</strong>
                heroes who have already registered.<br class="hidden sm:block">
                Your donation could be the difference between <span class="text-red-500 font-semibold">life and
                    death</span>.
            </p>

            <!-- Urgency indicators -->
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 sm:gap-8 mb-10 text-sm font-semibold"
                data-aos="fade-up" data-aos-delay="400">
                <div class="flex items-center text-red-600">
                    <div class="w-3 h-3 bg-red-500 rounded-full mr-2 animate-pulse"></div>
                    <span>{{ $stats['pending_requests'] > 0 ? $stats['pending_requests'] : 120 }}+ requests today</span>
                </div>
                <div class="flex items-center text-red-600">
                    <div class="w-3 h-3 bg-red-500 rounded-full mr-2 animate-pulse" style="animation-delay: 0.5s;"></div>
                    <span>Emergency shortage: {{ $shortageBloodGroup ?? 'O-' }} blood</span>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row gap-4 justify-center" data-aos="fade-up" data-aos-delay="500">
                <a href="/donate"
                    class="group inline-flex items-center px-10 py-5 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white font-bold text-lg rounded-full transition-all duration-300 transform hover:scale-105 shadow-2xl hover:shadow-red-200 focus:outline-none focus:ring-4 focus:ring-red-300">
                    <svg class="w-6 h-6 mr-3 group-hover:animate-pulse" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
                            clip-rule="evenodd" />
                    </svg>
                    Become a Hero Now
                    <span class="ml-2 bg-red-400 text-xs px-2 py-1 rounded-full animate-pulse">FREE</span>
                </a>

                <a href="/about"
                    class="inline-flex items-center px-10 py-5 bg-white border-2 border-red-500 text-red-600 hover:bg-red-500 hover:text-white font-bold text-lg rounded-full transition-all duration-300 hover:shadow-lg focus:outline-none focus:ring-4 focus:ring-red-300">
                    Learn Our Story
                </a>
            </div>

            <!-- Trust indicators -->
            <div class="mt-12 text-center" data-aos="fade-up" data-aos-delay="600">
                <div class="text-sm text-gray-600 mb-4 font-medium">Trusted by leading hospitals & verified by WHO
                    guidelines</div>
                <div class="flex justify-center items-center space-x-6 opacity-60">
                    <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="text-xs font-semibold text-gray-500">WHO VERIFIED</div>
                    <div class="w-1 h-6 bg-gray-300"></div>
                    <div class="text-xs font-semibold text-gray-500">ISO CERTIFIED</div>
                    <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                            </path>
                        </svg>
                    </div>
                @endsection

                @push('head')
                    <style>
                        .heart-beat {
                            animation: heart-beat 2s ease-in-out infinite;
                        }

                        @keyframes heart-beat {

                            0%,
                            100% {
                                transform: scale(1);
                            }

                            50% {
                                transform: scale(1.1);
                            }
                        }

                        .stats-counter {
                            font-variant-numeric: tabular-nums;
                        }

                        .feature-icon-bg {
                            background: linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%);
                        }

                        .cta-gradient {
                            background: linear-gradient(135deg, #fef2f2 0%, #fee2e2 50%, #fecaca 100%);
                        }
                    </style>
                @endpush

                @push('scripts')
                    <script>
                        // Stats counter animation
                        function animateCounter(element) {
                            const target = parseInt(element.getAttribute('data-target'));
                            const increment = target / 50;
                            let current = 0;

                            const timer = setInterval(() => {
                                current += increment;
                                if (current >= target) {
                                    element.textContent = target.toLocaleString();
                                    clearInterval(timer);
                                } else {
                                    element.textContent = Math.floor(current).toLocaleString();
                                }
                            }, 40);
                        }

                        // Intersection Observer for stats
                        const observerOptions = {
                            threshold: 0.1,
                            rootMargin: '0px 0px -100px 0px'
                        };

                        const observer = new IntersectionObserver((entries) => {
                            entries.forEach(entry => {
                                if (entry.isIntersecting) {
                                    const counters = entry.target.querySelectorAll('.stats-counter');
                                    counters.forEach(counter => {
                                        if (!counter.classList.contains('animated')) {
                                            counter.classList.add('animated');
                                            animateCounter(counter);
                                        }
                                    });
                                }
                            });
                        }, observerOptions);

                        // Observe stats section
                        document.addEventListener('DOMContentLoaded', () => {
                            const statsSection = document.querySelector('.stats-counter').closest('.grid');
                            if (statsSection) {
                                observer.observe(statsSection);
                            }
                        });
                    </script>
                @endpush
