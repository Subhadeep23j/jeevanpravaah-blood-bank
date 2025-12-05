@extends('layouts.app')

@section('title', 'My Profile - JeevanPravaah')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-red-50 via-gray-50 to-orange-50 pt-20 pb-12">
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div
                class="absolute top-1/4 -left-10 w-72 h-72 bg-red-100 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-blob">
            </div>
            <div
                class="absolute top-1/3 -right-10 w-72 h-72 bg-orange-100 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-blob animation-delay-2000">
            </div>
            <div
                class="absolute -bottom-8 left-1/3 w-72 h-72 bg-red-200 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-blob animation-delay-4000">
            </div>
        </div>

        <div class="relative z-10 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12" data-aos="fade-down">
                <h1 class="text-4xl md:text-5xl font-black text-gray-900 mb-4">
                    Account <span class="text-red-500">Settings</span>
                </h1>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Manage your profile, personal information, and security settings.
                </p>
            </div>

            @if (session('success'))
                <div class="mb-8 max-w-5xl mx-auto" data-aos="fade-up">
                    <div
                        class="bg-green-100 border-l-4 border-green-500 text-green-800 rounded-lg p-4 flex items-center shadow-sm">
                        <svg class="w-6 h-6 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="font-medium">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            <div class="max-w-5xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-8">

                <div class="lg:col-span-4" data-aos="fade-right">
                    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-6 text-center">
                        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data"
                            id="profileImageForm">
                            @csrf
                            @method('PUT')
                            <div class="relative inline-block group mb-4 cursor-pointer"
                                onclick="document.getElementById('profile_image_input').click();">
                                <img id="profile_image_preview"
                                    src="{{ asset('storage/' . Auth::user()->profile_image_path) }}"
                                    alt="{{ $user->name }}"
                                    class="w-32 h-32 rounded-full object-cover border-4 border-gray-200 shadow-md transition-transform duration-300 group-hover:scale-105 bg-gray-100"
                                    decoding="async"
                                    onerror="this.onerror=null; this.src='{{ asset('assets/profile.svg') }}';">
                                <div
                                    class="absolute inset-0  bg-opacity-0 group-hover:bg-opacity-40 rounded-full flex items-center justify-center transition-opacity duration-300">
                                    <svg class="w-8 h-8 text-white opacity-0 group-hover:opacity-100" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                            </div>
                            <input type="file" name="profile_image" id="profile_image_input" class="hidden"
                                accept="image/*">
                        </form>

                        <h2 class="text-2xl font-bold text-gray-800">{{ $user->name }}</h2>
                        <p class="text-gray-500 mb-6">{{ $user->email }}</p>
                        @error('profile_image')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror

                        <div class="space-y-3 text-left">
                            <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                <svg class="w-5 h-5 text-red-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span class="text-sm font-medium text-gray-700">Member Since:</span>
                                <span
                                    class="ml-auto text-sm text-red-600 font-semibold">{{ $user->created_at->format('M d, Y') }}</span>
                            </div>
                            <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                <svg class="w-5 h-5 text-orange-500 mr-3 flex-shrink-0" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span class="text-sm font-medium text-gray-700">Donations Made:</span>
                                <span
                                    class="ml-auto text-sm text-orange-600 font-semibold">{{ (int) ($user->donations_count ?? 0) }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-8" data-aos="fade-left" x-data="{ tab: 'profile' }">
                    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                        <div class="border-b border-gray-200">
                            <nav class="flex -mb-px">
                                <button @click="tab = 'profile'"
                                    :class="{ 'border-red-500 text-red-600': tab === 'profile', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': tab !== 'profile' }"
                                    class="w-1/3 py-4 px-1 text-center border-b-2 font-medium text-sm transition-colors duration-200 focus:outline-none">
                                    Edit Profile
                                </button>
                                <button @click="tab = 'security'"
                                    :class="{ 'border-red-500 text-red-600': tab === 'security', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': tab !== 'security' }"
                                    class="w-1/3 py-4 px-1 text-center border-b-2 font-medium text-sm transition-colors duration-200 focus:outline-none">
                                    Security
                                </button>
                                <button @click="tab = 'donations'"
                                    :class="{ 'border-red-500 text-red-600': tab === 'donations', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': tab !== 'donations' }"
                                    class="w-1/3 py-4 px-1 text-center border-b-2 font-medium text-sm transition-colors duration-200 focus:outline-none">
                                    Donation History
                                </button>
                            </nav>
                        </div>

                        <div class="p-6 sm:p-8">
                            <div x-show="tab === 'profile'" x-transition>
                                <form action="{{ route('profile.update') }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                        <div>
                                            <label for="name"
                                                class="block text-sm font-semibold text-gray-700 mb-2">Full Name *</label>
                                            <input type="text" name="name" id="name"
                                                value="{{ old('name', $user->name) }}"
                                                class="w-full px-4 py-3 border @error('name') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-200 bg-gray-50 focus:bg-white">
                                            @error('name')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div>
                                            <label for="email"
                                                class="block text-sm font-semibold text-gray-700 mb-2">Email Address
                                                *</label>
                                            <input type="email" name="email" id="email"
                                                value="{{ old('email', $user->email) }}"
                                                class="w-full px-4 py-3 border @error('email') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-200 bg-gray-50 focus:bg-white">
                                            @error('email')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div>
                                            <label for="phone"
                                                class="block text-sm font-semibold text-gray-700 mb-2">Phone Number</label>
                                            <input type="tel" name="phone" id="phone"
                                                value="{{ old('phone', $user->phone) }}"
                                                class="w-full px-4 py-3 border @error('phone') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-200 bg-gray-50 focus:bg-white">
                                            @error('phone')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div>
                                            <label for="aadhar"
                                                class="block text-sm font-semibold text-gray-700 mb-2">Aadhar
                                                Number</label>
                                            <input type="text" name="aadhar" id="aadhar"
                                                value="{{ old('aadhar', $user->aadhar) }}"
                                                class="w-full px-4 py-3 border @error('aadhar') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-200 bg-gray-50 focus:bg-white"
                                                maxlength="12">
                                            @error('aadhar')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div>
                                            <label for="city"
                                                class="block text-sm font-semibold text-gray-700 mb-2">City</label>
                                            <input type="text" name="city" id="city"
                                                value="{{ old('city', $user->city) }}"
                                                class="w-full px-4 py-3 border @error('city') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-200 bg-gray-50 focus:bg-white">
                                            @error('city')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div>
                                            <label for="pin"
                                                class="block text-sm font-semibold text-gray-700 mb-2">PIN Code</label>
                                            <input type="text" name="pin" id="pin"
                                                value="{{ old('pin', $user->pin) }}"
                                                class="w-full px-4 py-3 border @error('pin') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-200 bg-gray-50 focus:bg-white"
                                                maxlength="6">
                                            @error('pin')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-6">
                                        <label for="address"
                                            class="block text-sm font-semibold text-gray-700 mb-2">Address</label>
                                        <textarea name="address" id="address" rows="3"
                                            class="w-full px-4 py-3 border @error('address') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-200 bg-gray-50 focus:bg-white">{{ old('address', $user->address) }}</textarea>
                                        @error('address')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="flex justify-end">
                                        <button type="submit"
                                            class="px-8 py-3 bg-gradient-to-r from-red-500 to-red-600 text-white font-bold rounded-lg hover:from-red-600 hover:to-red-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105 focus:outline-none focus:ring-4 focus:ring-red-300">
                                            Save Changes
                                        </button>
                                    </div>
                                </form>
                            </div>

                            <div x-show="tab === 'security'" x-transition style="display: none;">
                                <form action="{{ route('profile.password.update') }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="space-y-6">
                                        <div>
                                            <label for="current_password"
                                                class="block text-sm font-semibold text-gray-700 mb-2">Current
                                                Password</label>
                                            <input type="password" name="current_password" id="current_password"
                                                class="w-full px-4 py-3 border @error('current_password', 'updatePassword') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200 bg-gray-50 focus:bg-white">
                                            @error('current_password', 'updatePassword')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div>
                                            <label for="password"
                                                class="block text-sm font-semibold text-gray-700 mb-2">New Password</label>
                                            <input type="password" name="password" id="password"
                                                class="w-full px-4 py-3 border @error('password', 'updatePassword') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200 bg-gray-50 focus:bg-white">
                                            @error('password', 'updatePassword')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div>
                                            <label for="password_confirmation"
                                                class="block text-sm font-semibold text-gray-700 mb-2">Confirm New
                                                Password</label>
                                            <input type="password" name="password_confirmation"
                                                id="password_confirmation"
                                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200 bg-gray-50 focus:bg-white">
                                        </div>
                                    </div>
                                    <div class="mt-8 flex justify-end">
                                        <button type="submit"
                                            class="px-8 py-3 bg-gradient-to-r from-orange-500 to-red-500 text-white font-bold rounded-lg hover:from-orange-600 hover:to-red-600 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105 focus:outline-none focus:ring-4 focus:ring-orange-300">
                                            Update Password
                                        </button>
                                    </div>
                                </form>
                            </div>

                            <div x-show="tab === 'donations'" x-transition style="display: none;">
                                @php
                                    $donations = App\Models\Donor::where('email', Auth::user()->email)
                                        ->orWhere('phone', Auth::user()->phone)
                                        ->latest()
                                        ->get();

                                    $totalDonations = $donations->count();
                                    $approvedDonations = $donations->where('approval_status', 'approved')->count();
                                    $pendingDonations = $donations->where('approval_status', 'pending')->count();
                                    $rejectedDonations = $donations->where('approval_status', 'rejected')->count();
                                @endphp

                                <!-- Statistics Cards -->
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                                    <div
                                        class="bg-gradient-to-br from-red-50 to-red-100 p-4 rounded-lg border border-red-200">
                                        <p class="text-xs text-red-600 font-medium mb-1">Total</p>
                                        <p class="text-2xl font-bold text-red-700">{{ $totalDonations }}</p>
                                    </div>
                                    <div
                                        class="bg-gradient-to-br from-green-50 to-green-100 p-4 rounded-lg border border-green-200">
                                        <p class="text-xs text-green-600 font-medium mb-1">Approved</p>
                                        <p class="text-2xl font-bold text-green-700">{{ $approvedDonations }}</p>
                                    </div>
                                    <div
                                        class="bg-gradient-to-br from-yellow-50 to-yellow-100 p-4 rounded-lg border border-yellow-200">
                                        <p class="text-xs text-yellow-600 font-medium mb-1">Pending</p>
                                        <p class="text-2xl font-bold text-yellow-700">{{ $pendingDonations }}</p>
                                    </div>
                                    <div
                                        class="bg-gradient-to-br from-gray-50 to-gray-100 p-4 rounded-lg border border-gray-200">
                                        <p class="text-xs text-gray-600 font-medium mb-1">Rejected</p>
                                        <p class="text-2xl font-bold text-gray-700">{{ $rejectedDonations }}</p>
                                    </div>
                                </div>

                                @if ($totalDonations > 0)
                                    <div class="space-y-4 max-h-[600px] overflow-y-auto pr-2">
                                        @foreach ($donations as $donation)
                                            <div
                                                class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow duration-200">
                                                <div class="flex items-start justify-between mb-3">
                                                    <div class="flex items-center gap-3">
                                                        <div
                                                            class="w-12 h-12 bg-gradient-to-br from-red-500 to-red-600 rounded-full flex items-center justify-center text-white font-bold text-lg">
                                                            {{ $donation->blood_group }}
                                                        </div>
                                                        <div>
                                                            <h4 class="font-bold text-gray-900">
                                                                {{ $donation->first_name }} {{ $donation->last_name }}
                                                            </h4>
                                                            <p class="text-xs text-gray-500">
                                                                {{ $donation->created_at->format('M d, Y - h:i A') }}</p>
                                                        </div>
                                                    </div>
                                                    @if ($donation->approval_status === 'approved')
                                                        <span
                                                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-800">
                                                            <svg class="w-3 h-3 mr-1" fill="currentColor"
                                                                viewBox="0 0 20 20">
                                                                <path fill-rule="evenodd"
                                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                                    clip-rule="evenodd" />
                                                            </svg>
                                                            Approved
                                                        </span>
                                                    @elseif($donation->approval_status === 'rejected')
                                                        <span
                                                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-red-100 text-red-800">
                                                            <svg class="w-3 h-3 mr-1" fill="currentColor"
                                                                viewBox="0 0 20 20">
                                                                <path fill-rule="evenodd"
                                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                                                    clip-rule="evenodd" />
                                                            </svg>
                                                            Rejected
                                                        </span>
                                                    @else
                                                        <span
                                                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-yellow-100 text-yellow-800">
                                                            <svg class="w-3 h-3 mr-1" fill="currentColor"
                                                                viewBox="0 0 20 20">
                                                                <path fill-rule="evenodd"
                                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                                                    clip-rule="evenodd" />
                                                            </svg>
                                                            Pending
                                                        </span>
                                                    @endif
                                                </div>

                                                <div class="grid grid-cols-2 gap-3 text-sm">
                                                    <div class="flex items-center text-gray-600">
                                                        <svg class="w-4 h-4 mr-2 text-gray-400" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                                        </svg>
                                                        {{ $donation->phone }}
                                                    </div>
                                                    <div class="flex items-center text-gray-600">
                                                        <svg class="w-4 h-4 mr-2 text-gray-400" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        </svg>
                                                        {{ $donation->city }}, {{ $donation->state }}
                                                    </div>
                                                </div>

                                                @if ($donation->rejection_reason)
                                                    <div class="mt-3 p-3 bg-red-50 border border-red-200 rounded-lg">
                                                        <p class="text-xs font-semibold text-red-800 mb-1">Rejection
                                                            Reason:</p>
                                                        <p class="text-xs text-red-700">{{ $donation->rejection_reason }}
                                                        </p>
                                                    </div>
                                                @endif

                                                @if ($donation->approved_at)
                                                    <div class="mt-3 text-xs text-gray-500">
                                                        Status updated: {{ $donation->approved_at->format('M d, Y') }}
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>

                                    <div class="mt-6 pt-4 border-t border-gray-200">
                                        <a href="{{ route('donation.history') }}"
                                            class="block text-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg transition-colors">
                                            View Full Donation History
                                        </a>
                                    </div>
                                @else
                                    <div class="text-center py-12">
                                        <svg class="w-20 h-20 mx-auto text-gray-300 mb-4" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                        </svg>
                                        <h3 class="text-lg font-bold text-gray-900 mb-2">No Donation History</h3>
                                        <p class="text-gray-600 mb-4">You haven't registered for any blood donations yet.
                                        </p>
                                        <a href="{{ route('donate') }}"
                                            class="inline-flex items-center px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg transition-colors">
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 4v16m8-8H4" />
                                            </svg>
                                            Register Your First Donation
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        @keyframes blob {
            /* ... existing keyframes ... */
        }

        .animate-blob {
            animation: blob 7s infinite;
        }

        .animation-delay-2000 {
            animation-delay: 2s;
        }

        .animation-delay-4000 {
            animation-delay: 4s;
        }

        .pulse-glow {
            animation: pulse-glow 2s infinite;
        }

        @keyframes pulse-glow {
            /* ... existing keyframes ... */
        }
    </style>

    {{-- Add AlpineJS from a CDN for tab functionality --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- Script for profile image preview and auto-submit --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const imageInput = document.getElementById('profile_image_input');
            const imagePreview = document.getElementById('profile_image_preview');
            const imageForm = document.getElementById('profileImageForm');

            imageInput.addEventListener('change', function(event) {
                const file = event.target.files[0];
                if (file) {
                    // Create a preview
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        imagePreview.src = e.target.result;
                    }
                    reader.readAsDataURL(file);

                    // Automatically submit the form to update the image
                    // This provides instant feedback after selection.
                    // You can replace this with a separate "Upload" button if you prefer.
                    imageForm.submit();
                }
            });
        });
    </script>
@endsection
