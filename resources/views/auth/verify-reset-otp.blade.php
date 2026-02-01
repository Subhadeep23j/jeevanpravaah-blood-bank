@extends('layouts.app')

@section('title', 'Verify OTP - JeevanPravaah')

@section('content')
    <section
        class="min-h-screen bg-gradient-to-br from-red-50 via-white to-red-50 flex items-center justify-center py-12 px-4">
        <div class="w-full max-w-md">
            <div class="bg-white rounded-3xl shadow-2xl overflow-hidden p-8 sm:p-10">
                <!-- Logo & Header -->
                <div class="text-center mb-8">
                    <div
                        class="inline-flex w-16 h-16 bg-gradient-to-br from-red-500 to-red-600 rounded-2xl items-center justify-center shadow-lg mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h1 class="text-3xl font-black text-gray-900 mb-2">Verify OTP</h1>
                    <p class="text-gray-600">Enter the 6-digit code sent to</p>
                    <p class="text-red-600 font-semibold">{{ $email }}</p>
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

                <!-- OTP Verification Form -->
                <form action="{{ route('password.verify.otp') }}" method="POST" class="space-y-5">
                    @csrf

                    <!-- OTP Field -->
                    <div>
                        <label for="otp" class="block text-sm font-semibold text-gray-700 mb-2">Verification
                            Code</label>
                        <input type="text" name="otp" id="otp" maxlength="6" required
                            placeholder="Enter 6-digit OTP" autocomplete="one-time-code"
                            class="w-full px-4 py-3.5 border-2 border-gray-200 rounded-xl text-gray-900 placeholder-gray-400 focus:outline-none focus:border-red-500 focus:ring-4 focus:ring-red-100 transition-all text-center text-2xl tracking-widest font-mono" />
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                        class="w-full bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white font-bold py-4 rounded-xl shadow-lg hover:shadow-xl transform hover:scale-[1.02] transition-all duration-200 cursor-pointer">
                        Verify OTP
                    </button>
                </form>

                <!-- Resend OTP -->
                <div class="mt-6 text-center">
                    <p class="text-sm text-gray-600 mb-2">Didn't receive the code?</p>
                    <form action="{{ route('password.resend.otp') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit"
                            class="text-sm font-semibold text-red-600 hover:text-red-700 transition-colors cursor-pointer">
                            Resend OTP
                        </button>
                    </form>
                </div>

                <!-- Back to Forgot Password -->
                <div class="mt-4 text-center">
                    <a href="{{ route('password.request') }}"
                        class="inline-flex items-center text-sm font-semibold text-gray-600 hover:text-red-600 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Change Email
                    </a>
                </div>
            </div>
        </div>
    </section>

    <script>
        // Auto-focus and auto-submit when 6 digits entered
        document.addEventListener('DOMContentLoaded', function() {
            const otpInput = document.getElementById('otp');
            otpInput.focus();

            otpInput.addEventListener('input', function(e) {
                // Only allow numbers
                this.value = this.value.replace(/[^0-9]/g, '');
            });
        });
    </script>
@endsection
