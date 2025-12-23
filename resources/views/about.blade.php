@extends('layouts.app')

@section('title', 'About Us - JeevanPravaah')

@section('content')
    <!-- Hero Section -->
    <section class="relative py-32 hero-gradient">
        <div
            class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=\"60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cg fill=\"none\" fill-rule=\"evenodd\"%3E%3Cg fill=\"%23ef4444\" fill-opacity=\"0.03\"%3E%3Ccircle cx=\"30\" cy=\"30\" r=\"2\" /%3E%3C/g%3E%3C/g%3E%3C/svg%3E')]
            opacity-50">
        </div>
        <div class="relative z-10 max-w-4xl mx-auto px-6 text-center">
            <div class="floating-animation mb-8">
                <svg class="w-24 h-24 text-red-500 mx-auto heart-pulse" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                </svg>
            </div>
            <h1 class="text-5xl md:text-6xl font-bold mb-6 text-gray-800">About JeevanPravaah</h1>
            <div class="w-32 h-1 bg-gradient-to-r from-red-400 to-pink-400 mx-auto mb-8 rounded-full"></div>
            <p class="text-xl text-gray-700 leading-relaxed max-w-3xl mx-auto">
                We believe that every drop of blood has the power to save a life. Our mission is to bridge the gap between
                those who need blood and those who are willing to give.
            </p>
        </div>
    </section>

    <!-- Our Story Section -->
    <section class="py-24 bg-white">
        <div class="max-w-6xl mx-auto px-6">
            <div class="grid md:grid-cols-2 gap-16 items-center">
                <div>
                    <h2 class="text-4xl font-bold text-gray-800 mb-6">Our Story</h2>
                    <div class="w-20 h-1 bg-gradient-to-r from-red-400 to-pink-400 mb-8 rounded-full"></div>
                    <div class="space-y-6 text-gray-600 leading-relaxed">
                        <p>
                            JeevanPravaah was born from a simple yet profound realization: in emergency situations, the
                            difference between life and death often comes down to the availability of blood. Too many lives
                            were being lost not because of inadequate medical care, but because the right blood type wasn't
                            available at the right time.
                        </p>
                        <p>
                            Founded in 2023, our platform was created by a team of healthcare professionals, technology
                            experts, and social activists who witnessed firsthand the challenges faced by patients and their
                            families during critical moments. We saw how fragmented the blood donation system was and knew
                            there had to be a better way.
                        </p>
                        <p>
                            Today, JeevanPravaah has grown into a trusted network that connects thousands of generous donors
                            with those in desperate need, making the process of blood donation more accessible, transparent,
                            and efficient than ever before.
                        </p>
                    </div>
                </div>
                <div class="relative">
                    <div class="glass-card rounded-3xl p-8 hover-lift">
                        <div class="grid grid-cols-2 gap-6 text-center">
                            <div class="p-4">
                                <div class="text-3xl font-bold text-red-500 mb-2">
                                    {{ number_format($stats['lives_saved'] > 0 ? $stats['lives_saved'] : 25000) }}+</div>
                                <div class="text-gray-600 text-sm font-medium">Lives Saved</div>
                            </div>
                            <div class="p-4">
                                <div class="text-3xl font-bold text-red-500 mb-2">
                                    {{ number_format($stats['active_donors'] > 0 ? $stats['active_donors'] : 15000) }}+
                                </div>
                                <div class="text-gray-600 text-sm font-medium">Active Donors</div>
                            </div>
                            <div class="p-4">
                                <div class="text-3xl font-bold text-red-500 mb-2">
                                    {{ number_format($stats['registered_users'] > 0 ? $stats['registered_users'] : 500) }}+
                                </div>
                                <div class="text-gray-600 text-sm font-medium">Registered Users</div>
                            </div>
                            <div class="p-4">
                                <div class="text-3xl font-bold text-red-500 mb-2">
                                    {{ $stats['cities'] > 0 ? $stats['cities'] : 50 }}+</div>
                                <div class="text-gray-600 text-sm font-medium">Cities</div>
                            </div>
                        </div>
                        <div class="mt-6 p-4 bg-red-50 rounded-2xl text-center">
                            <p class="text-red-800 font-semibold">Making a difference every day</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission & Vision Section -->
    <section class="py-24 bg-gray-50">
        <div class="max-w-6xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-800 mb-6">Our Mission & Vision</h2>
                <div class="w-24 h-1 bg-gradient-to-r from-red-400 to-pink-400 mx-auto rounded-full"></div>
            </div>

            <div class="grid md:grid-cols-2 gap-12">
                <div class="glass-card rounded-3xl p-10 hover-lift border border-red-100">
                    <div class="w-16 h-16 feature-icon-bg rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Our Mission</h3>
                    <p class="text-gray-600 leading-relaxed">
                        To create a seamless, technology-driven platform that connects blood donors with patients in need,
                        ensuring that no life is lost due to blood unavailability. We strive to make blood donation
                        accessible, safe, and rewarding for everyone involved.
                    </p>
                </div>

                <div class="glass-card rounded-3xl p-10 hover-lift border border-red-100">
                    <div class="w-16 h-16 feature-icon-bg rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Our Vision</h3>
                    <p class="text-gray-600 leading-relaxed">
                        To build a world where blood shortage is never a barrier to saving lives. We envision a future where
                        every person in need has immediate access to safe blood, supported by a community of compassionate
                        donors ready to help.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Core Values Section -->
    <section class="py-24 bg-white">
        <div class="max-w-6xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-800 mb-6">Our Core Values</h2>
                <div class="w-24 h-1 bg-gradient-to-r from-red-400 to-pink-400 mx-auto rounded-full mb-4"></div>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    The principles that guide everything we do at JeevanPravaah
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="glass-card rounded-3xl p-8 hover-lift border border-red-100 text-center">
                    <div class="w-20 h-20 feature-icon-bg rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                            </path>
                        </svg>
                    </div>
                    <h4 class="text-xl font-bold text-gray-800 mb-4">Compassion</h4>
                    <p class="text-gray-600 leading-relaxed">
                        We believe in the power of human kindness and empathy. Every interaction on our platform is guided
                        by genuine care for human life.
                    </p>
                </div>

                <div class="glass-card rounded-3xl p-8 hover-lift border border-red-100 text-center">
                    <div class="w-20 h-20 feature-icon-bg rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.031 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                            </path>
                        </svg>
                    </div>
                    <h4 class="text-xl font-bold text-gray-800 mb-4">Trust & Safety</h4>
                    <p class="text-gray-600 leading-relaxed">
                        We maintain the highest standards of safety and verification, ensuring peace of mind for both donors
                        and recipients.
                    </p>
                </div>

                <div class="glass-card rounded-3xl p-8 hover-lift border border-red-100 text-center">
                    <div class="w-20 h-20 feature-icon-bg rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h4 class="text-xl font-bold text-gray-800 mb-4">Innovation</h4>
                    <p class="text-gray-600 leading-relaxed">
                        We leverage cutting-edge technology to make blood donation faster, easier, and more efficient than
                        ever before.
                    </p>
                </div>

                <div class="glass-card rounded-3xl p-8 hover-lift border border-red-100 text-center">
                    <div class="w-20 h-20 feature-icon-bg rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                            </path>
                        </svg>
                    </div>
                    <h4 class="text-xl font-bold text-gray-800 mb-4">Community</h4>
                    <p class="text-gray-600 leading-relaxed">
                        We foster a supportive community where people come together to help one another in times of need.
                    </p>
                </div>

                <div class="glass-card rounded-3xl p-8 hover-lift border border-red-100 text-center">
                    <div class="w-20 h-20 feature-icon-bg rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                            </path>
                        </svg>
                    </div>
                    <h4 class="text-xl font-bold text-gray-800 mb-4">Transparency</h4>
                    <p class="text-gray-600 leading-relaxed">
                        We believe in complete openness about our processes, ensuring donors and recipients know exactly how
                        their contributions make a difference.
                    </p>
                </div>

                <div class="glass-card rounded-3xl p-8 hover-lift border border-red-100 text-center">
                    <div class="w-20 h-20 feature-icon-bg rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                    </div>
                    <h4 class="text-xl font-bold text-gray-800 mb-4">Accessibility</h4>
                    <p class="text-gray-600 leading-relaxed">
                        We strive to make blood donation accessible to everyone, regardless of their location, background,
                        or technical expertise.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Impact Timeline -->
    <section class="py-24 bg-gray-50">
        <div class="max-w-4xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-800 mb-6">Our Journey</h2>
                <div class="w-24 h-1 bg-gradient-to-r from-red-400 to-pink-400 mx-auto rounded-full mb-4"></div>
                <p class="text-xl text-gray-600">Milestones that shaped JeevanPravaah</p>
            </div>

            <div class="relative">
                <div class="absolute left-1/2 transform -translate-x-px h-full w-0.5 bg-gray-300"></div>

                <div class="timeline-item space-y-8">
                    <div class="relative flex items-center">
                        <div class="flex-1 text-right pr-8">
                            <div class="glass-card rounded-2xl p-6 border border-red-100">
                                <h4 class="text-lg font-bold text-gray-800 mb-2">2023 - The Beginning</h4>
                                <p class="text-gray-600">JeevanPravaah was founded with a mission to revolutionize blood
                                    donation in India.</p>
                            </div>
                        </div>
                        <div class="w-4 h-4 bg-red-500 rounded-full border-4 border-white shadow-lg relative z-10"></div>
                        <div class="flex-1 pl-8"></div>
                    </div>
                </div>

                <div class="timeline-item space-y-8">
                    <div class="relative flex items-center">
                        <div class="flex-1 pr-8"></div>
                        <div class="w-4 h-4 bg-red-500 rounded-full border-4 border-white shadow-lg relative z-10"></div>
                        <div class="flex-1 text-left pl-8">
                            <div class="glass-card rounded-2xl p-6 border border-red-100">
                                <h4 class="text-lg font-bold text-gray-800 mb-2">2023 - First 1,000 Donors</h4>
                                <p class="text-gray-600">Reached our first milestone of 1,000 registered donors within 6
                                    months.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="timeline-item space-y-8">
                    <div class="relative flex items-center">
                        <div class="flex-1 text-right pr-8">
                            <div class="glass-card rounded-2xl p-6 border border-red-100">
                                <h4 class="text-lg font-bold text-gray-800 mb-2">2024 - Hospital Partnerships</h4>
                                <p class="text-gray-600">Partnered with 50+ hospitals across 10 cities to streamline blood
                                    requests.</p>
                            </div>
                        </div>
                        <div class="w-4 h-4 bg-red-500 rounded-full border-4 border-white shadow-lg relative z-10"></div>
                        <div class="flex-1 pl-8"></div>
                    </div>
                </div>

                <div class="timeline-item space-y-8">
                    <div class="relative flex items-center">
                        <div class="flex-1 pr-8"></div>
                        <div class="w-4 h-4 bg-red-500 rounded-full border-4 border-white shadow-lg relative z-10"></div>
                        <div class="flex-1 text-left pl-8">
                            <div class="glass-card rounded-2xl p-6 border border-red-100">
                                <h4 class="text-lg font-bold text-gray-800 mb-2">2024 - 10,000 Lives Saved</h4>
                                <p class="text-gray-600">Celebrated saving 10,000 lives through our platform and donor
                                    network.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="timeline-item space-y-8">
                    <div class="relative flex items-center">
                        <div class="flex-1 text-right pr-8">
                            <div class="glass-card rounded-2xl p-6 border border-red-100">
                                <h4 class="text-lg font-bold text-gray-800 mb-2">2025 - National Expansion</h4>
                                <p class="text-gray-600">Expanding to {{ $stats['cities'] > 0 ? $stats['cities'] : 50 }}+
                                    cities with
                                    {{ number_format($stats['active_donors'] > 0 ? $stats['active_donors'] : 15000) }}+
                                    active donors and
                                    {{ number_format($stats['registered_users'] > 0 ? $stats['registered_users'] : 500) }}+
                                    registered users.</p>
                            </div>
                        </div>
                        <div class="w-4 h-4 bg-red-500 rounded-full border-4 border-white shadow-lg relative z-10"></div>
                        <div class="flex-1 pl-8"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-24 bg-gradient-to-r from-red-50 to-pink-50 relative overflow-hidden">
        <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width="100" height="100" viewBox="0 0 100 100"
            xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill-rule="evenodd"%3E%3Cg fill="%23ef4444"
            fill-opacity="0.05"%3E%3Cpath
            d="M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3z"
            /%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-30"></div>

        <div class="relative z-10 max-w-4xl mx-auto px-6 text-center">
            <div class="heart-pulse inline-block mb-8">
                <svg class="w-16 h-16 text-red-500 mx-auto" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                </svg>
            </div>

            <h3 class="text-4xl md:text-5xl font-bold mb-6 text-gray-800">
                Join Our Life-Saving Mission
            </h3>
            <p class="text-xl text-gray-700 mb-12 leading-relaxed max-w-3xl mx-auto">
                Every donor who joins JeevanPravaah becomes part of a compassionate community dedicated to saving lives.
                Your participation can make the difference between life and death for someone in need.
            </p>

            <div class="flex flex-col sm:flex-row gap-6 justify-center">
                <button
                    class="group relative px-12 py-4 bg-red-500 hover:bg-red-600 text-white rounded-full font-bold text-lg transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                    <span class="flex items-center justify-center space-x-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                        </svg>
                        <span>Become a Donor</span>
                    </span>
                </button>
                <button
                    class="px-12 py-4 border-2 border-gray-400 hover:border-red-400 text-gray-700 hover:text-red-600 rounded-full font-bold text-lg hover:bg-white transition-all duration-300">
                    Contact Us
                </button>
            </div>
        </div>
    </section>

    @push('scripts')
        <script>
            // Timeline animation on scroll
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -100px 0px'
            };
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate');
                    }
                });
            }, observerOptions);
            // Observe all timeline items
            document.addEventListener('DOMContentLoaded', () => {
                const timelineItems = document.querySelectorAll('.timeline-item');
                timelineItems.forEach(item => {
                    observer.observe(item);
                });
            });
        </script>
    @endpush
@endsection
