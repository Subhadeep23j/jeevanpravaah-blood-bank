@extends('layouts.app')

@section('title', 'Verify OTP - Delete Account')

@section('content')
    <div
        class="min-h-screen flex items-center justify-center bg-gradient-to-br from-red-50 to-white py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full">
            <!-- Header -->
            <div class="text-center mb-8">
                <div class="mx-auto w-20 h-20 bg-red-100 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-10 h-10 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z">
                        </path>
                    </svg>
                </div>
                <h2 class="text-3xl font-bold text-gray-900">
                    Confirm Account Deletion
                </h2>
                <p class="mt-2 text-gray-600">
                    We've sent a verification code to <span
                        class="font-semibold text-red-600">{{ session('delete_email') }}</span>
                </p>
            </div>

            <!-- Warning Box -->
            <div class="bg-red-50 border-l-4 border-red-500 rounded-lg p-4 mb-6">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800">Warning: This action is irreversible!</h3>
                        <p class="mt-1 text-sm text-red-700">
                            Once you verify and delete your account, all your data including donation history will be
                            permanently removed.
                        </p>
                    </div>
                </div>
            </div>

            <!-- OTP Form -->
            <div class="bg-white shadow-2xl rounded-2xl p-8 border border-gray-100">
                @if (session('success'))
                    <div class="mb-6 bg-green-50 border-l-4 border-green-500 rounded-lg p-4">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                            <p class="text-sm font-medium text-green-700">{{ session('success') }}</p>
                        </div>
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-6 bg-red-50 border-l-4 border-red-500 rounded-lg p-4">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-red-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                    clip-rule="evenodd" />
                            </svg>
                            <p class="text-sm font-medium text-red-700">{{ session('error') }}</p>
                        </div>
                    </div>
                @endif

                <form action="{{ route('profile.delete.otp.verify') }}" method="POST" x-data="{ otp: '' }">
                    @csrf

                    <div class="mb-6">
                        <label for="otp" class="block text-sm font-semibold text-gray-700 mb-2">
                            Enter 6-digit OTP
                        </label>
                        <input type="text" name="otp" id="otp" x-model="otp" maxlength="6" pattern="[0-9]{6}"
                            required autocomplete="one-time-code" placeholder="000000"
                            class="w-full px-4 py-4 text-center text-2xl font-mono tracking-[0.5em] border border-gray-300 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-200 bg-gray-50 focus:bg-white @error('otp') border-red-500 ring-1 ring-red-500 @enderror">
                        @error('otp')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                        clip-rule="evenodd" />
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Timer and Resend -->
                    <div class="mb-6 text-center" x-data="{
                        timeLeft: 60,
                        canResend: false,
                        startTimer() {
                            const interval = setInterval(() => {
                                this.timeLeft--;
                                if (this.timeLeft <= 0) {
                                    clearInterval(interval);
                                    this.canResend = true;
                                }
                            }, 1000);
                        }
                    }" x-init="startTimer()">
                        <p class="text-sm text-gray-600" x-show="!canResend">
                            Resend OTP in <span class="font-semibold text-red-600" x-text="timeLeft"></span> seconds
                        </p>
                        <form action="{{ route('profile.delete.resend.otp') }}" method="POST" class="inline"
                            x-show="canResend">
                            @csrf
                            <button type="submit"
                                class="text-sm font-semibold text-red-600 hover:text-red-700 underline underline-offset-2 transition-colors duration-200">
                                Resend OTP
                            </button>
                        </form>
                    </div>

                    <!-- Action Buttons -->
                    <div class="space-y-3">
                        <button type="submit" :disabled="otp.length !== 6"
                            :class="otp.length === 6 ? 'bg-red-600 hover:bg-red-700 cursor-pointer' :
                                'bg-gray-400 cursor-not-allowed'"
                            class="w-full py-4 text-white font-bold rounded-xl transition-all duration-200 focus:outline-none focus:ring-4 focus:ring-red-300 shadow-lg transform hover:scale-[1.02]">
                            <span class="flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                    </path>
                                </svg>
                                Verify & Delete Account
                            </span>
                        </button>

                        <a href="{{ route('profile') }}"
                            class="block w-full py-4 text-center text-gray-700 font-semibold bg-gray-100 rounded-xl hover:bg-gray-200 transition-all duration-200 focus:outline-none focus:ring-4 focus:ring-gray-300">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>

            <!-- Help Text -->
            <div class="mt-6 text-center">
                <p class="text-sm text-gray-500">
                    Didn't receive the code? Check your spam folder or
                    <a href="{{ route('profile') }}" class="text-red-600 hover:text-red-700 font-semibold">
                        go back
                    </a>
                </p>
            </div>
        </div>
    </div>
@endsection
