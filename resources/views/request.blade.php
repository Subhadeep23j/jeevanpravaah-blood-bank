@extends('layouts.app')

@section('title', 'Request Blood - JeevanPravaah')

@push('head')
    <style>
        .form-container {
            animation: fadeInUp 0.5s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .blood-type-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
        }

        .blood-type-card:hover {
            transform: translateY(-4px) scale(1.02);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.12);
        }

        .blood-type-card.selected {
            background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
            border-color: #ef4444;
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.2);
        }

        .input-field {
            transition: all 0.3s ease;
        }

        .input-field:focus {
            border-color: #ef4444;
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
        }

        .login-overlay {
            backdrop-filter: blur(4px);
        }
    </style>
@endpush

@section('content')

    <!-- Hero Section -->
    <section class="relative pt-10 pb-12 hero-gradient">
        <div
            class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=\"60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cg fill=\"none\" fill-rule=\"evenodd\"%3E%3Cg fill=\"%23ef4444\" fill-opacity=\"0.03\"%3E%3Ccircle cx=\"30\" cy=\"30\" r=\"2\" /%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-50">
        </div>

        <div class="relative z-10 max-w-4xl mx-auto px-6 text-center">
            <div class="floating-animation mb-6">
                <svg class="w-16 h-16 text-red-500 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
            </div>

            <h1 class="text-4xl md:text-5xl font-bold mb-6 text-gray-800">Request Blood</h1>
            <div class="w-24 h-1 bg-gradient-to-r from-red-400 to-pink-400 mx-auto mb-6 rounded-full"></div>
            <p class="text-xl text-gray-700 leading-relaxed max-w-2xl mx-auto">
                Need blood urgently? Fill out the form below and we'll connect you with available donors in your area.
            </p>
        </div>
    </section>

    <!-- Blood Request Form Section -->
    <section class="py-16 bg-white">
        <div class="max-w-3xl mx-auto px-6">
            @guest
                <!-- Login Overlay for non-authenticated users -->
                <div class="glass-card rounded-3xl p-8 md:p-10 relative">
                    <div class="login-overlay relative inset-0 bg-transparent rounded-3xl flex items-center justify-center">
                        <div class="text-center p-8">
                            <!-- Lock Icon Circle -->
                            <div class="w-28 h-28 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-8 transform hover:scale-105 transition-transform">
                                <svg class="w-16 h-16 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm6-10V7a3 3 0 00-3-3 3 3 0 00-3 3v4h6z" />
                                </svg>
                            </div>

                            <!-- Heading -->
                            <h3 class="text-3xl md:text-4xl font-bold text-gray-800 mb-6">Login Required</h3>

                            <!-- Description -->
                            <p class="text-gray-600 text-lg max-w-md mx-auto mb-10 leading-relaxed">
                                Please login to your account to submit a blood request. This helps us verify and process
                                your request quickly.
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
                    </div>
                </div>
            @else
                <div class="form-container glass-card rounded-3xl p-8 md:p-10 relative">
                    <div class="text-center mb-8">
                        <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-2">Blood Request Form</h2>
                        <p class="text-gray-600">Please provide accurate information for faster response</p>
                    </div>

                    <!-- Success Message -->
                    @if (session('success'))
                        <div
                            class="mb-6 p-4 bg-green-100 border border-green-300 text-green-700 rounded-xl flex items-center gap-3">
                            <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>{{ session('success') }}</span>
                        </div>
                    @endif

                    <!-- Error Messages -->
                    @if ($errors->any())
                        <div class="mb-6 p-4 bg-red-100 border border-red-300 text-red-700 rounded-xl">
                            <div class="flex items-center gap-2 mb-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="font-semibold">Please fix the following errors:</span>
                            </div>
                            <ul class="list-disc list-inside space-y-1 text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('blood.request.store') }}" method="POST" enctype="multipart/form-data"
                        class="space-y-6" onsubmit="return validateBloodStock(event)">
                        @csrf

                        <!-- Patient Name -->
                        <div>
                            <label for="patient_name" class="block text-sm font-semibold text-gray-700 mb-2">
                                <span class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    Patient Name <span class="text-red-500">*</span>
                                </span>
                            </label>
                            <input type="text" id="patient_name" name="patient_name" value="{{ old('patient_name') }}"
                                required
                                class="input-field w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none text-gray-700"
                                placeholder="Enter patient's full name">
                    </div>

                    <!-- Phone Number -->
                    <div>
                        <label for="phone" class="block text-sm font-semibold text-gray-700 mb-2">
                            <span class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                                Phone Number <span class="text-red-500">*</span>
                            </span>
                        </label>
                        <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" required
                            class="input-field w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none text-gray-700"
                            placeholder="Enter contact number">
                    </div>

                    <!-- Address -->
                    <div>
                        <label for="address" class="block text-sm font-semibold text-gray-700 mb-2">
                            <span class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                Address <span class="text-red-500">*</span>
                            </span>
                        </label>
                        <textarea id="address" name="address" rows="3" required
                            class="input-field w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none text-gray-700 resize-none"
                            placeholder="Enter complete address">{{ old('address') }}</textarea>
                    </div>

                    <!-- Hospital Name -->
                    <div>
                        <label for="hospital_name" class="block text-sm font-semibold text-gray-700 mb-2">
                            <span class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                                Hospital Name <span class="text-red-500">*</span>
                            </span>
                        </label>
                        <input type="text" id="hospital_name" name="hospital_name" value="{{ old('hospital_name') }}"
                            required
                            class="input-field w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none text-gray-700"
                            placeholder="Enter hospital name">
                    </div>

                    <!-- Blood Type Selection -->
                    <div>
                        <label for="blood_type" class="block text-sm font-semibold text-gray-700 mb-2">
                            <span class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-red-500" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                                </svg>
                                Blood Type Required <span class="text-red-500">*</span>
                            </span>
                        </label>
                        <select id="blood_type" name="blood_type" required onchange="checkBloodStock(this.value)"
                            class="input-field w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none text-gray-700 bg-white">
                            <option value="">Select blood type</option>
                            @foreach (['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'] as $type)
                                <option value="{{ $type }}" {{ old('blood_type') == $type ? 'selected' : '' }}
                                    data-units="{{ $bloodStocks[$type]['units'] ?? 0 }}"
                                    data-status="{{ $bloodStocks[$type]['status'] ?? 'out_of_stock' }}">
                                    {{ $type }}
                                </option>
                            @endforeach
                        </select>

                        <!-- Stock Not Available Error -->
                        <div id="stock-error" class="hidden mt-4 p-4 bg-red-50 border border-red-300 rounded-xl">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center">
                                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-semibold text-red-800">Blood Not Available</p>
                                    <p class="text-sm text-red-600">The selected blood type is currently out of stock.
                                        Please choose another type.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Stock Availability Alert (shown when blood type is selected) -->
                        <div id="stock-alert" class="mt-4 hidden">
                            <div id="stock-available" class="hidden p-4 bg-green-50 border border-green-300 rounded-xl">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-green-800"><span id="selected-type-available"></span>
                                            Blood Available</p>
                                        <p class="text-sm text-green-600"><span id="available-units"></span> units in
                                            stock</p>
                                    </div>
                                </div>
                            </div>
                            <div id="stock-low" class="hidden p-4 bg-yellow-50 border border-yellow-300 rounded-xl">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-yellow-100 rounded-full flex items-center justify-center">
                                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-yellow-800"><span id="selected-type-low"></span>
                                            Blood - Low Stock</p>
                                        <p class="text-sm text-yellow-600">Only <span id="low-units"></span> units
                                            remaining. Request may take longer to fulfill.</p>
                                    </div>
                                </div>
                            </div>
                            <div id="stock-critical" class="hidden p-4 bg-orange-50 border border-orange-300 rounded-xl">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-orange-100 rounded-full flex items-center justify-center">
                                        <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-orange-800"><span id="selected-type-critical"></span>
                                            Blood - Critical Stock!</p>
                                        <p class="text-sm text-orange-600">Only <span id="critical-units"></span> units
                                            left. We'll search for donors urgently.</p>
                                    </div>
                                </div>
                            </div>
                            <div id="stock-out" class="hidden p-4 bg-red-50 border border-red-300 rounded-xl">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center">
                                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-red-800"><span id="selected-type-out"></span> Blood -
                                            Out of Stock!</p>
                                        <p class="text-sm text-red-600">Currently unavailable. We'll notify available
                                            donors immediately.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Doctor Prescription Upload -->
                    <div>
                        <label for="doctor_prescription" class="block text-sm font-semibold text-gray-700 mb-2">
                            <span class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                Doctor's Prescription (Photo) <span class="text-red-500">*</span>
                            </span>
                        </label>
                        <div class="relative">
                            <input type="file" id="doctor_prescription" name="doctor_prescription" accept="image/*"
                                required class="hidden" onchange="previewPrescription(this)">
                            <label for="doctor_prescription"
                                class="flex flex-col items-center justify-center w-full h-40 border-2 border-dashed border-gray-300 rounded-xl cursor-pointer hover:border-red-400 hover:bg-red-50 transition-all">
                                <div id="upload-placeholder" class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg class="w-10 h-10 text-gray-400 mb-3" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                    </svg>
                                    <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Click to
                                            upload</span> or drag and drop</p>
                                    <p class="text-xs text-gray-400">PNG, JPG or JPEG (MAX. 5MB)</p>
                                </div>
                                <div id="preview-container" class="hidden w-full h-full p-2">
                                    <img id="prescription-preview" class="w-full h-full object-contain rounded-lg"
                                        alt="Prescription preview">
                                </div>
                            </label>
                            <button type="button" id="remove-preview" onclick="removePrescription()"
                                class="hidden absolute top-2 right-2 bg-red-500 text-white rounded-full p-1 hover:bg-red-600 transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                        <p class="mt-2 text-xs text-gray-500">Upload a clear photo of the doctor's prescription for
                            verification</p>
                    </div>

                    <!-- Units Required -->
                    <div>
                        <label for="units_required" class="block text-sm font-semibold text-gray-700 mb-2">
                            <span class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14" />
                                </svg>
                                Units Required <span class="text-red-500">*</span>
                            </span>
                        </label>
                        <select id="units_required" name="units_required" required
                            class="input-field w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none text-gray-700 bg-white">
                            <option value="">Select units</option>
                            @for ($i = 1; $i <= 10; $i++)
                                <option value="{{ $i }}" {{ old('units_required') == $i ? 'selected' : '' }}>
                                    {{ $i }} {{ $i == 1 ? 'Unit' : 'Units' }}</option>
                            @endfor
                        </select>
                    </div>

                    <!-- Urgency Level -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-3">
                            <span class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Urgency Level <span class="text-red-500">*</span>
                            </span>
                        </label>
                        <div class="grid grid-cols-3 gap-3">
                            <label
                                class="blood-type-card border-2 border-gray-200 rounded-xl p-3 text-center cursor-pointer hover:border-green-300 {{ old('urgency') == 'normal' ? 'bg-green-50 border-green-400' : '' }}">
                                <input type="radio" name="urgency" value="normal" class="hidden"
                                    {{ old('urgency') == 'normal' ? 'checked' : '' }} required>
                                <span class="text-sm font-semibold text-gray-700">Normal</span>
                            </label>
                            <label
                                class="blood-type-card border-2 border-gray-200 rounded-xl p-3 text-center cursor-pointer hover:border-yellow-300 {{ old('urgency') == 'urgent' ? 'bg-yellow-50 border-yellow-400' : '' }}">
                                <input type="radio" name="urgency" value="urgent" class="hidden"
                                    {{ old('urgency') == 'urgent' ? 'checked' : '' }}>
                                <span class="text-sm font-semibold text-gray-700">Urgent</span>
                            </label>
                            <label
                                class="blood-type-card border-2 border-gray-200 rounded-xl p-3 text-center cursor-pointer hover:border-red-300 {{ old('urgency') == 'critical' ? 'bg-red-50 border-red-400' : '' }}">
                                <input type="radio" name="urgency" value="critical" class="hidden"
                                    {{ old('urgency') == 'critical' ? 'checked' : '' }}>
                                <span class="text-sm font-semibold text-gray-700">Critical</span>
                            </label>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-4">
                        <button type="submit" id="submit-btn"
                            class="w-full py-4 bg-gradient-to-r from-red-500 to-red-600 text-white font-bold text-lg rounded-xl hover:from-red-600 hover:to-red-700 transition-all shadow-lg hover:shadow-xl flex items-center justify-center gap-3 cursor-pointer">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Submit Blood Request
                        </button>
                    </div>
                    </form>
                </div>
            @endauth

            <!-- Additional Info -->
            <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="text-center p-6 bg-red-50 rounded-2xl">
                    <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="font-bold text-gray-800 mb-2">Quick Response</h3>
                    <p class="text-sm text-gray-600">We process urgent requests within 2 hours</p>
                </div>
                <div class="text-center p-6 bg-red-50 rounded-2xl">
                    <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h3 class="font-bold text-gray-800 mb-2">Verified Donors</h3>
                    <p class="text-sm text-gray-600">All our donors are verified and tested</p>
                </div>
                <div class="text-center p-6 bg-red-50 rounded-2xl">
                    <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                    </div>
                    <h3 class="font-bold text-gray-800 mb-2">24/7 Support</h3>
                    <p class="text-sm text-gray-600">Our team is always available to help</p>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('scripts')
    <script>
        // Store current blood stock status
        let currentBloodStatus = null;

        // Validate blood stock before form submission
        function validateBloodStock(event) {
            const bloodTypeSelect = document.getElementById('blood_type');
            const selectedOption = bloodTypeSelect.options[bloodTypeSelect.selectedIndex];
            const status = selectedOption.dataset.status;

            // Check if blood type is selected
            if (!bloodTypeSelect.value) {
                event.preventDefault();
                alert('Please select a blood type');
                return false;
            }

            // Check if blood is out of stock
            if (status === 'out_of_stock') {
                event.preventDefault();
                document.getElementById('stock-error').classList.remove('hidden');
                document.getElementById('blood_type').focus();
                alert('The selected blood type is currently out of stock. Please choose another type.');
                return false;
            }

            // Hide error if it was shown
            document.getElementById('stock-error').classList.add('hidden');
            return true;
        }

        // Check blood stock when blood type is selected
        function checkBloodStock(bloodType) {
            if (!bloodType) {
                document.getElementById('stock-alert').classList.add('hidden');
                document.getElementById('stock-error').classList.add('hidden');
                return;
            }

            const select = document.getElementById('blood_type');
            const selectedOption = select.options[select.selectedIndex];
            const units = selectedOption.dataset.units;
            const status = selectedOption.dataset.status;

            // Store status for form validation
            currentBloodStatus = status;

            // Show error if out of stock
            if (status === 'out_of_stock') {
                document.getElementById('stock-error').classList.remove('hidden');
                document.getElementById('stock-alert').classList.add('hidden');
            } else {
                document.getElementById('stock-error').classList.add('hidden');
                showStockAlert(bloodType, units, status);
            }
        }

        // Show stock alert based on status
        function showStockAlert(bloodType, units, status) {
            const stockAlert = document.getElementById('stock-alert');
            const stockAvailable = document.getElementById('stock-available');
            const stockLow = document.getElementById('stock-low');
            const stockCritical = document.getElementById('stock-critical');
            const stockOut = document.getElementById('stock-out');

            // Hide all alerts first
            stockAvailable.classList.add('hidden');
            stockLow.classList.add('hidden');
            stockCritical.classList.add('hidden');
            stockOut.classList.add('hidden');

            // Show appropriate alert
            stockAlert.classList.remove('hidden');

            if (status === 'available') {
                document.getElementById('selected-type-available').textContent = bloodType;
                document.getElementById('available-units').textContent = units;
                stockAvailable.classList.remove('hidden');
            } else if (status === 'low') {
                document.getElementById('selected-type-low').textContent = bloodType;
                document.getElementById('low-units').textContent = units;
                stockLow.classList.remove('hidden');
            } else if (status === 'critical') {
                document.getElementById('selected-type-critical').textContent = bloodType;
                document.getElementById('critical-units').textContent = units;
                stockCritical.classList.remove('hidden');
            } else {
                document.getElementById('selected-type-out').textContent = bloodType;
                stockOut.classList.remove('hidden');
            }
        }

        // Urgency card selection
        document.querySelectorAll('.blood-type-card').forEach(card => {
            card.addEventListener('click', function() {
                const input = this.querySelector('input[type="radio"]');
                const name = input.name;

                if (name === 'urgency') {
                    // Remove selected class from all urgency cards
                    document.querySelectorAll(`input[name="${name}"]`).forEach(radio => {
                        radio.closest('.blood-type-card').classList.remove('bg-green-50',
                            'border-green-400', 'bg-yellow-50', 'border-yellow-400',
                            'bg-red-50', 'border-red-400');
                    });

                    // Add selected class to clicked card
                    const value = input.value;
                    if (value === 'normal') {
                        this.classList.add('bg-green-50', 'border-green-400');
                    } else if (value === 'urgent') {
                        this.classList.add('bg-yellow-50', 'border-yellow-400');
                    } else if (value === 'critical') {
                        this.classList.add('bg-red-50', 'border-red-400');
                    }
                }
            });
        });

        // Prescription image preview
        function previewPrescription(input) {
            const file = input.files[0];
            if (file) {
                // Check file size (5MB max)
                if (file.size > 5 * 1024 * 1024) {
                    alert('File size must be less than 5MB');
                    input.value = '';
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('prescription-preview').src = e.target.result;
                    document.getElementById('upload-placeholder').classList.add('hidden');
                    document.getElementById('preview-container').classList.remove('hidden');
                    document.getElementById('remove-preview').classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            }
        }

        // Remove prescription preview
        function removePrescription() {
            document.getElementById('doctor_prescription').value = '';
            document.getElementById('prescription-preview').src = '';
            document.getElementById('upload-placeholder').classList.remove('hidden');
            document.getElementById('preview-container').classList.add('hidden');
            document.getElementById('remove-preview').classList.add('hidden');
        }
    </script>
@endpush
