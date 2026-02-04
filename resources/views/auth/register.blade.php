@extends('layouts.app')

@section('title', 'Register - JeevanPravaah')

@section('content')
    <section
        class="min-h-screen bg-gradient-to-br from-red-50 via-white to-red-50 flex items-center justify-center py-12 px-4">
        <div class="w-full max-w-4xl">
            <div class="bg-white rounded-3xl shadow-2xl overflow-hidden">
                <div class="p-6 sm:p-8">
                    <!-- Logo & Header -->
                    <div class="text-center mb-6">
                        <div
                            class="inline-flex w-14 h-14 bg-gradient-to-br from-red-500 to-red-600 rounded-2xl items-center justify-center shadow-lg mb-3">
                            <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                            </svg>
                        </div>
                        <h1 class="text-2xl sm:text-3xl font-black text-gray-900 mb-1">Create Your Account</h1>
                        <p class="text-gray-600 text-sm">Join our community of life savers today</p>
                    </div>

                    <!-- Error Messages -->
                    @if ($errors->any())
                        <div class="mb-4 rounded-xl bg-red-50 border-l-4 border-red-500 px-4 py-3">
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

                    <!-- Register Form -->
                    <form action="{{ route('register.send-otp') }}" method="POST" class="space-y-4"
                        enctype="multipart/form-data">
                        @csrf

                        <!-- Personal Information Section -->
                        <div class="bg-gray-50 rounded-xl p-4 border border-gray-100">
                            <h3 class="text-base font-bold text-gray-900 mb-4 flex items-center gap-2">
                                <div
                                    class="w-8 h-8 bg-gradient-to-br from-red-500 to-red-600 rounded-lg flex items-center justify-center shadow-md shadow-red-200">
                                    <span class="text-white font-bold text-xs">1</span>
                                </div>
                                Personal Information
                            </h3>

                            <!-- Profile Photo - Centered -->
                            <div class="flex justify-center mb-4">
                                <div class="text-center">
                                    <div
                                        class="w-20 h-20 rounded-full overflow-hidden bg-gray-100 border-4 border-white shadow-lg mx-auto mb-2">
                                        <img id="profilePreview" src="{{ asset('assets/profile.svg') }}" alt="Preview"
                                            class="w-full h-full object-cover">
                                    </div>
                                    <label for="profile_image" class="cursor-pointer">
                                        <span
                                            class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-red-50 text-red-600 rounded-lg text-xs font-semibold hover:bg-red-100 transition-colors">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                            Upload
                                        </span>
                                        <input type="file" name="profile_image" id="profile_image" accept="image/*"
                                            class="hidden" />
                                    </label>
                                    <p class="mt-1 text-xs text-gray-500">PNG, JPG up to 2MB</p>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                <!-- Name -->
                                <div>
                                    <label for="name" class="block text-xs font-semibold text-gray-700 mb-1">Full
                                        Name</label>
                                    <input type="text" name="name" id="name" value="{{ old('name') }}" required
                                        placeholder="Ram Choudhary"
                                        class="w-full px-3 py-2 border-2 border-gray-200 rounded-lg text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:border-red-500 focus:ring-2 focus:ring-red-100 transition-all" />
                                </div>

                                <!-- Email -->
                                <div>
                                    <label for="email" class="block text-xs font-semibold text-gray-700 mb-1">Email
                                        Address</label>
                                    <input type="email" name="email" id="email" value="{{ old('email') }}" required
                                        placeholder="ram.choudhary@gmail.com"
                                        class="w-full px-3 py-2 border-2 border-gray-200 rounded-lg text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:border-red-500 focus:ring-2 focus:ring-red-100 transition-all" />
                                </div>

                                <!-- Phone -->
                                <div>
                                    <label for="phone" class="block text-xs font-semibold text-gray-700 mb-1">Phone
                                        Number</label>
                                    <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" required
                                        placeholder="+91 98765 43210"
                                        class="w-full px-3 py-2 border-2 border-gray-200 rounded-lg text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:border-red-500 focus:ring-2 focus:ring-red-100 transition-all" />
                                </div>

                                <!-- Aadhar -->
                                <div>
                                    <label for="aadhar" class="block text-xs font-semibold text-gray-700 mb-1">Aadhar
                                        Number</label>
                                    <input type="text" name="aadhar" id="aadhar" value="{{ old('aadhar') }}" required
                                        placeholder="XXXX XXXX XXXX"
                                        class="w-full px-3 py-2 border-2 border-gray-200 rounded-lg text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:border-red-500 focus:ring-2 focus:ring-red-100 transition-all" />
                                </div>

                                <!-- Date of Birth -->
                                <div>
                                    <label for="date_of_birth" class="block text-xs font-semibold text-gray-700 mb-1">Date
                                        of Birth</label>
                                    <input type="date" name="date_of_birth" id="date_of_birth"
                                        value="{{ old('date_of_birth') }}" required
                                        class="w-full px-3 py-2 border-2 border-gray-200 rounded-lg text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:border-red-500 focus:ring-2 focus:ring-red-100 transition-all" />
                                </div>

                                <!-- Gender -->
                                <div>
                                    <label for="gender"
                                        class="block text-xs font-semibold text-gray-700 mb-1">Gender</label>
                                    <select name="gender" id="gender" required
                                        class="w-full px-3 py-2 border-2 border-gray-200 rounded-lg text-sm text-gray-900 focus:outline-none focus:border-red-500 focus:ring-2 focus:ring-red-100 transition-all appearance-none bg-white cursor-pointer">
                                        <option value="">Select Gender</option>
                                        <option value="male" {{ old('gender') === 'male' ? 'selected' : '' }}>♂ Male
                                        </option>
                                        <option value="female" {{ old('gender') === 'female' ? 'selected' : '' }}>♀ Female
                                        </option>
                                        <option value="other" {{ old('gender') === 'other' ? 'selected' : '' }}>⚧ Other
                                        </option>
                                    </select>
                                </div>

                                <!-- Blood Group - Full Width with Special Styling -->
                                <div class="md:col-span-2">
                                    <label for="blood_group" class="block text-xs font-semibold text-gray-700 mb-1">Blood
                                        Group</label>
                                    <div class="grid grid-cols-4 md:grid-cols-8 gap-1.5">
                                        @foreach (['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-'] as $bg)
                                            <label class="blood-group-option">
                                                <input type="radio" name="blood_group" value="{{ $bg }}"
                                                    {{ old('blood_group') === $bg ? 'checked' : '' }} required
                                                    class="hidden peer">
                                                <div
                                                    class="flex flex-col items-center justify-center p-2 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-red-300 hover:bg-red-50 peer-checked:border-red-500 peer-checked:bg-red-50 peer-checked:ring-1 peer-checked:ring-red-200 transition-all">
                                                    <span
                                                        class="text-sm font-bold text-red-600">{{ $bg }}</span>
                                                </div>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Address Section -->
                        <div class="bg-gray-50 rounded-xl p-4 border border-gray-100">
                            <h3 class="text-base font-bold text-gray-900 mb-4 flex items-center gap-2">
                                <div
                                    class="w-8 h-8 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center shadow-md shadow-blue-200">
                                    <span class="text-white font-bold text-xs">2</span>
                                </div>
                                Address Details
                            </h3>

                            <div class="space-y-3">
                                <!-- Street Address - Full Width -->
                                <div>
                                    <label for="address" class="block text-xs font-semibold text-gray-700 mb-1">Street
                                        Address</label>
                                    <input type="text" name="address" id="address" value="{{ old('address') }}"
                                        required placeholder="123 Main Street, Apartment 4B"
                                        class="w-full px-3 py-2 border-2 border-gray-200 rounded-lg text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:border-red-500 focus:ring-2 focus:ring-red-100 transition-all" />
                                </div>

                                <!-- City, State, PIN - 3 Column Grid -->
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                                    <!-- City -->
                                    <div>
                                        <label for="city"
                                            class="block text-xs font-semibold text-gray-700 mb-1">City</label>
                                        <input type="text" name="city" id="city" value="{{ old('city') }}"
                                            required placeholder="Kolkata"
                                            class="w-full px-3 py-2 border-2 border-gray-200 rounded-lg text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:border-red-500 focus:ring-2 focus:ring-red-100 transition-all" />
                                    </div>

                                    <!-- State -->
                                    <div>
                                        <label for="state"
                                            class="block text-xs font-semibold text-gray-700 mb-1">State</label>
                                        <input type="text" name="state" id="state" value="{{ old('state') }}"
                                            required placeholder="West Bengal"
                                            class="w-full px-3 py-2 border-2 border-gray-200 rounded-lg text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:border-red-500 focus:ring-2 focus:ring-red-100 transition-all" />
                                    </div>

                                    <!-- PIN -->
                                    <div>
                                        <label for="pin" class="block text-xs font-semibold text-gray-700 mb-1">PIN
                                            Code</label>
                                        <input type="text" name="pin" id="pin" value="{{ old('pin') }}"
                                            required placeholder="700001"
                                            class="w-full px-3 py-2 border-2 border-gray-200 rounded-lg text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:border-red-500 focus:ring-2 focus:ring-red-100 transition-all" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Password Section -->
                        <div class="bg-gray-50 rounded-xl p-4 border border-gray-100">
                            <h3 class="text-base font-bold text-gray-900 mb-4 flex items-center gap-2">
                                <div
                                    class="w-8 h-8 bg-gradient-to-br from-green-500 to-green-600 rounded-lg flex items-center justify-center shadow-md shadow-green-200">
                                    <span class="text-white font-bold text-xs">3</span>
                                </div>
                                Secure Your Account
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                <!-- Password -->
                                <div>
                                    <label for="password"
                                        class="block text-xs font-semibold text-gray-700 mb-1">Password</label>
                                    <div class="relative w-full">
                                        <input type="password" name="password" id="password" required
                                            placeholder="Create a strong password"
                                            class="w-full px-3 py-2 pr-10 border-2 border-gray-200 rounded-lg text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:border-red-500 focus:ring-2 focus:ring-red-100 transition-all" />
                                        <button type="button" id="togglePassword"
                                            class="absolute inset-y-0 right-0 flex items-center justify-center w-10 h-full text-gray-400 hover:text-gray-600 focus:outline-none cursor-pointer transition-colors">
                                            <svg id="eyeIcon" class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            <svg id="eyeOffIcon" class="w-4 h-4 hidden" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                                <!-- Confirm Password -->
                                <div>
                                    <label for="password_confirmation"
                                        class="block text-xs font-semibold text-gray-700 mb-1">Confirm Password</label>
                                    <div class="relative w-full">
                                        <input type="password" name="password_confirmation" id="password_confirmation"
                                            required placeholder="Re-enter your password"
                                            class="w-full px-3 py-2 pr-10 border-2 border-gray-200 rounded-lg text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:border-red-500 focus:ring-2 focus:ring-red-100 transition-all" />
                                        <button type="button" id="toggleConfirmPassword"
                                            class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-600 focus:outline-none cursor-pointer">
                                            <svg id="eyeIconConfirm" class="w-4 h-4" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            <svg id="eyeOffIconConfirm" class="w-4 h-4 hidden" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                            </svg>
                                        </button>
                                    </div>
                                    <!-- Password Match Indicator -->
                                    <div id="passwordMatchIndicator" class="mt-2 hidden">
                                        <div id="passwordMatch" class="flex items-center gap-2 text-sm text-green-600">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            Passwords match
                                        </div>
                                        <div id="passwordNoMatch" class="flex items-center gap-2 text-sm text-red-600">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            Passwords do not match
                                        </div>
                                    </div>
                                </div>

                                <!-- Password Requirements -->
                                <div class="md:col-span-2">
                                    <div class="bg-white rounded-lg p-3 border border-gray-200">
                                        <p class="text-xs font-semibold text-gray-700 mb-2">Password Requirements:</p>
                                        <ul class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-1 text-xs">
                                            <li id="req-length" class="flex items-center gap-1 text-gray-400">
                                                <svg class="w-3 h-3 req-icon" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                8+ chars
                                            </li>
                                            <li id="req-uppercase" class="flex items-center gap-1 text-gray-400">
                                                <svg class="w-3 h-3 req-icon" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                Uppercase
                                            </li>
                                            <li id="req-lowercase" class="flex items-center gap-1 text-gray-400">
                                                <svg class="w-3 h-3 req-icon" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                Lowercase
                                            </li>
                                            <li id="req-number" class="flex items-center gap-1 text-gray-400">
                                                <svg class="w-3 h-3 req-icon" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                Number
                                            </li>
                                            <li id="req-special" class="flex items-center gap-1 text-gray-400">
                                                <svg class="w-3 h-3 req-icon" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                Special
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Terms & Submit -->
                        <div class="space-y-3 pt-2">
                            <label
                                class="flex items-center gap-2 p-3 bg-gray-50 rounded-lg border border-gray-200 cursor-pointer hover:bg-gray-100 transition-colors">
                                <input type="checkbox" required
                                    class="w-4 h-4 text-red-600 border-gray-300 rounded focus:ring-red-500">
                                <span class="text-xs text-gray-600">
                                    I agree to the <a href="#"
                                        class="text-red-600 font-semibold hover:underline">Terms</a> and <a href="#"
                                        class="text-red-600 font-semibold hover:underline">Privacy Policy</a>
                                </span>
                            </label>

                            <button type="submit"
                                class="group relative w-full bg-gradient-to-r from-red-600 to-red-500 hover:from-red-500 hover:to-red-600 text-white font-bold py-3 rounded-lg shadow-md shadow-red-200 hover:shadow-lg hover:shadow-red-300 transition-all duration-300 cursor-pointer flex items-center justify-center gap-2 text-sm">
                                <span>Create Account</span>
                                <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform duration-300"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                </svg>
                            </button>
                        </div>

                        <!-- Login Link -->
                        <div class="relative mt-4">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-gray-200"></div>
                            </div>
                            <div class="relative flex justify-center text-xs">
                                <span class="px-3 bg-white text-gray-500">Already have an account?</span>
                            </div>
                        </div>

                        <a href="{{ url('/login') }}"
                            class="block w-full text-center py-3 border-2 border-gray-200 rounded-lg text-gray-700 font-semibold text-sm hover:border-red-500 hover:text-red-600 hover:bg-red-50 transition-all duration-200 mt-3">
                            Login Instead
                        </a>
                    </form>
                    @push('scripts')
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                // Profile image preview
                                const input = document.getElementById('profile_image');
                                const preview = document.getElementById('profilePreview');
                                if (input && preview) {
                                    input.addEventListener('change', function() {
                                        const file = this.files && this.files[0];
                                        if (!file) return;
                                        if (!file.type.startsWith('image/')) return;
                                        const reader = new FileReader();
                                        reader.onload = (e) => {
                                            preview.src = e.target.result;
                                        };
                                        reader.readAsDataURL(file);
                                    });
                                }

                                // Password visibility toggle
                                const togglePassword = document.getElementById('togglePassword');
                                const passwordInput = document.getElementById('password');
                                const eyeIcon = document.getElementById('eyeIcon');
                                const eyeOffIcon = document.getElementById('eyeOffIcon');

                                togglePassword.addEventListener('click', function() {
                                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                                    passwordInput.setAttribute('type', type);
                                    eyeIcon.classList.toggle('hidden');
                                    eyeOffIcon.classList.toggle('hidden');
                                });

                                // Confirm password visibility toggle
                                const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
                                const confirmPasswordInput = document.getElementById('password_confirmation');
                                const eyeIconConfirm = document.getElementById('eyeIconConfirm');
                                const eyeOffIconConfirm = document.getElementById('eyeOffIconConfirm');

                                toggleConfirmPassword.addEventListener('click', function() {
                                    const type = confirmPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                                    confirmPasswordInput.setAttribute('type', type);
                                    eyeIconConfirm.classList.toggle('hidden');
                                    eyeOffIconConfirm.classList.toggle('hidden');
                                });

                                // Password requirements validation
                                const requirements = {
                                    length: {
                                        element: document.getElementById('req-length'),
                                        regex: /.{8,}/
                                    },
                                    uppercase: {
                                        element: document.getElementById('req-uppercase'),
                                        regex: /[A-Z]/
                                    },
                                    lowercase: {
                                        element: document.getElementById('req-lowercase'),
                                        regex: /[a-z]/
                                    },
                                    number: {
                                        element: document.getElementById('req-number'),
                                        regex: /[0-9]/
                                    },
                                    special: {
                                        element: document.getElementById('req-special'),
                                        regex: /[!@#$%^&*(),.?":{}|<>]/
                                    }
                                };

                                function updateRequirement(element, isValid) {
                                    if (isValid) {
                                        element.classList.remove('text-gray-400');
                                        element.classList.add('text-green-600');
                                    } else {
                                        element.classList.remove('text-green-600');
                                        element.classList.add('text-gray-400');
                                    }
                                }

                                function validatePassword() {
                                    const password = passwordInput.value;

                                    for (const [key, req] of Object.entries(requirements)) {
                                        const isValid = req.regex.test(password);
                                        updateRequirement(req.element, isValid);
                                    }

                                    // Also check password match when password changes
                                    checkPasswordMatch();
                                }

                                // Password match validation
                                const passwordMatchIndicator = document.getElementById('passwordMatchIndicator');
                                const passwordMatch = document.getElementById('passwordMatch');
                                const passwordNoMatch = document.getElementById('passwordNoMatch');

                                function checkPasswordMatch() {
                                    const password = passwordInput.value;
                                    const confirmPassword = confirmPasswordInput.value;

                                    if (confirmPassword.length === 0) {
                                        passwordMatchIndicator.classList.add('hidden');
                                        return;
                                    }

                                    passwordMatchIndicator.classList.remove('hidden');

                                    if (password === confirmPassword) {
                                        passwordMatch.classList.remove('hidden');
                                        passwordNoMatch.classList.add('hidden');
                                        confirmPasswordInput.classList.remove('border-red-500');
                                        confirmPasswordInput.classList.add('border-green-500');
                                    } else {
                                        passwordMatch.classList.add('hidden');
                                        passwordNoMatch.classList.remove('hidden');
                                        confirmPasswordInput.classList.remove('border-green-500');
                                        confirmPasswordInput.classList.add('border-red-500');
                                    }
                                }

                                // Event listeners for live validation
                                passwordInput.addEventListener('input', validatePassword);
                                confirmPasswordInput.addEventListener('input', checkPasswordMatch);
                            });
                        </script>
                    @endpush
                </div>
            </div>
        </div>
    </section>
@endsection
