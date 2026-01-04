@extends('layouts.app')

@section('title', 'Admin Login - JeevanPravaah')

@section('content')
    <section
        class="min-h-screen bg-gradient-to-br from-red-50 via-white to-red-50 flex items-center justify-center py-12 px-4">
        <div class="w-full max-w-md">
            <div class="bg-white rounded-3xl shadow-2xl overflow-hidden p-8 sm:p-10">
                <!-- Logo & Header -->
                <div class="text-center mb-8">
                    <div
                        class="inline-flex w-16 h-16 bg-gradient-to-br from-red-500 to-red-600 rounded-2xl items-center justify-center shadow-lg mb-4">
                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                        </svg>
                    </div>
                    <h1 class="text-3xl font-black text-gray-900 mb-2">Welcome Back</h1>
                    <p class="text-gray-600">Sign in to continue saving lives</p>
                </div>

                <!-- Success/Error Messages -->
                @if (session('success'))
                    <div class="mb-6 rounded-xl bg-green-50 border-l-4 border-green-500 px-4 py-4">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-green-500 mr-3 flex-shrink-0 mt-0.5" fill="currentColor"
                                viewBox="0 0 20 20">
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

                <!-- Login Form -->
                <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-5">
                    @csrf

                    <!-- Email Field -->
                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email Address</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required
                            autocomplete="email" placeholder="you@example.com"
                            class="w-full px-4 py-3.5 border-2 border-gray-200 rounded-xl text-gray-900 placeholder-gray-400 focus:outline-none focus:border-red-500 focus:ring-4 focus:ring-red-100 transition-all" />
                    </div>

                    <!-- Password Field -->
                    <div>
                        <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
                        <input type="password" name="password" id="password" required autocomplete="current-password"
                            placeholder="Enter your password"
                            class="w-full px-4 py-3.5 border-2 border-gray-200 rounded-xl text-gray-900 placeholder-gray-400 focus:outline-none focus:border-red-500 focus:ring-4 focus:ring-red-100 transition-all" />
                    </div>

                    <!-- Remember & Forgot -->
                    <div class="flex items-center justify-between">
                        <label class="flex items-center">
                            <input type="checkbox" name="remember"
                                class="w-4 h-4 text-red-600 border-gray-300 rounded focus:ring-red-500">
                            <span class="ml-2 text-sm text-gray-600">Remember me</span>
                        </label>
                        <a href="#" class="text-sm font-semibold text-red-600 hover:text-red-700 transition-colors">
                            Forgot password?
                        </a>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                        class="w-full bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white font-bold py-4 rounded-xl shadow-lg hover:shadow-xl transform hover:scale-[1.02] transition-all duration-200 cursor-pointer">
                        Login
                    </button>
                </form>

                <!-- Divider -->
                <div class="relative my-6">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-200"></div>
                    </div>
                </div>

                <!-- Register Link -->
                {{-- <a href="{{ url('/register') }}"
                    class="block w-full text-center py-4 border-2 border-gray-200 rounded-xl text-gray-700 font-semibold hover:border-red-500 hover:text-red-600 hover:bg-red-50 transition-all duration-200">
                    Create Account
                </a> --}}
            </div>
        </div>
    </section>
@endsection
