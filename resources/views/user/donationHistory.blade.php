@extends('layouts.auth-app')
@section('title', 'My Donation History - JeevanPravaah')

@section('content')
    {{-- Main Page Container --}}
    <div class="min-h-screen bg-gradient-to-br from-red-50 via-white to-pink-50 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-5">

            <div class="mb-10">
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between">
                    <div>
                        <h1 class="text-4xl font-bold text-gray-900 mb-2">My Donation History</h1>
                        <p class="text-lg text-gray-600">Track all your blood donation registrations and their status</p>
                    </div>
                    <a href="{{ route('donate') }}"
                        class="mt-4 sm:mt-0 inline-flex items-center px-5 py-2.5 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-0.5">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Register New Donation
                    </a>
                </div>
            </div>

            @php
                // Fetch all donations where the email OR phone matches the authenticated user
                $donations = App\Models\Donor::where('email', Auth::user()->email)
                    ->orWhere('phone', Auth::user()->phone)
                    ->latest()
                    ->get();

                $totalDonations = $donations->count();
                $approvedDonations = $donations->where('approval_status', 'approved')->count();
                $pendingDonations = $donations->where('approval_status', 'pending')->count();
                $rejectedDonations = $donations->where('approval_status', 'rejected')->count();
            @endphp

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
                <div
                    class="bg-white rounded-2xl shadow-md p-6 transition-all duration-300 hover:shadow-lg hover:-translate-y-1 border-t-4 border-red-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm font-medium mb-1">Total Registrations</p>
                            <p class="text-4xl font-bold text-gray-900">{{ $totalDonations }}</p>
                        </div>
                        <div class="bg-red-100 p-3 rounded-full">
                            <svg class="w-8 h-8 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div
                    class="bg-white rounded-2xl shadow-md p-6 transition-all duration-300 hover:shadow-lg hover:-translate-y-1 border-t-4 border-green-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm font-medium mb-1">Approved</p>
                            <p class="text-4xl font-bold text-green-600">{{ $approvedDonations }}</p>
                        </div>
                        <div class="bg-green-100 p-3 rounded-full">
                            <svg class="w-8 h-8 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div
                    class="bg-white rounded-2xl shadow-md p-6 transition-all duration-300 hover:shadow-lg hover:-translate-y-1 border-t-4 border-yellow-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm font-medium mb-1">Pending Review</p>
                            <p class="text-4xl font-bold text-yellow-600">{{ $pendingDonations }}</p>
                        </div>
                        <div class="bg-yellow-100 p-3 rounded-full">
                            <svg class="w-8 h-8 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div
                    class="bg-white rounded-2xl shadow-md p-6 transition-all duration-300 hover:shadow-lg hover:-translate-y-1 border-t-4 border-gray-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm font-medium mb-1">Rejected</p>
                            <p class="text-4xl font-bold text-gray-600">{{ $rejectedDonations }}</p>
                        </div>
                        <div class="bg-gray-100 p-3 rounded-full">
                            <svg class="w-8 h-8 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            @if ($totalDonations > 0)
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">
                    <!-- Table Header -->
                    <div class="px-6 py-5 border-b border-gray-200 bg-gradient-to-r from-red-500 to-pink-500">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-white mr-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                                    <path fill-rule="evenodd"
                                        d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z"
                                        clip-rule="evenodd" />
                                </svg>
                                <h2 class="text-xl font-bold text-white">Complete Donation History</h2>
                            </div>
                            <span
                                class="text-white text-sm font-medium bg-white/20 px-3 py-1 rounded-full">{{ $totalDonations }}
                                {{ $totalDonations === 1 ? 'Record' : 'Records' }}</span>
                        </div>
                    </div>

                    <!-- Table Content -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                                <tr>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                        #</th>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                        Registration Date</th>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                        Blood Group</th>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                        Location</th>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                        Status</th>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                        Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-100">
                                @foreach ($donations as $index => $donation)
                                    <tr
                                        class="hover:bg-gradient-to-r hover:from-red-50 hover:to-pink-50 transition-all duration-200 group">
                                        <td class="px-6 py-5 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <span
                                                    class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-red-100 text-red-700 text-sm font-bold group-hover:bg-red-600 group-hover:text-white transition-colors">
                                                    {{ $totalDonations - $index }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-5 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div
                                                    class="flex-shrink-0 w-10 h-10 flex items-center justify-center rounded-lg bg-gradient-to-br from-red-400 to-pink-500 text-white">
                                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                        <path
                                                            d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" />
                                                    </svg>
                                                </div>
                                                <div class="ml-3">
                                                    <div class="text-sm font-bold text-gray-900">
                                                        {{ $donation->created_at->format('M d, Y') }}</div>
                                                    <div class="text-xs text-gray-500">
                                                        {{ $donation->created_at->format('h:i A') }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-5 whitespace-nowrap">
                                            <span <div class="relative inline-block">
                                                <span
                                                    class="inline-flex items-center px-4 py-2 rounded-xl text-base font-bold bg-gradient-to-r from-red-500 to-pink-500 text-white shadow-md hover:shadow-lg transition-shadow">
                                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    {{ $donation->blood_group }}
                                                </span>
                    </div>
                    </td>
                    <td class="px-6 py-5">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 text-gray-400 mr-2" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <div>
                                <div class="text-sm font-semibold text-gray-900">{{ $donation->city }}</div>
                                <div class="text-xs text-gray-500">{{ $donation->state }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-5 whitespace-nowrap">
                        @if ($donation->approval_status === 'approved')
                            <span
                                class="inline-flex items-center px-4 py-2 rounded-xl text-sm font-bold bg-gradient-to-r from-green-400 to-green-600 text-white shadow-md">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                                Approved
                            </span>
                        @elseif($donation->approval_status === 'rejected')
                            <span
                                class="inline-flex items-center px-4 py-2 rounded-xl text-sm font-bold bg-gradient-to-r from-red-400 to-red-600 text-white shadow-md">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                        clip-rule="evenodd" />
                                </svg>
                                Rejected
                            </span>
                        @else
                            <span
                                class="inline-flex items-center px-4 py-2 rounded-xl text-sm font-bold bg-gradient-to-r from-yellow-400 to-yellow-600 text-white shadow-md">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                        clip-rule="evenodd" />
                                </svg>
                                Pending Review
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-5 whitespace-nowrap">
                        <button onclick="showDonationDetails({{ $donation->id }})"
                            class="cursor-pointer inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-red-500 to-pink-500 hover:from-red-600 hover:to-pink-600 text-white text-sm font-bold rounded-lg transition-all duration-300 shadow-md hover:shadow-xl transform hover:-translate-y-1 hover:scale-105">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            View Details
                        </button>
                    </td>
                    </tr>
            @endforeach
            </tbody>
            </table>
        </div>
    </div>
@else
    <!-- Empty State -->
    <div class="bg-white rounded-2xl shadow-lg p-16 text-center border border-gray-100">
        <div class="max-w-md mx-auto">
            <div
                class="w-24 h-24 bg-gradient-to-br from-red-100 to-pink-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-12 h-12 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 mb-3">No Donation History</h3>
            <p class="text-gray-600 mb-8">You haven't registered for any blood donations yet. Start your journey to save
                lives today!</p>
            <a href="{{ route('donate') }}"
                class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-red-500 to-pink-500 hover:from-red-600 hover:to-pink-600 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Register Your First Donation
            </a>
        </div>
    </div>
    @endif
    </div>
    </div>

    <div id="donationModal"
        class="hidden fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm h-full w-full z-50 p-4 flex items-center justify-center overflow-y-auto">

        <div class="relative w-full max-w-4xl my-8 shadow-2xl rounded-3xl bg-white flex flex-col max-h-[90vh]">

            <div
                class="flex items-center justify-between p-6 border-b border-gray-100 bg-gradient-to-r from-red-600 via-red-500 to-pink-500 rounded-t-3xl sticky top-0 z-10">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-full bg-white bg-opacity-20 flex items-center justify-center">
                        <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-black text-white">Donation Details</h3>
                </div>
                <button onclick="closeDonationModal()"
                    class="text-white hover:bg-red-700 hover:bg-opacity-20 transition-all duration-200 p-2 rounded-full cursor-pointer">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div id="donationModalContent" class="p-8 space-y-6 overflow-y-auto">
                <div class="text-center py-12">
                    <div class="inline-block">
                        <div class="animate-spin">
                            <svg class="w-10 h-10 text-red-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                        </div>
                    </div>
                    <p class="text-gray-500 mt-4">Loading details...</p>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            const donations = @json($donations->values()->all());
            const modal = document.getElementById('donationModal');
            const modalContent = document.getElementById('donationModalContent');

            function showDonationDetails(donationId) {
                const donation = donations.find(d => d.id === donationId);
                if (!donation) return;

                // Build status badge
                let statusBadge = '';
                let statusIcon = '';
                if (donation.approval_status === 'approved') {
                    statusIcon =
                        '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>';
                    statusBadge =
                        '<span class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-semibold bg-green-100 text-green-800">' +
                        statusIcon + '<span class="ml-2">Approved</span></span>';
                } else if (donation.approval_status === 'rejected') {
                    statusIcon =
                        '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" /></svg>';
                    statusBadge =
                        '<span class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-semibold bg-red-100 text-red-800">' +
                        statusIcon + '<span class="ml-2">Rejected</span></span>';
                } else {
                    statusIcon =
                        '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" /></svg>';
                    statusBadge =
                        '<span class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-semibold bg-yellow-100 text-yellow-800">' +
                        statusIcon + '<span class="ml-2">Pending Review</span></span>';
                }

                // Format dates
                const registeredDate = new Date(donation.created_at).toLocaleDateString('en-US', {
                    year: 'numeric',
                    month: 'short',
                    day: 'numeric'
                });
                const dob = new Date(donation.date_of_birth).toLocaleDateString('en-US', {
                    year: 'numeric',
                    month: 'short',
                    day: 'numeric'
                });

                // Build availability HTML
                let availabilityHtml = '<span class="text-sm text-gray-500">Not specified</span>';
                if (donation.availability && Array.isArray(donation.availability) && donation.availability.length > 0) {
                    availabilityHtml = donation.availability.map(day =>
                        '<span class="inline-block px-3 py-1 bg-red-100 text-red-700 text-sm font-medium rounded-md">' +
                        day + '</span>'
                    ).join(' ');
                }

                const content = `
                <div class="space-y-5">
                    <!-- Status Section -->
                    <div class="flex items-center justify-between pb-4 border-b">
                        <span class="text-sm font-medium text-gray-600">Status</span>
                        ${statusBadge}
                    </div>
                    ${donation.rejection_reason ? '<div class="p-3 bg-red-50 border border-red-200 rounded-lg"><p class="text-xs font-semibold text-red-800 mb-1">Rejection Reason:</p><p class="text-sm text-red-700">' + donation.rejection_reason + '</p></div>' : ''}

                    <!-- Personal Information -->
                    <div>
                        <h4 class="text-sm font-bold text-gray-700 uppercase mb-3">Personal Information</h4>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <dt class="text-xs text-gray-500 mb-1">Full Name</dt>
                                <dd class="text-sm font-semibold text-gray-900">${donation.first_name} ${donation.last_name}</dd>
                            </div>
                            <div>
                                <dt class="text-xs text-gray-500 mb-1">Blood Group</dt>
                                <dd class="text-sm font-bold text-red-600">${donation.blood_group}</dd>
                            </div>
                            <div>
                                <dt class="text-xs text-gray-500 mb-1">Email</dt>
                                <dd class="text-sm font-semibold text-gray-900 break-all">${donation.email}</dd>
                            </div>
                            <div>
                                <dt class="text-xs text-gray-500 mb-1">Phone</dt>
                                <dd class="text-sm font-semibold text-gray-900">${donation.phone}</dd>
                            </div>
                            <div>
                                <dt class="text-xs text-gray-500 mb-1">Date of Birth</dt>
                                <dd class="text-sm font-semibold text-gray-900">${dob}</dd>
                            </div>
                            <div>
                                <dt class="text-xs text-gray-500 mb-1">Gender</dt>
                                <dd class="text-sm font-semibold text-gray-900 capitalize">${donation.gender}</dd>
                            </div>
                        </div>
                    </div>

                    <!-- Medical Information -->
                    <div class="pt-4 border-t">
                        <h4 class="text-sm font-bold text-gray-700 uppercase mb-3">Medical Information</h4>
                        <div class="grid grid-cols-3 gap-4">
                            <div>
                                <dt class="text-xs text-gray-500 mb-1">Weight</dt>
                                <dd class="text-sm font-semibold text-gray-900">${donation.weight} kg</dd>
                            </div>
                            <div>
                                <dt class="text-xs text-gray-500 mb-1">Height</dt>
                                <dd class="text-sm font-semibold text-gray-900">${donation.height} cm</dd>
                            </div>
                            <div>
                                <dt class="text-xs text-gray-500 mb-1">Travel Distance</dt>
                                <dd class="text-sm font-semibold text-gray-900">${donation.travel_distance} km</dd>
                            </div>
                        </div>
                        ${donation.medical_conditions ? '<div class="mt-3 p-3 bg-yellow-50 border border-yellow-200 rounded-lg"><p class="text-xs font-semibold text-yellow-800 mb-1">Medical Conditions:</p><p class="text-sm text-yellow-700">' + donation.medical_conditions + '</p></div>' : ''}
                    </div>

                    <!-- Address Information -->
                    <div class="pt-4 border-t">
                        <h4 class="text-sm font-bold text-gray-700 uppercase mb-3">Address</h4>
                        <div class="space-y-2">
                            <div>
                                <dd class="text-sm text-gray-900">${donation.address}</dd>
                            </div>
                            <div class="flex gap-2 text-sm text-gray-600">
                                <span>${donation.city}</span>
                                <span>•</span>
                                <span>${donation.state}</span>
                                <span>•</span>
                                <span>${donation.pincode}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Availability -->
                    <div class="pt-4 border-t">
                        <h4 class="text-sm font-bold text-gray-700 uppercase mb-3">Available Days</h4>
                        <div class="flex flex-wrap gap-2">
                            ${availabilityHtml}
                        </div>
                    </div>

                    <!-- Registration Date -->
                    <div class="pt-4 border-t">
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-600">Registered on</span>
                            <span class="font-semibold text-gray-900">${registeredDate}</span>
                        </div>
                    </div>
                </div>
                `;

                modalContent.innerHTML = content;
                modal.classList.remove('hidden');
                modal.scrollTop = 0;
            }

            function closeDonationModal() {
                modal.classList.add('hidden');
                // Reset content on close, good for performance
                modalContent.innerHTML = '<div class="text-center py-10"><p class="text-gray-500">Loading details...</p></div>';
            }

            modal.addEventListener('click', function(e) {
                // Check if the click is on the modal overlay (the dark background)
                if (e.target === this) {
                    closeDonationModal();
                }
            });
        </script>
    @endpush
@endsection
