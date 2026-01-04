@extends('layouts.app')

@section('title', 'Donate Blood - JeevanPravaah')

@push('head')
    <style>
        .form-step {
            display: none;
        }

        .form-step.active {
            display: block;
            animation: slideIn 0.3s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(20px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .blood-type-card {
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .blood-type-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(239, 68, 68, 0.15);
        }

        .blood-type-card.selected {
            background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
            border-color: #ef4444;
            transform: scale(1.02);
        }

        .progress-bar {
            transition: width 0.3s ease;
        }

        .input-group {
            position: relative;
        }

        .input-group input:focus+.input-label,
        .input-group input:not(:placeholder-shown)+.input-label {
            transform: translateY(-1.5rem) scale(0.875);
            color: #ef4444;
        }

        .input-label {
            position: absolute;
            top: 0.75rem;
            left: 1rem;
            background: white;
            padding: 0 0.25rem;
            transition: all 0.2s ease;
            pointer-events: none;
            color: #6b7280;
        }

        .step-indicator {
            width: 2rem;
            height: 2rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .step-indicator.completed {
            background: #ef4444;
            color: white;
        }

        .step-indicator.active {
            background: #fecaca;
            color: #dc2626;
            border: 2px solid #ef4444;
        }

        .step-indicator.inactive {
            background: #f3f4f6;
            color: #6b7280;
            border: 2px solid #d1d5db;
        }

        .locked-form {
            opacity: 0.6;
            pointer-events: none;
            background: repeating-linear-gradient(45deg,
                    transparent,
                    transparent 10px,
                    rgba(0, 0, 0, 0.03) 10px,
                    rgba(0, 0, 0, 0.03) 20px);
        }

        .form-disabled-overlay {
            position: relative;
            z-index: 10;
        }

        input:disabled,
        select:disabled,
        textarea:disabled {
            background-color: #f3f4f6;
            color: #6b7280;
            cursor: not-allowed;
        }

        input:disabled::placeholder {
            color: #d1d5db;
        }

        /* BMI Calculation Styles */
        .bmi-result-container {
            margin-top: 1.5rem;
            padding: 1.25rem;
            border-radius: 0.75rem;
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
            border: 2px solid #0ea5e9;
            animation: slideDown 0.3s ease-out;
        }

        .bmi-result-container.hidden {
            display: none;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .bmi-status-underweight {
            color: #3b82f6;
        }

        .bmi-status-normal {
            color: #10b981;
        }

        .bmi-status-overweight {
            color: #f59e0b;
        }

        .bmi-status-obese {
            color: #ef4444;
        }

        .form-section {
            background: #f9fafb;
            padding: 1.5rem;
            border-radius: 1rem;
            margin-bottom: 1.5rem;
        }

        .form-section-title {
            font-size: 0.875rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #ef4444;
            margin-bottom: 1rem;
        }
    </style>
@endpush

@section('content')

    <!-- Hero Section -->
    <section class="relative pt-10 pb-16 hero-gradient">
        <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60"
            xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ef4444"
            fill-opacity="0.03"%3E%3Ccircle cx="30" cy="30" r="2" /%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-50">
        </div>

        <div class="relative z-10 max-w-4xl mx-auto px-6 text-center">
            <div class="floating-animation mb-6">
                <svg class="w-16 h-16 text-red-500 mx-auto heart-pulse" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                </svg>
            </div>

            <h1 class="text-4xl md:text-5xl font-bold mb-6 text-gray-800">Become a Life Saver</h1>
            <div class="w-24 h-1 bg-gradient-to-r from-red-400 to-pink-400 mx-auto mb-6 rounded-full"></div>
            <p class="text-xl text-gray-700 leading-relaxed max-w-2xl mx-auto">
                Your blood donation can save up to three lives. Join
                {{ number_format($stats['active_donors'] > 0 ? $stats['active_donors'] : 15000) }}+ heroes who are making a
                difference every
                day.
            </p>

            <!-- Quick Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-12 max-w-2xl mx-auto">
                <div class="glass-card rounded-2xl p-4 hover-lift">
                    <div class="text-2xl font-bold text-red-500">
                        {{ number_format($stats['lives_saved'] > 0 ? $stats['lives_saved'] : 45000) }}+</div>
                    <div class="text-sm text-gray-600">Lives Saved</div>
                    <div class="text-xs text-gray-500">Through Our Platform</div>
                </div>
                <div class="glass-card rounded-2xl p-4 hover-lift">
                    <div class="text-2xl font-bold text-red-500">
                        {{ number_format($stats['active_donors'] > 0 ? $stats['active_donors'] : 15000) }}+</div>
                    <div class="text-sm text-gray-600">Active Donors</div>
                    <div class="text-xs text-gray-500">Ready to Help</div>
                </div>
                <div class="glass-card rounded-2xl p-4 hover-lift">
                    <div class="text-2xl font-bold text-red-500">24/7</div>
                    <div class="text-sm text-gray-600">Support</div>
                    <div class="text-xs text-gray-500">Always Available</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Donation Eligibility Check -->
    <section class="py-16 bg-white">
        <div class="max-w-4xl mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Quick Eligibility Check</h2>
                <p class="text-gray-600">Before we begin, let's make sure you're eligible to donate</p>
            </div>

            <div class="glass-card rounded-3xl p-8 mb-8">
                <div class="grid md:grid-cols-2 gap-8">
                    <div>
                        <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                            <svg class="w-6 h-6 text-green-500 mr-2" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                            You Can Donate If:
                        </h3>
                        <ul class="space-y-2 text-gray-600">
                            <li class="flex items-start">
                                <span class="w-2 h-2 bg-green-500 rounded-full mt-2 mr-3 flex-shrink-0"></span>
                                Age between 18-65 years
                            </li>
                            <li class="flex items-start">
                                <span class="w-2 h-2 bg-green-500 rounded-full mt-2 mr-3 flex-shrink-0"></span>
                                Weight 45 kg or above
                            </li>
                            <li class="flex items-start">
                                <span class="w-2 h-2 bg-green-500 rounded-full mt-2 mr-3 flex-shrink-0"></span>
                                Good general health
                            </li>
                            <li class="flex items-start">
                                <span class="w-2 h-2 bg-green-500 rounded-full mt-2 mr-3 flex-shrink-0"></span>
                                No recent illness or fever
                            </li>
                            <li class="flex items-start">
                                <span class="w-2 h-2 bg-green-500 rounded-full mt-2 mr-3 flex-shrink-0"></span>
                                At least 3 months since last donation
                            </li>
                        </ul>
                    </div>

                    <div>
                        <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                            <svg class="w-6 h-6 text-red-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Temporary Deferral If:
                        </h3>
                        <ul class="space-y-2 text-gray-600">
                            <li class="flex items-start">
                                <span class="w-2 h-2 bg-red-500 rounded-full mt-2 mr-3 flex-shrink-0"></span>
                                Recent tattoo or piercing (6 months)
                            </li>
                            <li class="flex items-start">
                                <span class="w-2 h-2 bg-red-500 rounded-full mt-2 mr-3 flex-shrink-0"></span>
                                Pregnancy or recent childbirth
                            </li>
                            <li class="flex items-start">
                                <span class="w-2 h-2 bg-red-500 rounded-full mt-2 mr-3 flex-shrink-0"></span>
                                Recent medication or vaccination
                            </li>
                            <li class="flex items-start">
                                <span class="w-2 h-2 bg-red-500 rounded-full mt-2 mr-3 flex-shrink-0"></span>
                                Recent travel to certain areas
                            </li>
                            <li class="flex items-start">
                                <span class="w-2 h-2 bg-red-500 rounded-full mt-2 mr-3 flex-shrink-0"></span>
                                Recent dental work
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="text-center">
                @auth
                    <button onclick="startRegistration()"
                        class="px-8 py-4 bg-red-500 hover:bg-red-600 text-white font-semibold rounded-full transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl cursor-pointer">
                        I'm Eligible - Start Registration
                    </button>
                @else
                    <div class="flex flex-col items-center justify-center py-16">
                        <!-- Lock Icon Circle -->
                        <div
                            class="w-28 h-28 bg-red-100 rounded-full flex items-center justify-center mb-8 transform hover:scale-105 transition-transform">
                            <svg class="w-16 h-16 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm6-10V7a3 3 0 00-3-3 3 3 0 00-3 3v4h6z" />
                            </svg>
                        </div>

                        <!-- Heading -->
                        <h3 class="text-3xl md:text-4xl font-bold text-gray-800 mb-6">Login Required</h3>

                        <!-- Description -->
                        <p class="text-gray-600 text-lg max-w-md mx-auto mb-10 leading-relaxed">
                            Please login to your account to register as a blood donor. This helps us verify and process
                            your registration quickly.
                        </p>

                        <!-- Buttons -->
                        <div class="flex flex-col sm:flex-row gap-4 justify-center">
                            <a href="{{ route('login') }}"
                                class="inline-flex items-center justify-center gap-2 px-8 py-3 bg-red-500 text-white font-bold rounded-full hover:bg-red-600 transition-all shadow-lg hover:shadow-xl transform hover:scale-105">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                                </svg>
                                Login Now
                            </a>
                            <a href="{{ route('register') }}"
                                class="inline-flex items-center justify-center gap-2 px-8 py-3 border-2 border-red-500 text-red-500 font-bold rounded-full hover:bg-red-50 transition-all transform hover:scale-105">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                                </svg>
                                Register
                            </a>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
    </section>

    <!-- Multi-step Registration Form -->
    <section id="registrationForm" class="py-16 bg-gray-50" style="display: none;">
        <div class="max-w-4xl mx-auto px-6">
            <!-- Progress Indicator -->
            <div class="mb-12">
                <div class="flex justify-center items-center space-x-4 mb-4">
                    <div class="step-indicator active" id="step1-indicator">1</div>
                    <div class="w-12 h-0.5 bg-gray-300" id="line1"></div>
                    <div class="step-indicator inactive" id="step2-indicator">2</div>
                    <div class="w-12 h-0.5 bg-gray-300" id="line2"></div>
                    <div class="step-indicator inactive" id="step3-indicator">3</div>
                    <div class="w-12 h-0.5 bg-gray-300" id="line3"></div>
                    <div class="step-indicator inactive" id="step4-indicator">4</div>
                </div>
                <div class="bg-gray-200 rounded-full h-2 max-w-md mx-auto">
                    <div class="bg-red-500 h-2 rounded-full progress-bar" style="width: 25%" id="progressBar"></div>
                </div>
                <div class="text-center mt-4">
                    <span class="text-sm text-gray-600" id="stepText">Step 1 of 4: Personal Information</span>
                </div>
            </div>

            <div class="glass-card rounded-3xl p-8">
                <form id="donationForm" action="{{ route('donors.store') }}" method="POST">
                    @csrf

                    <!-- Step 1: Personal Information -->
                    <div class="form-step active" id="step1">
                        <h3 class="text-2xl font-bold text-gray-800 mb-8 text-center">Personal Information</h3>

                        <!-- Section: Basic Details -->
                        <div class="form-section">
                            <div class="form-section-title">Basic Details</div>

                            <div class="grid md:grid-cols-2 gap-6">
                                <!-- Full Name split into First Name and Last Name -->
                                <div class="input-group">
                                    <input type="text" name="first_name" required placeholder=" "
                                        @auth value="{{ explode(' ', auth()->user()->name)[0] ?? '' }}" readonly @endauth
                                        @guest disabled @endguest
                                        class="w-full border-2 border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-red-500 focus:border-red-500 focus:outline-none transition-all">
                                    <label class="input-label">First Name</label>
                                </div>

                                <div class="input-group">
                                    <input type="text" name="last_name" required placeholder=" "
                                        @auth value="{{ array_slice(explode(' ', auth()->user()->name), 1) ? implode(' ', array_slice(explode(' ', auth()->user()->name), 1)) : '' }}" readonly @endauth
                                        @guest disabled @endguest
                                        class="w-full border-2 border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-red-500 focus:border-red-500 focus:outline-none transition-all">
                                    <label class="input-label">Last Name</label>
                                </div>

                                <!-- Email (from registration) -->
                                <div class="input-group">
                                    <input type="email" name="email" required placeholder=" "
                                        @auth value="{{ auth()->user()->email ?? '' }}" readonly @endauth
                                        @guest disabled @endguest
                                        class="w-full border-2 border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-red-500 focus:border-red-500 focus:outline-none transition-all">
                                    <label class="input-label">Email Address</label>
                                </div>

                                <!-- Phone (from registration) -->
                                <div class="input-group">
                                    <input type="tel" name="phone" required placeholder=" "
                                        @auth value="{{ auth()->user()->phone ?? '' }}" readonly @endauth
                                        @guest disabled @endguest
                                        class="w-full border-2 border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-red-500 focus:border-red-500 focus:outline-none transition-all">
                                    <label class="input-label">Phone Number</label>
                                </div>

                                {{-- <!-- Aadhar (from registration) -->
                                <div class="input-group">
                                    <input type="text" name="aadhar" placeholder=" "
                                        @auth value="{{ auth()->user()->aadhar ?? '' }}" readonly @endauth
                                        @guest disabled @endguest
                                        class="w-full border-2 border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-red-500 focus:border-red-500 focus:outline-none transition-all">
                                    <label class="input-label">Aadhar Number</label>
                                </div> --}}

                                <!-- Date of Birth -->
                                <div class="input-group md:col-span-2">
                                    <input type="date" name="date_of_birth" required placeholder=" "
                                        @auth value="{{ auth()->user()->date_of_birth ?? '' }}" readonly @endauth
                                        @guest disabled @endguest
                                        class="w-full border-2 border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-red-500 focus:border-red-500 focus:outline-none transition-all">
                                    <label class="input-label">Date of Birth</label>
                                </div>
                            </div>
                        </div>

                        <!-- Section: Address Details -->
                        <div class="form-section">
                            <div class="form-section-title">Address Details</div>

                            <div class="space-y-6">
                                <!-- Address (from registration) -->
                                <div class="input-group">
                                    <input type="text" name="address" placeholder=" "
                                        @auth value="{{ auth()->user()->address ?? '' }}" readonly @endauth
                                        @guest disabled @endguest
                                        class="w-full border-2 border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-red-500 focus:border-red-500 focus:outline-none transition-all">
                                    <label class="input-label">Street Address</label>
                                </div>

                                <div class="grid md:grid-cols-3 gap-6">
                                    <!-- City (from registration) -->
                                    <div class="input-group">
                                        <input type="text" name="city" placeholder=" "
                                            @auth value="{{ auth()->user()->city ?? '' }}" readonly @endauth
                                            @guest disabled @endguest
                                            class="w-full border-2 border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-red-500 focus:border-red-500 focus:outline-none transition-all">
                                        <label class="input-label">City</label>
                                    </div>

                                    <!-- PIN Code (from registration) -->
                                    <div class="input-group">
                                        <input type="text" name="pin" placeholder=" "
                                            @auth value="{{ auth()->user()->pin ?? '' }}" readonly @endauth
                                            @guest disabled @endguest
                                            class="w-full border-2 border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-red-500 focus:border-red-500 focus:outline-none transition-all">
                                        <label class="input-label">PIN Code</label>
                                    </div>

                                    <!-- Additional empty slot for grid alignment -->
                                    <div></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 2: Blood Type & Medical Info -->
                    <div class="form-step" id="step2">
                        <h3 class="text-2xl font-bold text-gray-800 mb-8 text-center">Medical Information</h3>

                        <!-- Section: Blood Type -->
                        <div class="form-section">
                            <div class="form-section-title">Blood Type</div>

                            <label class="block text-gray-700 font-medium mb-4">Select Your Blood Type</label>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 @guest locked-form @endguest">
                                <div class="blood-type-card border-2 border-gray-200 rounded-xl p-4 text-center"
                                    @guest onclick="showLoginPrompt()" style="cursor: not-allowed; opacity: 0.6;" @else onclick="selectBloodType(this, 'A+')" @endguest>
                                    <div class="text-2xl font-bold text-red-500 mb-1">A+</div>
                                    <div class="text-xs text-gray-600">Type A Positive</div>
                                </div>
                                <div class="blood-type-card border-2 border-gray-200 rounded-xl p-4 text-center"
                                    @guest onclick="showLoginPrompt()" style="cursor: not-allowed; opacity: 0.6;" @else onclick="selectBloodType(this, 'A-')" @endguest>
                                    <div class="text-2xl font-bold text-red-500 mb-1">A-</div>
                                    <div class="text-xs text-gray-600">Type A Negative</div>
                                </div>
                                <div class="blood-type-card border-2 border-gray-200 rounded-xl p-4 text-center"
                                    @guest onclick="showLoginPrompt()" style="cursor: not-allowed; opacity: 0.6;" @else onclick="selectBloodType(this, 'B+')" @endguest>
                                    <div class="text-2xl font-bold text-red-500 mb-1">B+</div>
                                    <div class="text-xs text-gray-600">Type B Positive</div>
                                </div>
                                <div class="blood-type-card border-2 border-gray-200 rounded-xl p-4 text-center"
                                    @guest onclick="showLoginPrompt()" style="cursor: not-allowed; opacity: 0.6;" @else onclick="selectBloodType(this, 'B-')" @endguest>
                                    <div class="text-2xl font-bold text-red-500 mb-1">B-</div>
                                    <div class="text-xs text-gray-600">Type B Negative</div>
                                </div>
                                <div class="blood-type-card border-2 border-gray-200 rounded-xl p-4 text-center"
                                    @guest onclick="showLoginPrompt()" style="cursor: not-allowed; opacity: 0.6;" @else onclick="selectBloodType(this, 'O+')" @endguest>
                                    <div class="text-2xl font-bold text-red-500 mb-1">O+</div>
                                    <div class="text-xs text-gray-600">Type O Positive</div>
                                </div>
                                <div class="blood-type-card border-2 border-gray-200 rounded-xl p-4 text-center"
                                    @guest onclick="showLoginPrompt()" style="cursor: not-allowed; opacity: 0.6;" @else onclick="selectBloodType(this, 'O-')" @endguest>
                                    <div class="text-2xl font-bold text-red-500 mb-1">O-</div>
                                    <div class="text-xs text-gray-600">Universal Donor</div>
                                </div>
                                <div class="blood-type-card border-2 border-gray-200 rounded-xl p-4 text-center"
                                    @guest onclick="showLoginPrompt()" style="cursor: not-allowed; opacity: 0.6;" @else onclick="selectBloodType(this, 'AB+')" @endguest>
                                    <div class="text-2xl font-bold text-red-500 mb-1">AB+</div>
                                    <div class="text-xs text-gray-600">Universal Receiver</div>
                                </div>
                                <div class="blood-type-card border-2 border-gray-200 rounded-xl p-4 text-center"
                                    @guest onclick="showLoginPrompt()" style="cursor: not-allowed; opacity: 0.6;" @else onclick="selectBloodType(this, 'AB-')" @endguest>
                                    <div class="text-2xl font-bold text-red-500 mb-1">AB-</div>
                                    <div class="text-xs text-gray-600">Type AB Negative</div>
                                </div>
                            </div>
                            <input type="hidden" name="blood_group" id="selectedBloodType" required>
                        </div>

                        <!-- Section: Physical Measurements & BMI -->
                        <div class="form-section">
                            <div class="form-section-title">Physical Measurements</div>

                            <div class="grid md:grid-cols-2 gap-6 mb-6">
                                <div class="input-group">
                                    <input type="number" name="weight" id="weightInput" required placeholder=" "
                                        min="45" step="0.1" @guest disabled @endguest
                                        class="w-full border-2 border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-red-500 focus:border-red-500 focus:outline-none transition-all"
                                        oninput="calculateBMI()">
                                    <label class="input-label">Weight (kg)</label>
                                </div>

                                <div class="input-group">
                                    <input type="number" name="height" id="heightInput" required placeholder=" "
                                        min="100" step="0.1" @guest disabled @endguest
                                        class="w-full border-2 border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-red-500 focus:border-red-500 focus:outline-none transition-all"
                                        oninput="calculateBMI()">
                                    <label class="input-label">Height (cm)</label>
                                </div>
                            </div>

                            <!-- BMI Result -->
                            <div id="bmiResultContainer" class="bmi-result-container hidden">
                                <div class="grid md:grid-cols-3 gap-4">
                                    <div>
                                        <p class="text-sm text-gray-600">Your BMI</p>
                                        <p class="text-3xl font-bold" id="bmiValue">--</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600">Status</p>
                                        <p class="text-xl font-bold" id="bmiStatus">--</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600">Category</p>
                                        <p class="text-sm" id="bmiCategory">--</p>
                                    </div>
                                </div>
                                <div class="mt-4 pt-4 border-t border-sky-300">
                                    <p class="text-sm text-gray-700" id="bmiRemark">--</p>
                                </div>
                            </div>
                        </div>

                        <!-- Section: Medical Conditions -->
                        <div class="form-section">
                            <div class="form-section-title">Health Information</div>

                            <label class="block text-gray-700 font-medium mb-3">Any chronic medical conditions?</label>
                            <textarea name="medical_conditions" rows="4" @guest disabled @endguest
                                placeholder="Please list any medical conditions, medications, or allergies... (Optional)"
                                class="w-full border-2 border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-red-500 focus:border-red-500 focus:outline-none transition-all resize-none"></textarea>
                        </div>
                    </div>

                    <!-- Step 3: Availability -->
                    <div class="form-step" id="step3">
                        <h3 class="text-2xl font-bold text-gray-800 mb-8 text-center">Donation Availability</h3>

                        <div class="bg-blue-50 border-l-4 border-blue-500 rounded-lg p-6 mb-8">
                            <p class="text-sm text-gray-700">
                                <span class="font-semibold">📍 Note:</span> You will donate blood at our blood donation
                                center. We will contact you with the appointment details.
                            </p>
                        </div>

                        <!-- Section: Availability -->
                        <div class="form-section">
                            <div class="form-section-title">Your Availability</div>

                            <label class="block text-gray-700 font-medium mb-4">When are you available to donate?</label>
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-4 @guest locked-form @endguest">
                                <label
                                    class="flex items-center p-3 border-2 border-gray-200 rounded-lg cursor-pointer hover:bg-red-50 transition-colors">
                                    <input type="checkbox" name="availability[]" value="weekday_morning"
                                        @guest disabled @endguest class="w-4 h-4 text-red-600 rounded focus:ring-red-500">
                                    <span class="ml-2 text-sm font-medium">Weekday Morning</span>
                                </label>
                                <label
                                    class="flex items-center p-3 border-2 border-gray-200 rounded-lg cursor-pointer hover:bg-red-50 transition-colors">
                                    <input type="checkbox" name="availability[]" value="weekday_evening"
                                        @guest disabled @endguest class="w-4 h-4 text-red-600 rounded focus:ring-red-500">
                                    <span class="ml-2 text-sm font-medium">Weekday Evening</span>
                                </label>
                                <label
                                    class="flex items-center p-3 border-2 border-gray-200 rounded-lg cursor-pointer hover:bg-red-50 transition-colors">
                                    <input type="checkbox" name="availability[]" value="weekend_morning"
                                        @guest disabled @endguest class="w-4 h-4 text-red-600 rounded focus:ring-red-500">
                                    <span class="ml-2 text-sm font-medium">Weekend Morning</span>
                                </label>
                                <label
                                    class="flex items-center p-3 border-2 border-gray-200 rounded-lg cursor-pointer hover:bg-red-50 transition-colors">
                                    <input type="checkbox" name="availability[]" value="weekend_evening"
                                        @guest disabled @endguest class="w-4 h-4 text-red-600 rounded focus:ring-red-500">
                                    <span class="ml-2 text-sm font-medium">Weekend Evening</span>
                                </label>
                                <label
                                    class="flex items-center p-3 border-2 border-gray-200 rounded-lg cursor-pointer hover:bg-red-50 transition-colors">
                                    <input type="checkbox" name="availability[]" value="emergency"
                                        @guest disabled @endguest class="w-4 h-4 text-red-600 rounded focus:ring-red-500">
                                    <span class="ml-2 text-sm font-medium">Emergency Only</span>
                                </label>
                                <label
                                    class="flex items-center p-3 border-2 border-gray-200 rounded-lg cursor-pointer hover:bg-red-50 transition-colors">
                                    <input type="checkbox" name="availability[]" value="anytime"
                                        @guest disabled @endguest class="w-4 h-4 text-red-600 rounded focus:ring-red-500">
                                    <span class="ml-2 text-sm font-medium">Anytime</span>
                                </label>
                            </div>

                            <div class="mt-6">
                                <label class="block text-gray-700 font-medium mb-2">Maximum travel distance to our center
                                    (km)</label>
                                <select name="travel_distance" required @guest disabled @endguest
                                    class="w-full border-2 border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-red-500 focus:border-red-500 focus:outline-none transition-all">
                                    <option value="">Select distance</option>
                                    <option value="5">Within 5 km</option>
                                    <option value="10">Within 10 km</option>
                                    <option value="20">Within 20 km</option>
                                    <option value="50">Within 50 km</option>
                                    <option value="unlimited">Any distance</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Step 4: Consent & Confirmation -->
                    <div class="form-step" id="step4">
                        <h3 class="text-2xl font-bold text-gray-800 mb-8 text-center">Consent & Agreement</h3>

                        <div class="bg-red-50 border-l-4 border-red-500 rounded-lg p-6 mb-8">
                            <h4 class="font-bold text-gray-800 mb-4 flex items-center">
                                <svg class="w-5 h-5 text-red-500 mr-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Important Information
                            </h4>
                            <ul class="space-y-2 text-sm text-gray-700">
                                <li class="flex items-start">
                                    <span class="text-red-500 mr-3 font-bold">✓</span>
                                    <span>All donated blood will be screened for infectious diseases</span>
                                </li>
                                <li class="flex items-start">
                                    <span class="text-red-500 mr-3 font-bold">✓</span>
                                    <span>You will receive SMS notifications for donation requests</span>
                                </li>
                                <li class="flex items-start">
                                    <span class="text-red-500 mr-3 font-bold">✓</span>
                                    <span>Your information will be kept confidential and secure</span>
                                </li>
                                <li class="flex items-start">
                                    <span class="text-red-500 mr-3 font-bold">✓</span>
                                    <span>You can update your availability or withdraw at any time</span>
                                </li>
                                <li class="flex items-start">
                                    <span class="text-red-500 mr-3 font-bold">✓</span>
                                    <span>Medical professionals will verify your eligibility before donation</span>
                                </li>
                            </ul>
                        </div>

                        <div class="form-section">
                            <div class="form-section-title">Agreements</div>

                            <div class="space-y-4">
                                <label
                                    class="flex items-start p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:bg-red-50 transition-colors">
                                    <input type="checkbox" name="consent_medical" required @guest disabled @endguest
                                        class="w-5 h-5 text-red-600 rounded focus:ring-red-500 mt-0.5 flex-shrink-0">
                                    <span class="ml-3 text-sm text-gray-700">
                                        <span class="font-semibold">Medical Screening Consent:</span> I consent to medical
                                        screening and confirm that all information provided is accurate to the best of my
                                        knowledge.
                                    </span>
                                </label>

                                <label
                                    class="flex items-start p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:bg-red-50 transition-colors">
                                    <input type="checkbox" name="consent_contact" required @guest disabled @endguest
                                        class="w-5 h-5 text-red-600 rounded focus:ring-red-500 mt-0.5 flex-shrink-0">
                                    <span class="ml-3 text-sm text-gray-700">
                                        <span class="font-semibold">Contact Permission:</span> I agree to be contacted via
                                        phone/SMS for blood donation requests within my specified availability.
                                    </span>
                                </label>

                                <label
                                    class="flex items-start p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:bg-red-50 transition-colors">
                                    <input type="checkbox" name="consent_privacy" required @guest disabled @endguest
                                        class="w-5 h-5 text-red-600 rounded focus:ring-red-500 mt-0.5 flex-shrink-0">
                                    <span class="ml-3 text-sm text-gray-700">
                                        <span class="font-semibold">Privacy & Terms:</span> I agree to JeevanPravaah's
                                        Privacy Policy and Terms of Service.
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Navigation Buttons -->
                    <div class="flex justify-between pt-6">
                        <button type="button" id="prevBtn" onclick="prevStep()"
                            class="px-6 py-3 bg-gray-300 text-gray-700 font-semibold rounded-full transition-all duration-300 hover:bg-gray-400 cursor-pointer"
                            style="display: none;">
                            Previous
                        </button>
                        <div class="flex-1"></div>
                        @auth
                            <button type="button" id="nextBtn" onclick="nextStep()"
                                class="px-8 py-3 bg-red-500 hover:bg-red-600 text-white font-semibold rounded-full transition-all duration-300 transform hover:scale-105 cursor-pointer">
                                Next
                            </button>
                            <button type="submit" id="submitBtn"
                                class="px-8 py-3 bg-green-500 hover:bg-green-600 text-white font-semibold rounded-full transition-all duration-300 transform hover:scale-105 cursor-pointer"
                                style="display: none;">
                                Register as Donor
                            </button>
                        @else
                            <a href="{{ route('login') }}"
                                class="px-8 py-3 bg-red-500 hover:bg-red-600 text-white font-semibold rounded-full transition-all duration-300 transform hover:scale-105 inline-block">
                                Login to Continue
                            </a>
                        @endauth
                    </div>
                </form>
            </div>
        </div>
    </section>

    @push('scripts')
        <script>
            let currentStep = 1;
            const totalSteps = 4;

            // BMI Calculation Function
            function calculateBMI() {
                const weightInput = document.getElementById('weightInput');
                const heightInput = document.getElementById('heightInput');
                const bmiResultContainer = document.getElementById('bmiResultContainer');
                const bmiValue = document.getElementById('bmiValue');
                const bmiStatus = document.getElementById('bmiStatus');
                const bmiCategory = document.getElementById('bmiCategory');
                const bmiRemark = document.getElementById('bmiRemark');

                const weight = parseFloat(weightInput.value);
                const height = parseFloat(heightInput.value);

                if (weight && height && weight > 0 && height > 0) {
                    // Convert height from cm to meters
                    const heightInMeters = height / 100;

                    // Calculate BMI: weight(kg) / height(m)^2
                    const bmi = weight / (heightInMeters * heightInMeters);

                    // Show result container
                    bmiResultContainer.classList.remove('hidden');

                    // Display BMI value
                    bmiValue.textContent = bmi.toFixed(1);

                    // Determine status and remarks
                    let status = '';
                    let statusClass = '';
                    let remark = '';

                    if (bmi < 18.5) {
                        status = 'Underweight';
                        statusClass = 'bmi-status-underweight';
                        remark =
                            '⚠️ Your BMI is below normal. You may need to gain weight to meet blood donation requirements. Consult a healthcare provider before donating.';
                    } else if (bmi >= 18.5 && bmi < 25) {
                        status = 'Normal';
                        statusClass = 'bmi-status-normal';
                        remark =
                            '✓ Your BMI is in the healthy range. You are eligible to donate blood based on weight criteria.';
                    } else if (bmi >= 25 && bmi < 30) {
                        status = 'Overweight';
                        statusClass = 'bmi-status-overweight';
                        remark =
                            '⚠️ Your BMI indicates overweight. While you may still donate, consult with a doctor to ensure you meet all health criteria.';
                    } else {
                        status = 'Obese';
                        statusClass = 'bmi-status-obese';
                        remark =
                            '⚠️ Your BMI indicates obesity. Please consult a healthcare provider before blood donation to ensure it\'s safe for you.';
                    }

                    bmiStatus.textContent = status;
                    bmiStatus.className = statusClass;
                    bmiCategory.textContent = `BMI ${bmi.toFixed(1)} - ${status}`;
                    bmiRemark.textContent = remark;
                } else {
                    bmiResultContainer.classList.add('hidden');
                }
            }

            function startRegistration() {
                document.getElementById('registrationForm').style.display = 'block';
                document.getElementById('registrationForm').scrollIntoView({
                    behavior: 'smooth'
                });
            }

            function showLoginPrompt() {
                alert('Please log in first to proceed with blood donor registration.');
            }

            function updateStepIndicators() {
                for (let i = 1; i <= totalSteps; i++) {
                    const indicator = document.getElementById(`step${i}-indicator`);
                    if (i < currentStep) {
                        indicator.className = 'step-indicator completed';
                        indicator.innerHTML = '✓';
                    } else if (i === currentStep) {
                        indicator.className = 'step-indicator active';
                        indicator.innerHTML = i;
                    } else {
                        indicator.className = 'step-indicator inactive';
                        indicator.innerHTML = i;
                    }
                }

                // Update progress bar
                const progressPercentage = (currentStep / totalSteps) * 100;
                document.getElementById('progressBar').style.width = `${progressPercentage}%`;

                // Update step text
                const stepTexts = [
                    'Step 1 of 4: Personal Information',
                    'Step 2 of 4: Medical Information',
                    'Step 3 of 4: Location & Availability',
                    'Step 4 of 4: Consent & Agreement'
                ];
                document.getElementById('stepText').textContent = stepTexts[currentStep - 1];
            }

            function showStep(step) {
                // Hide all steps
                for (let i = 1; i <= totalSteps; i++) {
                    document.getElementById(`step${i}`).classList.remove('active');
                }

                // Show current step
                document.getElementById(`step${step}`).classList.add('active');

                // Update button visibility
                document.getElementById('prevBtn').style.display = step === 1 ? 'none' : 'block';
                document.getElementById('nextBtn').style.display = step === totalSteps ? 'none' : 'block';
                document.getElementById('submitBtn').style.display = step === totalSteps ? 'block' : 'none';

                updateStepIndicators();
            }

            function nextStep() {
                if (validateCurrentStep() && currentStep < totalSteps) {
                    currentStep++;
                    showStep(currentStep);
                }
            }

            function prevStep() {
                if (currentStep > 1) {
                    currentStep--;
                    showStep(currentStep);
                }
            }

            function validateCurrentStep() {
                const currentStepDiv = document.getElementById(`step${currentStep}`);
                const requiredFields = currentStepDiv.querySelectorAll('[required]');

                for (let field of requiredFields) {
                    if (!field.value.trim()) {
                        field.focus();
                        field.classList.add('border-red-500');
                        setTimeout(() => field.classList.remove('border-red-500'), 3000);
                        return false;
                    }
                }

                // Special validation for blood type in step 2
                if (currentStep === 2) {
                    const bloodType = document.getElementById('selectedBloodType').value;
                    if (!bloodType) {
                        alert('Please select your blood type');
                        return false;
                    }
                }

                return true;
            }

            function selectBloodType(element, bloodType) {
                // Remove selected class from all blood type cards
                document.querySelectorAll('.blood-type-card').forEach(card => {
                    card.classList.remove('selected');
                });

                // Add selected class to clicked card
                element.classList.add('selected');

                // Set the hidden input value
                document.getElementById('selectedBloodType').value = bloodType;
            }

            // Allow normal form submission; optional client-side validation only advances steps

            // Initialize
            showStep(1);
        </script>
    @endpush
@endsection
