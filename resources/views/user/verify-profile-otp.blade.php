@extends('layouts.app')

@section('title', 'Verify Profile Update - JeevanPravaah')

@section('content')
    <section
        class="min-h-screen bg-gradient-to-br from-red-50 via-white to-red-50 flex items-center justify-center py-12 px-4">
        <div class="w-full max-w-md">
            <div class="bg-white rounded-3xl shadow-2xl overflow-hidden">
                <div class="p-8 sm:p-10">
                    <!-- Logo & Header -->
                    <div class="text-center mb-8">
                        <div
                            class="inline-flex w-20 h-20 bg-gradient-to-br from-red-500 to-red-600 rounded-full items-center justify-center shadow-lg mb-4">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <h1 class="text-2xl sm:text-3xl font-black text-gray-900 mb-2">Verify Profile Update</h1>
                        <p class="text-gray-600 text-sm">
                            We've sent a 6-digit OTP to<br>
                            <span class="font-semibold text-red-600">{{ $email }}</span>
                        </p>
                    </div>

                    <!-- Success Message -->
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

                    <!-- OTP Form -->
                    <form action="{{ route('profile.verify.otp') }}" method="POST" class="space-y-6">
                        @csrf

                        <!-- OTP Input -->
                        <div>
                            <label for="otp" class="block text-sm font-semibold text-gray-700 mb-2">Enter OTP</label>
                            <div class="relative">
                                <input type="text" name="otp" id="otp" maxlength="6" pattern="[0-9]{6}"
                                    inputmode="numeric" autocomplete="one-time-code"
                                    class="w-full px-4 py-4 text-center text-2xl font-bold tracking-[0.5em] border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all placeholder:tracking-normal placeholder:text-base placeholder:font-normal"
                                    placeholder="000000" required>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-4">
                                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                </div>
                            </div>
                            <p class="mt-2 text-xs text-gray-500 text-center">OTP is valid for 10 minutes</p>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit"
                            class="cursor-pointer w-full py-4 bg-gradient-to-r from-red-600 to-red-500 hover:from-red-700 hover:to-red-600 text-white text-lg font-bold rounded-xl shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-0.5 flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Verify & Update Profile
                        </button>
                    </form>

                    <!-- Resend OTP -->
                    <div class="mt-6 pt-6 border-t border-gray-100 text-center">
                        <p class="text-sm text-gray-600 mb-3">Didn't receive the OTP?</p>
                        <form action="{{ route('profile.resend.otp') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit"
                                class="cursor-pointer text-red-600 hover:text-red-700 font-semibold text-sm hover:underline inline-flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                </svg>
                                Resend OTP
                            </button>
                        </form>
                    </div>

                    <!-- Back to Profile -->
                    <div class="mt-4 text-center">
                        <a href="{{ route('profile.show') }}"
                            class="text-gray-500 hover:text-gray-700 text-sm inline-flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Cancel & Back to Profile
                        </a>
                    </div>
                </div>
            </div>

            <!-- Security Note -->
            <p class="text-center text-xs text-gray-500 mt-6">
                <svg class="w-4 h-4 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                        clip-rule="evenodd" />
                </svg>
                Your profile changes require email verification for security
            </p>
        </div>
    </section>
@endsection
