@extends('layouts.app')

@section('title', 'Register - JeevanPravaah')

@section('content')
    <section
        class="min-h-screen bg-gradient-to-br from-red-50 via-white to-red-50 flex items-center justify-center py-12 px-4">
        <div class="w-full max-w-4xl">
            <div class="bg-white rounded-3xl shadow-2xl overflow-hidden">
                <div class="p-8 sm:p-12">
                    <!-- Logo & Header -->
                    <div class="text-center mb-8">
                        <div
                            class="inline-flex w-16 h-16 bg-gradient-to-br from-red-500 to-red-600 rounded-2xl items-center justify-center shadow-lg mb-4">
                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                            </svg>
                        </div>
                        <h1 class="text-3xl sm:text-4xl font-black text-gray-900 mb-2">Create Your Account</h1>
                        <p class="text-gray-600">Join our community of life savers today</p>
                    </div>

                    <!-- Error Messages -->
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

                    <!-- Register Form -->
                    <form action="{{ route('register.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <!-- Personal Information Section -->
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                                <div class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center">
                                    <span class="text-red-600 font-bold text-sm">1</span>
                                </div>
                                Personal Information
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- Name -->
                                <div>
                                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Full
                                        Name</label>
                                    <input type="text" name="name" id="name" value="{{ old('name') }}" required
                                        placeholder="John Doe"
                                        class="w-full px-4 py-3.5 border-2 border-gray-200 rounded-xl text-gray-900 placeholder-gray-400 focus:outline-none focus:border-red-500 focus:ring-4 focus:ring-red-100 transition-all" />
                                </div>

                                <!-- Email -->
                                <div>
                                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email
                                        Address</label>
                                    <input type="email" name="email" id="email" value="{{ old('email') }}" required
                                        placeholder="you@example.com"
                                        class="w-full px-4 py-3.5 border-2 border-gray-200 rounded-xl text-gray-900 placeholder-gray-400 focus:outline-none focus:border-red-500 focus:ring-4 focus:ring-red-100 transition-all" />
                                </div>

                                <!-- Phone -->
                                <div>
                                    <label for="phone" class="block text-sm font-semibold text-gray-700 mb-2">Phone
                                        Number</label>
                                    <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" required
                                        placeholder="+91 98765 43210"
                                        class="w-full px-4 py-3.5 border-2 border-gray-200 rounded-xl text-gray-900 placeholder-gray-400 focus:outline-none focus:border-red-500 focus:ring-4 focus:ring-red-100 transition-all" />
                                </div>

                                <!-- Aadhar -->
                                <div>
                                    <label for="aadhar" class="block text-sm font-semibold text-gray-700 mb-2">Aadhar
                                        Number</label>
                                    <input type="text" name="aadhar" id="aadhar" value="{{ old('aadhar') }}" required
                                        placeholder="XXXX XXXX XXXX"
                                        class="w-full px-4 py-3.5 border-2 border-gray-200 rounded-xl text-gray-900 placeholder-gray-400 focus:outline-none focus:border-red-500 focus:ring-4 focus:ring-red-100 transition-all" />
                                </div>
                            </div>
                        </div>

                        <!-- Address Section -->
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                                <div class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center">
                                    <span class="text-red-600 font-bold text-sm">2</span>
                                </div>
                                Address Details
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- Address -->
                                <div class="md:col-span-2">
                                    <label for="address" class="block text-sm font-semibold text-gray-700 mb-2">Street
                                        Address</label>
                                    <input type="text" name="address" id="address" value="{{ old('address') }}"
                                        required placeholder="123 Main Street, Apartment 4B"
                                        class="w-full px-4 py-3.5 border-2 border-gray-200 rounded-xl text-gray-900 placeholder-gray-400 focus:outline-none focus:border-red-500 focus:ring-4 focus:ring-red-100 transition-all" />
                                </div>

                                <!-- City -->
                                <div>
                                    <label for="city"
                                        class="block text-sm font-semibold text-gray-700 mb-2">City</label>
                                    <input type="text" name="city" id="city" value="{{ old('city') }}" required
                                        placeholder="Mumbai"
                                        class="w-full px-4 py-3.5 border-2 border-gray-200 rounded-xl text-gray-900 placeholder-gray-400 focus:outline-none focus:border-red-500 focus:ring-4 focus:ring-red-100 transition-all" />
                                </div>

                                <!-- PIN -->
                                <div>
                                    <label for="pin" class="block text-sm font-semibold text-gray-700 mb-2">PIN
                                        Code</label>
                                    <input type="text" name="pin" id="pin" value="{{ old('pin') }}" required
                                        placeholder="400001"
                                        class="w-full px-4 py-3.5 border-2 border-gray-200 rounded-xl text-gray-900 placeholder-gray-400 focus:outline-none focus:border-red-500 focus:ring-4 focus:ring-red-100 transition-all" />
                                </div>
                            </div>
                        </div>

                        <!-- Password Section -->
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                                <div class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center">
                                    <span class="text-red-600 font-bold text-sm">3</span>
                                </div>
                                Secure Your Account
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- Password -->
                                <div>
                                    <label for="password"
                                        class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
                                    <input type="password" name="password" id="password" required
                                        placeholder="Minimum 8 characters"
                                        class="w-full px-4 py-3.5 border-2 border-gray-200 rounded-xl text-gray-900 placeholder-gray-400 focus:outline-none focus:border-red-500 focus:ring-4 focus:ring-red-100 transition-all" />
                                </div>

                                <!-- Confirm Password -->
                                <div>
                                    <label for="password_confirmation"
                                        class="block text-sm font-semibold text-gray-700 mb-2">Confirm Password</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation"
                                        required placeholder="Re-enter your password"
                                        class="w-full px-4 py-3.5 border-2 border-gray-200 rounded-xl text-gray-900 placeholder-gray-400 focus:outline-none focus:border-red-500 focus:ring-4 focus:ring-red-100 transition-all" />
                                </div>
                            </div>
                        </div>

                        <!-- Terms & Submit -->
                        <div class="space-y-4 pt-2">
                            <label class="flex items-start gap-3">
                                <input type="checkbox" required
                                    class="mt-1 w-4 h-4 text-red-600 border-gray-300 rounded focus:ring-red-500">
                                <span class="text-sm text-gray-600">
                                    I agree to the <a href="#"
                                        class="text-red-600 font-semibold hover:underline">Terms of Service</a> and <a
                                        href="#" class="text-red-600 font-semibold hover:underline">Privacy
                                        Policy</a>
                                </span>
                            </label>

                            <button type="submit"
                                class="w-full bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white font-bold py-4 rounded-xl shadow-lg hover:shadow-xl transform hover:scale-[1.02] transition-all duration-200">
                                Create Account
                            </button>
                        </div>

                        <!-- Login Link -->
                        <div class="relative">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-gray-200"></div>
                            </div>
                            <div class="relative flex justify-center text-sm">
                                <span class="px-4 bg-white text-gray-500">Already have an account?</span>
                            </div>
                        </div>

                        <a href="{{ url('/login') }}"
                            class="block w-full text-center py-4 border-2 border-gray-200 rounded-xl text-gray-700 font-semibold hover:border-red-500 hover:text-red-600 hover:bg-red-50 transition-all duration-200">
                            Sign In Instead
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
