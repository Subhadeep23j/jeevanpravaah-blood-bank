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
                Your blood donation can save up to three lives. Join thousands of heroes who are making a difference every
                day.
            </p>

            <!-- Quick Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-12 max-w-2xl mx-auto">
                <div class="glass-card rounded-2xl p-4 hover-lift">
                    <div class="text-2xl font-bold text-red-500">3</div>
                    <div class="text-sm text-gray-600">Lives Saved</div>
                    <div class="text-xs text-gray-500">Per Donation</div>
                </div>
                <div class="glass-card rounded-2xl p-4 hover-lift">
                    <div class="text-2xl font-bold text-red-500">10</div>
                    <div class="text-sm text-gray-600">Minutes</div>
                    <div class="text-xs text-gray-500">Registration Time</div>
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
                <button onclick="startRegistration()"
                    class="px-8 py-4 bg-red-500 hover:bg-red-600 text-white font-semibold rounded-full transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl cursor-pointer">
                    I'm Eligible - Start Registration
                </button>
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
                        <h3 class="text-2xl font-bold text-gray-800 mb-6 text-center">Personal Information</h3>

                        <div class="grid md:grid-cols-2 gap-6">
                            <div class="input-group">
                                <input type="text" name="first_name" required placeholder=" "
                                    class="w-full border-2 border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-red-500 focus:border-red-500 focus:outline-none transition-all">
                                <label class="input-label">First Name</label>
                            </div>

                            <div class="input-group">
                                <input type="text" name="last_name" required placeholder=" "
                                    class="w-full border-2 border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-red-500 focus:border-red-500 focus:outline-none transition-all">
                                <label class="input-label">Last Name</label>
                            </div>

                            <div class="input-group">
                                <input type="email" name="email" required placeholder=" "
                                    class="w-full border-2 border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-red-500 focus:border-red-500 focus:outline-none transition-all">
                                <label class="input-label">Email Address</label>
                            </div>

                            <div class="input-group">
                                <input type="tel" name="phone" required placeholder=" "
                                    class="w-full border-2 border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-red-500 focus:border-red-500 focus:outline-none transition-all">
                                <label class="input-label">Phone Number</label>
                            </div>

                            <div class="input-group">
                                <input type="date" name="date_of_birth" required placeholder=" "
                                    class="w-full border-2 border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-red-500 focus:border-red-500 focus:outline-none transition-all">
                                <label class="input-label">Date of Birth</label>
                            </div>

                            <div>
                                <label class="block text-gray-700 font-medium mb-2">Gender</label>
                                <select name="gender" required
                                    class="w-full border-2 border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-red-500 focus:border-red-500 focus:outline-none transition-all">
                                    <option value="">Select Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Step 2: Blood Type & Medical Info -->
                    <div class="form-step" id="step2">
                        <h3 class="text-2xl font-bold text-gray-800 mb-6 text-center">Medical Information</h3>

                        <div class="mb-8">
                            <label class="block text-gray-700 font-medium mb-4 text-center">Select Your Blood Type</label>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                <div class="blood-type-card border-2 border-gray-200 rounded-xl p-4 text-center"
                                    onclick="selectBloodType(this, 'A+')">
                                    <div class="text-2xl font-bold text-red-500 mb-1">A+</div>
                                    <div class="text-xs text-gray-600">Type A Positive</div>
                                </div>
                                <div class="blood-type-card border-2 border-gray-200 rounded-xl p-4 text-center"
                                    onclick="selectBloodType(this, 'A-')">
                                    <div class="text-2xl font-bold text-red-500 mb-1">A-</div>
                                    <div class="text-xs text-gray-600">Type A Negative</div>
                                </div>
                                <div class="blood-type-card border-2 border-gray-200 rounded-xl p-4 text-center"
                                    onclick="selectBloodType(this, 'B+')">
                                    <div class="text-2xl font-bold text-red-500 mb-1">B+</div>
                                    <div class="text-xs text-gray-600">Type B Positive</div>
                                </div>
                                <div class="blood-type-card border-2 border-gray-200 rounded-xl p-4 text-center"
                                    onclick="selectBloodType(this, 'B-')">
                                    <div class="text-2xl font-bold text-red-500 mb-1">B-</div>
                                    <div class="text-xs text-gray-600">Type B Negative</div>
                                </div>
                                <div class="blood-type-card border-2 border-gray-200 rounded-xl p-4 text-center"
                                    onclick="selectBloodType(this, 'O+')">
                                    <div class="text-2xl font-bold text-red-500 mb-1">O+</div>
                                    <div class="text-xs text-gray-600">Type O Positive</div>
                                </div>
                                <div class="blood-type-card border-2 border-gray-200 rounded-xl p-4 text-center"
                                    onclick="selectBloodType(this, 'O-')">
                                    <div class="text-2xl font-bold text-red-500 mb-1">O-</div>
                                    <div class="text-xs text-gray-600">Universal Donor</div>
                                </div>
                                <div class="blood-type-card border-2 border-gray-200 rounded-xl p-4 text-center"
                                    onclick="selectBloodType(this, 'AB+')">
                                    <div class="text-2xl font-bold text-red-500 mb-1">AB+</div>
                                    <div class="text-xs text-gray-600">Universal Receiver</div>
                                </div>
                                <div class="blood-type-card border-2 border-gray-200 rounded-xl p-4 text-center"
                                    onclick="selectBloodType(this, 'AB-')">
                                    <div class="text-2xl font-bold text-red-500 mb-1">AB-</div>
                                    <div class="text-xs text-gray-600">Type AB Negative</div>
                                </div>
                            </div>
                            <input type="hidden" name="blood_group" id="selectedBloodType" required>
                        </div>

                        <div class="grid md:grid-cols-2 gap-6">
                            <div class="input-group">
                                <input type="number" name="weight" required placeholder=" " min="45"
                                    class="w-full border-2 border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-red-500 focus:border-red-500 focus:outline-none transition-all">
                                <label class="input-label">Weight (kg)</label>
                            </div>

                            <div class="input-group">
                                <input type="number" name="height" required placeholder=" " min="150"
                                    class="w-full border-2 border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-red-500 focus:border-red-500 focus:outline-none transition-all">
                                <label class="input-label">Height (cm)</label>
                            </div>
                        </div>

                        <div class="mt-6">
                            <label class="block text-gray-700 font-medium mb-2">Any chronic medical conditions?</label>
                            <textarea name="medical_conditions" rows="3"
                                placeholder="Please list any medical conditions, medications, or allergies..."
                                class="w-full border-2 border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-red-500 focus:border-red-500 focus:outline-none transition-all"></textarea>
                        </div>
                    </div>

                    <!-- Step 3: Location & Availability -->
                    <div class="form-step" id="step3">
                        <h3 class="text-2xl font-bold text-gray-800 mb-6 text-center">Location & Availability</h3>

                        <div class="grid md:grid-cols-2 gap-6 mb-6">
                            <div class="input-group">
                                <input type="text" name="address" required placeholder=" "
                                    class="w-full border-2 border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-red-500 focus:border-red-500 focus:outline-none transition-all">
                                <label class="input-label">Street Address</label>
                            </div>

                            <div class="input-group">
                                <input type="text" name="city" required placeholder=" "
                                    class="w-full border-2 border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-red-500 focus:border-red-500 focus:outline-none transition-all">
                                <label class="input-label">City</label>
                            </div>

                            <div class="input-group">
                                <input type="text" name="state" required placeholder=" "
                                    class="w-full border-2 border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-red-500 focus:border-red-500 focus:outline-none transition-all">
                                <label class="input-label">State</label>
                            </div>

                            <div class="input-group">
                                <input type="text" name="pincode" required placeholder=" " pattern="[0-9]{6}"
                                    class="w-full border-2 border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-red-500 focus:border-red-500 focus:outline-none transition-all">
                                <label class="input-label">PIN Code</label>
                            </div>
                        </div>

                        <div class="mb-6">
                            <label class="block text-gray-700 font-medium mb-4">When are you available to donate?</label>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                                <label class="flex items-center">
                                    <input type="checkbox" name="availability[]" value="weekday_morning"
                                        class="w-4 h-4 text-red-600 rounded focus:ring-red-500">
                                    <span class="ml-2 text-sm">Weekday Morning</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="availability[]" value="weekday_evening"
                                        class="w-4 h-4 text-red-600 rounded focus:ring-red-500">
                                    <span class="ml-2 text-sm">Weekday Evening</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="availability[]" value="weekend_morning"
                                        class="w-4 h-4 text-red-600 rounded focus:ring-red-500">
                                    <span class="ml-2 text-sm">Weekend Morning</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="availability[]" value="weekend_evening"
                                        class="w-4 h-4 text-red-600 rounded focus:ring-red-500">
                                    <span class="ml-2 text-sm">Weekend Evening</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="availability[]" value="emergency"
                                        class="w-4 h-4 text-red-600 rounded focus:ring-red-500">
                                    <span class="ml-2 text-sm">Emergency Only</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="availability[]" value="anytime"
                                        class="w-4 h-4 text-red-600 rounded focus:ring-red-500">
                                    <span class="ml-2 text-sm">Anytime</span>
                                </label>
                            </div>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Maximum travel distance (km)</label>
                            <select name="travel_distance" required
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

                    <!-- Step 4: Consent & Confirmation -->
                    <div class="form-step" id="step4">
                        <h3 class="text-2xl font-bold text-gray-800 mb-6 text-center">Consent & Agreement</h3>

                        <div class="bg-gray-50 rounded-2xl p-6 mb-6">
                            <h4 class="font-bold text-gray-800 mb-4">Important Information</h4>
                            <ul class="space-y-2 text-sm text-gray-600">
                                <li>• All donated blood will be screened for infectious diseases</li>
                                <li>• You will receive SMS notifications for donation requests</li>
                                <li>• Your information will be kept confidential and secure</li>
                                <li>• You can update your availability or withdraw at any time</li>
                                <li>• Medical professionals will verify your eligibility before donation</li>
                            </ul>
                        </div>

                        <div class="space-y-4">
                            <label class="flex items-start">
                                <input type="checkbox" name="consent_medical" required
                                    class="w-4 h-4 text-red-600 rounded focus:ring-red-500 mt-1">
                                <span class="ml-3 text-sm text-gray-700">
                                    I consent to medical screening and confirm that all information provided is accurate to
                                    the best of my knowledge.
                                </span>
                            </label>

                            <label class="flex items-start">
                                <input type="checkbox" name="consent_contact" required
                                    class="w-4 h-4 text-red-600 rounded focus:ring-red-500 mt-1">
                                <span class="ml-3 text-sm text-gray-700">
                                    I agree to be contacted via phone/SMS for blood donation requests within my specified
                                    availability.
                                </span>
                            </label>

                            <label class="flex items-start">
                                <label class="flex items-start">
                                    <input type="checkbox" name="consent_privacy" required
                                        class="w-4 h-4 text-red-600 rounded focus:ring-red-500 mt-1">
                                    <span class="ml-3 text-sm text-gray-700">
                                        I agree to JeevanPravaah's Privacy Policy and Terms of Service.
                                    </span>
                                </label>
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
                        <button type="button" id="nextBtn" onclick="nextStep()"
                            class="px-8 py-3 bg-red-500 hover:bg-red-600 text-white font-semibold rounded-full transition-all duration-300 transform hover:scale-105 cursor-pointer">
                            Next
                        </button>
                        <button type="submit" id="submitBtn"
                            class="px-8 py-3 bg-green-500 hover:bg-green-600 text-white font-semibold rounded-full transition-all duration-300 transform hover:scale-105 cursor-pointer"
                            style="display: none;">
                            Register as Donor
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    @push('scripts')
        <script>
            let currentStep = 1;
            const totalSteps = 4;

            function startRegistration() {
                document.getElementById('registrationForm').style.display = 'block';
                document.getElementById('registrationForm').scrollIntoView({
                    behavior: 'smooth'
                });
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
