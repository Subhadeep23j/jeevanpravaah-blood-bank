@extends('layouts.app')

@section('title', 'Contact Us - JeevanPravaah')

@section('content')
    <!-- Hero Section -->
    <section class="relative py-32 hero-gradient">
        <div
            class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=\"60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cg fill=\"none\" fill-rule=\"evenodd\"%3E%3Cg fill=\"%23ef4444\" fill-opacity=\"0.03\"%3E%3Ccircle cx=\"30\" cy=\"30\" r=\"2\" /%3E%3C/g%3E%3C/g%3E%3C/svg%3E')]
            opacity-50">
        </div>
        <div class="relative z-10 max-w-4xl mx-auto px-6 text-center">
            <div class="floating-animation mb-8">
                <svg class="w-24 h-24 text-red-500 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
            </div>
            <h1 class="text-5xl md:text-6xl font-bold mb-6 text-gray-800">Contact Us</h1>
            <div class="w-32 h-1 bg-gradient-to-r from-red-400 to-pink-400 mx-auto mb-8 rounded-full"></div>
            <p class="text-xl text-gray-700 leading-relaxed max-w-3xl mx-auto">
                Have questions or need assistance? We're here to help. Reach out to us and we'll respond as soon as
                possible.
            </p>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="py-24 bg-white">
        <div class="max-w-6xl mx-auto px-6">
            <div class="grid lg:grid-cols-2 gap-16">
                <!-- Contact Form -->
                <div class="glass-card rounded-3xl p-10 hover-lift border border-red-100">
                    <h2 class="text-3xl font-bold text-gray-800 mb-2">Send us a Message</h2>
                    <p class="text-gray-600 mb-8">Fill out the form below and we'll get back to you shortly.</p>

                    @if (session('success'))
                        <div class="mb-6 rounded-xl bg-green-50 border-l-4 border-green-500 px-4 py-4">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                                <p class="text-sm text-green-800 font-medium">{{ session('success') }}</p>
                            </div>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="mb-6 rounded-xl bg-red-50 border-l-4 border-red-500 px-4 py-4">
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-red-500 mr-3 flex-shrink-0 mt-0.5" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                        clip-rule="evenodd" />
                                </svg>
                                <div class="flex-1 space-y-1">
                                    @foreach ($errors->all() as $error)
                                        <p class="text-sm text-red-800 font-medium">{{ $error }}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('contact.submit') }}" method="POST" class="space-y-6">
                        @csrf

                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Full Name
                                    *</label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all bg-gray-50 focus:bg-white"
                                    placeholder="John Doe" required>
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email Address
                                    *</label>
                                <input type="email" name="email" id="email" value="{{ old('email') }}"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all bg-gray-50 focus:bg-white"
                                    placeholder="john@example.com" required>
                            </div>
                        </div>

                        <div>
                            <label for="phone" class="block text-sm font-semibold text-gray-700 mb-2">Phone
                                Number</label>
                            <input type="tel" name="phone" id="phone" value="{{ old('phone') }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all bg-gray-50 focus:bg-white"
                                placeholder="+91 98765 43210">
                        </div>

                        <div>
                            <label for="subject" class="block text-sm font-semibold text-gray-700 mb-2">Subject *</label>
                            <select name="subject" id="subject"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all bg-gray-50 focus:bg-white"
                                required>
                                <option value="">Select a subject</option>
                                <option value="general" {{ old('subject') == 'general' ? 'selected' : '' }}>General Inquiry
                                </option>
                                <option value="donation" {{ old('subject') == 'donation' ? 'selected' : '' }}>Blood
                                    Donation</option>
                                <option value="request" {{ old('subject') == 'request' ? 'selected' : '' }}>Blood Request
                                </option>
                                <option value="partnership" {{ old('subject') == 'partnership' ? 'selected' : '' }}>
                                    Partnership</option>
                                <option value="feedback" {{ old('subject') == 'feedback' ? 'selected' : '' }}>Feedback
                                </option>
                                <option value="support" {{ old('subject') == 'support' ? 'selected' : '' }}>Technical
                                    Support</option>
                                <option value="other" {{ old('subject') == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>

                        <div>
                            <label for="message" class="block text-sm font-semibold text-gray-700 mb-2">Message *</label>
                            <textarea name="message" id="message" rows="5"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all bg-gray-50 focus:bg-white resize-none"
                                placeholder="How can we help you?" required>{{ old('message') }}</textarea>
                        </div>

                        <button type="submit"
                            class="w-full py-4 bg-gradient-to-r from-red-600 to-red-500 hover:from-red-700 hover:to-red-600 text-white text-lg font-bold rounded-xl shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-0.5 flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                            </svg>
                            Send Message
                        </button>
                    </form>
                </div>

                <!-- Contact Info -->
                <div class="space-y-8">
                    <div>
                        <h2 class="text-3xl font-bold text-gray-800 mb-2">Get in Touch</h2>
                        <p class="text-gray-600">We'd love to hear from you. Here's how you can reach us.</p>
                    </div>

                    <!-- Contact Cards -->
                    <div class="space-y-6">
                        <div class="glass-card rounded-2xl p-6 hover-lift border border-red-100 flex items-start gap-4">
                            <div
                                class="w-14 h-14 feature-icon-bg rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-7 h-7 text-red-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-800 mb-1">Our Office</h3>
                                <p class="text-gray-600">123 Healthcare Avenue,<br>Medical District, Mumbai 400001<br>India
                                </p>
                            </div>
                        </div>

                        <div class="glass-card rounded-2xl p-6 hover-lift border border-red-100 flex items-start gap-4">
                            <div
                                class="w-14 h-14 feature-icon-bg rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-7 h-7 text-red-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-800 mb-1">Phone</h3>
                                <p class="text-gray-600">General: +91 22 1234 5678<br>Emergency: +91 98765 43210<br>Toll
                                    Free: 1800-123-4567</p>
                            </div>
                        </div>

                        <div class="glass-card rounded-2xl p-6 hover-lift border border-red-100 flex items-start gap-4">
                            <div
                                class="w-14 h-14 feature-icon-bg rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-7 h-7 text-red-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-800 mb-1">Email</h3>
                                <p class="text-gray-600">General: info@jeevanpravaah.org<br>Support:
                                    support@jeevanpravaah.org<br>Partnerships: partners@jeevanpravaah.org</p>
                            </div>
                        </div>

                        <div class="glass-card rounded-2xl p-6 hover-lift border border-red-100 flex items-start gap-4">
                            <div
                                class="w-14 h-14 feature-icon-bg rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-7 h-7 text-red-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-800 mb-1">Working Hours</h3>
                                <p class="text-gray-600">Monday - Friday: 9:00 AM - 6:00 PM<br>Saturday: 9:00 AM - 2:00
                                    PM<br>Emergency: 24/7 Available</p>
                            </div>
                        </div>
                    </div>

                    <!-- Social Media -->
                    <div class="glass-card rounded-2xl p-6 border border-red-100">
                        <h3 class="text-lg font-bold text-gray-800 mb-4">Follow Us</h3>
                        <div class="flex gap-4">
                            <a href="#"
                                class="w-12 h-12 bg-red-100 hover:bg-red-500 text-red-500 hover:text-white rounded-xl flex items-center justify-center transition-all duration-300">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
                                </svg>
                            </a>
                            <a href="#"
                                class="w-12 h-12 bg-red-100 hover:bg-red-500 text-red-500 hover:text-white rounded-xl flex items-center justify-center transition-all duration-300">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.325v-21.35c0-.732-.593-1.325-1.325-1.325z" />
                                </svg>
                            </a>
                            <a href="#"
                                class="w-12 h-12 bg-red-100 hover:bg-red-500 text-red-500 hover:text-white rounded-xl flex items-center justify-center transition-all duration-300">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                                </svg>
                            </a>
                            <a href="#"
                                class="w-12 h-12 bg-red-100 hover:bg-red-500 text-red-500 hover:text-white rounded-xl flex items-center justify-center transition-all duration-300">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z" />
                                </svg>
                            </a>
                            <a href="#"
                                class="w-12 h-12 bg-red-100 hover:bg-red-500 text-red-500 hover:text-white rounded-xl flex items-center justify-center transition-all duration-300">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667h-3.554v-11.452h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zm-15.11-13.019c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019h-3.564v-11.452h3.564v11.452zm15.106-20.452h-20.454c-.979 0-1.771.774-1.771 1.729v20.542c0 .956.792 1.729 1.771 1.729h20.451c.978 0 1.778-.773 1.778-1.729v-20.542c0-.955-.8-1.729-1.778-1.729z" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <section class="py-24 bg-gray-50">
        <div class="max-w-6xl mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-gray-800 mb-6">Find Us</h2>
                <div class="w-24 h-1 bg-gradient-to-r from-red-400 to-pink-400 mx-auto rounded-full mb-4"></div>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Visit our office or find a blood donation center near you
                </p>
            </div>

            <div class="glass-card rounded-3xl overflow-hidden border border-red-100 shadow-xl">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d241317.11609823277!2d72.74109995709657!3d19.08219783958221!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7c6306644edc1%3A0x5da4ed8f8d648c69!2sMumbai%2C%20Maharashtra!5e0!3m2!1sen!2sin!4v1702712345678!5m2!1sen!2sin"
                    width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade" class="rounded-3xl">
                </iframe>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-24 bg-white">
        <div class="max-w-4xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-800 mb-6">Frequently Asked Questions</h2>
                <div class="w-24 h-1 bg-gradient-to-r from-red-400 to-pink-400 mx-auto rounded-full mb-4"></div>
                <p class="text-xl text-gray-600">
                    Quick answers to common questions
                </p>
            </div>

            <div class="space-y-4" x-data="{ open: null }">
                <div class="glass-card rounded-2xl border border-red-100 overflow-hidden">
                    <button @click="open = open === 1 ? null : 1"
                        class="w-full px-6 py-4 text-left flex justify-between items-center hover:bg-red-50 transition-colors">
                        <span class="font-semibold text-gray-800">How can I become a blood donor?</span>
                        <svg class="w-5 h-5 text-red-500 transition-transform" :class="{ 'rotate-180': open === 1 }"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open === 1" x-collapse class="px-6 pb-4">
                        <p class="text-gray-600">Simply register on our platform, complete your profile, and you'll be
                            notified when there's a need for your blood type in your area. You must be 18-65 years old and
                            weigh at least 50kg.</p>
                    </div>
                </div>

                <div class="glass-card rounded-2xl border border-red-100 overflow-hidden">
                    <button @click="open = open === 2 ? null : 2"
                        class="w-full px-6 py-4 text-left flex justify-between items-center hover:bg-red-50 transition-colors">
                        <span class="font-semibold text-gray-800">Is blood donation safe?</span>
                        <svg class="w-5 h-5 text-red-500 transition-transform" :class="{ 'rotate-180': open === 2 }"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open === 2" x-collapse class="px-6 pb-4">
                        <p class="text-gray-600">Yes, blood donation is completely safe. All equipment used is sterile and
                            disposable. Your body replenishes the blood volume within 24-48 hours, and red blood cells are
                            fully restored within 4-6 weeks.</p>
                    </div>
                </div>

                <div class="glass-card rounded-2xl border border-red-100 overflow-hidden">
                    <button @click="open = open === 3 ? null : 3"
                        class="w-full px-6 py-4 text-left flex justify-between items-center hover:bg-red-50 transition-colors">
                        <span class="font-semibold text-gray-800">How do I request blood in an emergency?</span>
                        <svg class="w-5 h-5 text-red-500 transition-transform" :class="{ 'rotate-180': open === 3 }"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open === 3" x-collapse class="px-6 pb-4">
                        <p class="text-gray-600">For emergencies, call our 24/7 helpline at +91 98765 43210. You can also
                            submit an urgent blood request through our platform, and we'll immediately notify matching
                            donors in your area.</p>
                    </div>
                </div>

                <div class="glass-card rounded-2xl border border-red-100 overflow-hidden">
                    <button @click="open = open === 4 ? null : 4"
                        class="w-full px-6 py-4 text-left flex justify-between items-center hover:bg-red-50 transition-colors">
                        <span class="font-semibold text-gray-800">How can hospitals partner with JeevanPravaah?</span>
                        <svg class="w-5 h-5 text-red-500 transition-transform" :class="{ 'rotate-180': open === 4 }"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open === 4" x-collapse class="px-6 pb-4">
                        <p class="text-gray-600">Healthcare facilities can contact us at partners@jeevanpravaah.org or fill
                            out the partnership form on our website. We offer integration with hospital systems and
                            dedicated support for blood bank management.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-24 bg-gradient-to-r from-red-500 to-red-600">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <h2 class="text-4xl font-bold text-white mb-6">Ready to Save Lives?</h2>
            <p class="text-xl text-red-100 mb-8 max-w-2xl mx-auto">
                Join our community of heroes. Your donation can give someone another chance at life.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('donate') }}"
                    class="px-8 py-4 bg-white text-red-600 font-bold rounded-xl shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-1 inline-flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
                            clip-rule="evenodd" />
                    </svg>
                    Become a Donor
                </a>
                <a href="{{ route('register') }}"
                    class="px-8 py-4 bg-transparent border-2 border-white text-white font-bold rounded-xl hover:bg-white hover:text-red-600 transition-all transform hover:-translate-y-1 inline-flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                    </svg>
                    Register Now
                </a>
            </div>
        </div>
    </section>
@endsection
