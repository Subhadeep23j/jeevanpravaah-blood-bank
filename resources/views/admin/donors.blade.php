@extends('admin.dashboard-layout')
@section('title', 'Donors Management - JeevanPravaah')
@section('page_title', 'All Donors')

@section('content')
    <div class="space-y-6 max-w-full overflow-hidden">
        <!-- Statistics Overview -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl shadow-lg p-4 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-blue-100 text-xs font-medium">Total Donors</p>
                        <h3 class="text-2xl font-black">{{ number_format($stats['total_donors']) }}</h3>
                    </div>
                    <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center"><i
                            class="fa-solid fa-droplet text-xl"></i></div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-red-500 to-red-600 rounded-xl shadow-lg p-4 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-red-100 text-xs font-medium">Today's Donors</p>
                        <h3 class="text-2xl font-black">{{ number_format($stats['today_donors']) }}</h3>
                    </div>
                    <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center"><i
                            class="fa-solid fa-heart-pulse text-xl"></i></div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl shadow-lg p-4 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-green-100 text-xs font-medium">This Month</p>
                        <h3 class="text-2xl font-black">{{ number_format($stats['this_month_donors']) }}</h3>
                    </div>
                    <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center"><i
                            class="fa-solid fa-calendar-days text-xl"></i></div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl shadow-lg p-4 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-purple-100 text-xs font-medium">Unique Users</p>
                        <h3 class="text-2xl font-black">{{ number_format($stats['unique_users']) }}</h3>
                    </div>
                    <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center"><i
                            class="fa-solid fa-users text-xl"></i></div>
                </div>
            </div>
        </div>

        <!-- Filters and Search -->
        <div class="bg-white rounded-xl shadow-md border border-gray-100 p-3">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 w-full sm:w-auto">
                    <div class="relative flex items-center">
                        <span class="absolute left-3 text-gray-400"><i class="fa-solid fa-search"></i></span>
                        <input type="text" id="searchDonor" placeholder="Search donors..."
                            class="w-full sm:w-64 pl-10 pr-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                    </div>
                    <select id="bloodGroupFilter"
                        class="px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 cursor-pointer">
                        <option value="">All Blood</option>
                        <option value="A+">A+</option>
                        <option value="A-">A-</option>
                        <option value="B+">B+</option>
                        <option value="B-">B-</option>
                        <option value="AB+">AB+</option>
                        <option value="AB-">AB-</option>
                        <option value="O+">O+</option>
                        <option value="O-">O-</option>
                    </select>
                    <select id="genderFilter"
                        class="px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 cursor-pointer">
                        <option value="">All Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <!-- Bulk Actions -->
                <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2" id="bulkActions"
                    style="display: none;">
                    <span class="text-sm text-gray-600"><span id="selectedCount">0</span> selected</span>
                    <button onclick="bulkApprove()"
                        class="px-3 py-1.5 bg-green-500 hover:bg-green-600 text-white text-sm font-medium rounded-lg flex items-center justify-center gap-1">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                        Approve All
                    </button>
                    <button onclick="bulkReject()"
                        class="px-3 py-1.5 bg-red-500 hover:bg-red-600 text-white text-sm font-medium rounded-lg flex items-center justify-center gap-1">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                        Reject All
                    </button>
                    <button onclick="bulkReset()"
                        class="px-3 py-1.5 bg-gray-500 hover:bg-gray-600 text-white text-sm font-medium rounded-lg flex items-center justify-center gap-1">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z"
                                clip-rule="evenodd" />
                        </svg>
                        Reset All
                    </button>
                </div>
            </div>
        </div>

        <!-- Donors Table -->
        <div class="bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden">
            <div
                class="px-4 py-2 border-b border-gray-200 bg-gradient-to-r from-red-50 to-orange-50 flex items-center justify-between">
                <h2 class="text-base font-bold text-gray-900">All Donors</h2>
                <span class="text-xs text-gray-500">Total: {{ $donors->count() }} donors</span>
            </div>

            @if ($donors->count() > 0)
                <!-- Desktop Table View -->
                <div class="hidden md:block overflow-x-auto">
                    <table class="w-full text-sm" id="donorsTable">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="px-2 py-2 text-left">
                                    <input type="checkbox" id="selectAll"
                                        class="w-4 h-4 text-red-500 rounded border-gray-300 focus:ring-red-500 cursor-pointer">
                                </th>
                                <th class="px-2 py-2 text-left text-xs font-semibold text-gray-600">#</th>
                                <th class="px-2 py-2 text-left text-xs font-semibold text-gray-600">Name</th>
                                <th class="px-2 py-2 text-left text-xs font-semibold text-gray-600">Contact</th>
                                <th class="px-2 py-2 text-left text-xs font-semibold text-gray-600">Blood</th>
                                <th class="px-2 py-2 text-left text-xs font-semibold text-gray-600">Gender</th>
                                <th class="px-2 py-2 text-left text-xs font-semibold text-gray-600">Age</th>
                                <th class="px-2 py-2 text-left text-xs font-semibold text-gray-600">Location</th>
                                <th class="px-2 py-2 text-left text-xs font-semibold text-gray-600">Date</th>
                                <th class="px-2 py-2 text-left text-xs font-semibold text-gray-600">Status</th>
                                <th class="px-2 py-2 text-left text-xs font-semibold text-gray-600">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach ($donors as $index => $donor)
                                <tr class="hover:bg-gray-50 donor-row" data-id="{{ $donor->id }}"
                                    data-name="{{ strtolower($donor->first_name . ' ' . $donor->last_name) }}"
                                    data-email="{{ strtolower($donor->email) }}" data-blood="{{ $donor->blood_group }}"
                                    data-gender="{{ $donor->gender }}" data-status="{{ $donor->approval_status }}">
                                    <td class="px-2 py-1.5">
                                        <input type="checkbox"
                                            class="donor-checkbox w-4 h-4 text-red-500 rounded border-gray-300 focus:ring-red-500 cursor-pointer"
                                            value="{{ $donor->id }}">
                                    </td>
                                    <td class="px-2 py-1.5">
                                        <span class="font-medium text-gray-700">{{ $index + 1 }}</span>
                                    </td>
                                    <td class="px-2 py-1.5">
                                        <div class="flex items-center gap-2">
                                            <div
                                                class="w-7 h-7 bg-red-500 rounded-full flex items-center justify-center text-white text-xs font-bold shrink-0">
                                                {{ strtoupper(substr($donor->first_name, 0, 1)) }}
                                            </div>
                                            <div class="min-w-0">
                                                <div class="font-medium text-gray-900 truncate">{{ $donor->first_name }}
                                                    {{ $donor->last_name }}</div>
                                                <div class="text-xs text-gray-400">
                                                    #{{ str_pad($donor->id, 4, '0', STR_PAD_LEFT) }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-2 py-1.5">
                                        <div class="text-gray-900 truncate">{{ $donor->phone }}</div>
                                        <div class="text-xs text-gray-400 truncate">{{ $donor->email }}</div>
                                    </td>
                                    <td class="px-2 py-1.5">
                                        <span
                                            class="px-2 py-0.5 rounded-full text-xs font-bold bg-red-100 text-red-700">{{ $donor->blood_group }}</span>
                                    </td>
                                    <td class="px-2 py-1.5 text-gray-700">{{ strtolower($donor->gender) }}</td>
                                    <td class="px-2 py-1.5 text-gray-700">
                                        {{ \Carbon\Carbon::parse($donor->date_of_birth)->age }}</td>
                                    <td class="px-2 py-1.5">
                                        <div class="text-gray-900 truncate">{{ $donor->city }}</div>
                                        <div class="text-xs text-gray-400 truncate">{{ $donor->state }}</div>
                                    </td>
                                    <td class="px-2 py-1.5">
                                        <div class="text-gray-700">{{ $donor->created_at->format('M d, Y') }}</div>
                                        <div class="text-xs text-gray-400">{{ $donor->created_at->diffForHumans() }}</div>
                                    </td>
                                    <td class="px-2 py-1.5">
                                        @if ($donor->approval_status === 'approved')
                                            <span
                                                class="px-2 py-0.5 rounded-full text-xs font-semibold bg-green-100 text-green-700">✓
                                                Approved</span>
                                        @elseif($donor->approval_status === 'rejected')
                                            <span
                                                class="px-2 py-0.5 rounded-full text-xs font-semibold bg-red-100 text-red-700">✗
                                                Rejected</span>
                                        @else
                                            <span
                                                class="px-2 py-0.5 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-700">⏳
                                                Pending</span>
                                        @endif
                                    </td>
                                    <td class="px-2 py-1.5">
                                        <div class="flex items-center gap-1">
                                            <button onclick="showDonorDetails({{ $donor->id }})"
                                                class="p-1 bg-blue-100 hover:bg-blue-200 text-blue-600 rounded cursor-pointer"
                                                title="View">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </button>
                                            @if ($donor->approval_status !== 'approved')
                                                <form action="{{ route('admin.donors.approve', $donor->id) }}"
                                                    method="POST" class="inline" data-confirm="Approve this donor?">
                                                    @csrf
                                                    <button type="submit"
                                                        class="p-1 bg-green-100 hover:bg-green-200 text-green-600 rounded cursor-pointer"
                                                        title="Approve">
                                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd"
                                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            @endif
                                            @if ($donor->approval_status !== 'rejected')
                                                <button onclick="showRejectModal({{ $donor->id }})"
                                                    class="p-1 bg-red-100 hover:bg-red-200 text-red-600 rounded cursor-pointer"
                                                    title="Reject">
                                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </button>
                                            @endif
                                            @if ($donor->approval_status !== 'pending')
                                                <form action="{{ route('admin.donors.reset', $donor->id) }}"
                                                    method="POST" class="inline" data-confirm="Reset to pending?">
                                                    @csrf
                                                    <button type="submit"
                                                        class="p-1 bg-gray-100 hover:bg-gray-200 text-gray-600 rounded cursor-pointer"
                                                        title="Reset">
                                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd"
                                                                d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    @if ($donors->hasPages())
                        <div class="px-4 py-3 border-t border-gray-200">
                            {{ $donors->links() }}
                        </div>
                    @endif
                @else
                    <div class="px-4 py-10 text-center">
                        <div class="text-4xl mb-2">📋</div>
                        <h3 class="text-lg font-bold text-gray-900">No Donors Yet</h3>
                        <p class="text-sm text-gray-500">There are no donor records in the system.</p>
                    </div>
            @endif
        </div>

        <!-- Mobile Card View (visible only on mobile) -->
        <div class="md:hidden">
            @if ($donors->count() > 0)
                <div class="divide-y divide-gray-200 bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden">
                    @foreach ($donors as $donor)
                        <div class="mobile-donor-card p-4 hover:bg-gray-50 transition-colors"
                            data-name="{{ strtolower($donor->first_name . ' ' . $donor->last_name) }}"
                            data-email="{{ strtolower($donor->email) }}" data-blood="{{ $donor->blood_group }}"
                            data-gender="{{ strtolower($donor->gender) }}">
                            <!-- Donor Info -->
                            <div class="mb-3">
                                <div class="flex items-start justify-between mb-2">
                                    <div>
                                        <h3 class="font-bold text-gray-900 text-sm">{{ $donor->first_name }}
                                            {{ $donor->last_name }}</h3>
                                        <p class="text-xs text-gray-500">{{ $donor->email }}</p>
                                    </div>
                                    <span
                                        class="inline-block px-2 py-1 text-xs font-bold rounded-full
                                            @if ($donor->approval_status === 'approved') bg-green-100 text-green-800
                                            @elseif ($donor->approval_status === 'rejected')
                                                bg-red-100 text-red-800
                                            @else
                                                bg-yellow-100 text-yellow-800 @endif">
                                        {{ ucfirst($donor->approval_status) }}
                                    </span>
                                </div>
                            </div>

                            <!-- Donor Details Grid -->
                            <div class="grid grid-cols-2 gap-2 mb-3 text-xs">
                                <div class="bg-gray-50 p-2 rounded">
                                    <span class="text-gray-500 text-xs">Blood</span>
                                    <p class="font-bold text-red-600">{{ $donor->blood_group ?? 'N/A' }}</p>
                                </div>
                                <div class="bg-gray-50 p-2 rounded">
                                    <span class="text-gray-500 text-xs">Age</span>
                                    <p class="font-bold text-gray-900">
                                        {{ \Carbon\Carbon::parse($donor->date_of_birth)->age ?? 'N/A' }}</p>
                                </div>
                                <div class="bg-gray-50 p-2 rounded">
                                    <span class="text-gray-500 text-xs">Gender</span>
                                    <p class="font-bold text-gray-900">{{ ucfirst($donor->gender ?? 'N/A') }}</p>
                                </div>
                                <div class="bg-gray-50 p-2 rounded">
                                    <span class="text-gray-500 text-xs">Phone</span>
                                    <p class="font-bold text-gray-900 truncate">{{ substr($donor->phone ?? 'N/A', -4) }}
                                    </p>
                                </div>
                            </div>

                            <!-- Contact & Location -->
                            <div class="mb-3 text-xs">
                                <p class="text-gray-600 mb-1">
                                    <i class="fa-solid fa-map-pin text-blue-500 mr-1.5"></i>
                                    {{ $donor->city ?? 'Not specified' }}
                                </p>
                                <p class="text-gray-600">
                                    <i class="fa-solid fa-phone text-gray-500 mr-1.5"></i>
                                    {{ $donor->phone ?? 'No phone' }}
                                </p>
                            </div>

                            <!-- Date -->
                            <div class="mb-3 text-xs text-gray-500 border-t pt-2">
                                Applied: {{ $donor->created_at ? $donor->created_at->format('M d, Y') : 'N/A' }}
                            </div>

                            <!-- Mobile Actions (Stacked Buttons) -->
                            <div class="space-y-2">
                                <button onclick="showDonorDetails({{ $donor->id }})"
                                    class="w-full px-2 py-1.5 text-xs font-medium text-blue-600 bg-blue-50 hover:bg-blue-100 rounded transition-colors">
                                    View Details
                                </button>

                                @if ($donor->approval_status === 'pending')
                                    <div class="flex gap-2">
                                        <form action="{{ route('admin.donors.approve', $donor->id) }}" method="POST"
                                            class="flex-1" onsubmit="return confirm('Approve this donor?');">
                                            @csrf
                                            <button type="submit"
                                                class="w-full px-2 py-1.5 text-xs font-medium text-white bg-green-600 hover:bg-green-700 rounded transition-colors">
                                                Approve
                                            </button>
                                        </form>
                                        <button onclick="showRejectModal({{ $donor->id }})"
                                            class="flex-1 px-2 py-1.5 text-xs font-medium text-white bg-red-600 hover:bg-red-700 rounded transition-colors">
                                            Reject
                                        </button>
                                    </div>
                                @elseif ($donor->approval_status === 'approved')
                                    <form action="{{ route('admin.donors.reset', $donor->id) }}" method="POST"
                                        onsubmit="return confirm('Reset status to pending?');">
                                        @csrf
                                        <button type="submit"
                                            class="w-full px-2 py-1.5 text-xs font-medium text-white bg-gray-500 hover:bg-gray-600 rounded transition-colors">
                                            Reset
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                @if ($donors->hasPages())
                    <div class="px-4 py-3 bg-gray-50 border-t border-gray-200">
                        {{ $donors->links() }}
                    </div>
                @endif
            @else
                <div class="px-4 py-10 text-center bg-white rounded-xl shadow-md border border-gray-100">
                    <div class="text-4xl mb-2">📋</div>
                    <h3 class="text-lg font-bold text-gray-900">No Donors Yet</h3>
                    <p class="text-sm text-gray-500">There are no donor records in the system.</p>
                </div>
            @endif
        </div>
    </div>
    </div>

    <!-- Reject Donor Modal -->
    <div id="rejectModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 z-50 items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full">
            <div
                class="bg-gradient-to-r from-red-500 to-red-600 px-6 py-4 flex items-center justify-between rounded-t-2xl">
                <h3 class="text-xl font-black text-white">Reject Donor</h3>
                <button onclick="closeRejectModal()"
                    class="text-white hover:text-gray-200 transition-colors cursor-pointer">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <form id="rejectForm" method="POST" class="p-6">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Reason for Rejection *</label>
                    <textarea name="rejection_reason" required rows="4"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                        placeholder="Please provide a reason for rejecting this donor..."></textarea>
                </div>
                <div class="flex gap-3">
                    <button type="button" onclick="closeRejectModal()"
                        class="flex-1 px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium rounded-lg transition-colors">
                        Cancel
                    </button>
                    <button type="submit"
                        class="flex-1 px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-bold rounded-lg transition-colors">
                        Reject Donor
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Donor Details Modal -->
    <div id="donorModal" class="hidden fixed inset-0 bg-black/60 backdrop-blur-sm z-50 items-center justify-center p-4">
        <div class="bg-gray-50 rounded-2xl shadow-2xl max-w-3xl w-full max-h-[85vh] overflow-hidden">
            <div class="bg-gradient-to-r from-red-600 to-red-500 px-5 py-3 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                        <span class="text-xl">🩸</span>
                    </div>
                    <h3 class="text-lg font-bold text-white">Donor Details</h3>
                </div>
                <button onclick="closeDonorModal()"
                    class="text-white/80 hover:text-white transition-colors cursor-pointer">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div id="donorModalContent" class="p-4 overflow-y-auto max-h-[calc(85vh-60px)]">
                <!-- Content will be loaded dynamically -->
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Search and Filter functionality
            const searchInput = document.getElementById('searchDonor');
            const bloodGroupFilter = document.getElementById('bloodGroupFilter');
            const genderFilter = document.getElementById('genderFilter');
            const donorRows = document.querySelectorAll('.donor-row');
            const mobileCards = document.querySelectorAll('.mobile-donor-card');
            const selectAllCheckbox = document.getElementById('selectAll');
            const donorCheckboxes = document.querySelectorAll('.donor-checkbox');
            const bulkActionsDiv = document.getElementById('bulkActions');
            const selectedCountSpan = document.getElementById('selectedCount');

            // Select All functionality - only for desktop view
            if (selectAllCheckbox) {
                selectAllCheckbox.addEventListener('change', function() {
                    donorCheckboxes.forEach(checkbox => {
                        const row = checkbox.closest('.donor-row');
                        if (row && row.style.display !== 'none') {
                            checkbox.checked = this.checked;
                        }
                    });
                    updateBulkActions();
                });
            }

            // Individual checkbox change
            donorCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', updateBulkActions);
            });

            function updateBulkActions() {
                const checkedBoxes = document.querySelectorAll('.donor-checkbox:checked');
                const count = checkedBoxes.length;
                selectedCountSpan.textContent = count;
                bulkActionsDiv.style.display = count > 0 ? 'flex' : 'none';

                // Update select all checkbox state
                const visibleCheckboxes = Array.from(donorCheckboxes).filter(cb => {
                    const row = cb.closest('.donor-row');
                    return row && row.style.display !== 'none';
                });
                const allVisibleChecked = visibleCheckboxes.length > 0 && visibleCheckboxes.every(cb => cb.checked);
                if (selectAllCheckbox) {
                    selectAllCheckbox.checked = allVisibleChecked;
                    selectAllCheckbox.indeterminate = count > 0 && !allVisibleChecked;
                }
            }

            function getSelectedIds() {
                return Array.from(document.querySelectorAll('.donor-checkbox:checked')).map(cb => cb.value);
            }

            async function bulkApprove() {
                const ids = getSelectedIds();
                if (ids.length === 0) return;

                const result = await Swal.fire({
                    title: 'Approve Selected Donors?',
                    text: `You are about to approve ${ids.length} donor(s).`,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#22c55e',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Yes, Approve All'
                });

                if (result.isConfirmed) {
                    await processBulkAction(ids, 'approve');
                }
            }

            async function bulkReject() {
                const ids = getSelectedIds();
                if (ids.length === 0) return;

                const {
                    value: reason
                } = await Swal.fire({
                    title: 'Reject Selected Donors?',
                    text: `You are about to reject ${ids.length} donor(s).`,
                    input: 'textarea',
                    inputLabel: 'Reason for rejection',
                    inputPlaceholder: 'Enter rejection reason...',
                    inputAttributes: {
                        required: true
                    },
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#ef4444',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Yes, Reject All',
                    inputValidator: (value) => {
                        if (!value) return 'Please provide a reason for rejection';
                    }
                });

                if (reason) {
                    await processBulkAction(ids, 'reject', reason);
                }
            }

            async function bulkReset() {
                const ids = getSelectedIds();
                if (ids.length === 0) return;

                const result = await Swal.fire({
                    title: 'Reset Selected Donors?',
                    text: `You are about to reset ${ids.length} donor(s) to pending status.`,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#6b7280',
                    cancelButtonColor: '#ef4444',
                    confirmButtonText: 'Yes, Reset All'
                });

                if (result.isConfirmed) {
                    await processBulkAction(ids, 'reset');
                }
            }

            async function processBulkAction(ids, action, reason = null) {
                Swal.fire({
                    title: 'Processing...',
                    text: 'Please wait while we process your request.',
                    allowOutsideClick: false,
                    didOpen: () => Swal.showLoading()
                });

                try {
                    const response = await fetch('/admin/donors/bulk-action', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            ids,
                            action,
                            reason
                        })
                    });

                    const data = await response.json();

                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: data.message,
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => location.reload());
                    } else {
                        Swal.fire('Error', data.message || 'Something went wrong', 'error');
                    }
                } catch (error) {
                    Swal.fire('Error', 'Failed to process request', 'error');
                }
            }

            function filterDonors() {
                const searchTerm = searchInput.value.toLowerCase();
                const selectedBlood = bloodGroupFilter.value;
                const selectedGender = genderFilter.value;

                // Filter desktop table rows
                donorRows.forEach(row => {
                    const name = row.dataset.name || '';
                    const email = row.dataset.email || '';
                    const blood = row.dataset.blood || '';
                    const gender = row.dataset.gender || '';

                    const matchesSearch = name.includes(searchTerm) || email.includes(searchTerm) || blood.toLowerCase()
                        .includes(searchTerm);
                    const matchesBlood = !selectedBlood || blood === selectedBlood;
                    const matchesGender = !selectedGender || gender === selectedGender;

                    if (matchesSearch && matchesBlood && matchesGender) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });

                // Filter mobile cards
                mobileCards.forEach(card => {
                    const name = card.dataset.name || '';
                    const email = card.dataset.email || '';
                    const blood = card.dataset.blood || '';
                    const gender = card.dataset.gender || '';

                    const matchesSearch = name.includes(searchTerm) || email.includes(searchTerm) || blood.toLowerCase()
                        .includes(searchTerm);
                    const matchesBlood = !selectedBlood || blood === selectedBlood;
                    const matchesGender = !selectedGender || gender === selectedGender;

                    if (matchesSearch && matchesBlood && matchesGender) {
                        card.style.display = '';
                    } else {
                        card.style.display = 'none';
                    }
                });

                updateBulkActions();
            }

            if (searchInput) searchInput.addEventListener('input', filterDonors);
            if (bloodGroupFilter) bloodGroupFilter.addEventListener('change', filterDonors);
            if (genderFilter) genderFilter.addEventListener('change', filterDonors);

            // Donor details modal
            const donorsData = @json(App\Models\Donor::with('user')->latest()->get());

            function showDonorDetails(donorId) {
                const donor = donorsData.find(d => d.id === donorId);
                if (!donor) return;

                const dob = new Date(donor.date_of_birth);
                const age = new Date().getFullYear() - dob.getFullYear();
                const statusColor = donor.approval_status === 'approved' ? 'green' : donor.approval_status === 'rejected' ?
                    'red' : 'yellow';
                const statusText = donor.approval_status.charAt(0).toUpperCase() + donor.approval_status.slice(1);

                const content = `
                <div class="space-y-4">
                    <!-- Header Card with Avatar -->
                    <div class="bg-white rounded-xl p-4 shadow-sm flex items-center gap-4">
                        <div class="w-16 h-16 bg-gradient-to-br from-red-500 to-red-600 rounded-full flex items-center justify-center text-white text-2xl font-bold shadow-lg">
                            ${donor.first_name.charAt(0)}${donor.last_name.charAt(0)}
                        </div>
                        <div class="flex-1">
                            <h4 class="text-xl font-bold text-gray-900">${donor.first_name} ${donor.last_name}</h4>
                            <p class="text-sm text-gray-500">${donor.email}</p>
                            <div class="flex items-center gap-2 mt-1">
                                <span class="px-2 py-0.5 rounded-full text-xs font-bold bg-red-100 text-red-700">${donor.blood_group}</span>
                                <span class="px-2 py-0.5 rounded-full text-xs font-semibold bg-${statusColor}-100 text-${statusColor}-700">${statusText}</span>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-xs text-gray-400">ID</p>
                            <p class="text-sm font-mono font-bold text-gray-700">#${String(donor.id).padStart(4, '0')}</p>
                        </div>
                    </div>

                    <!-- Info Grid -->
                    <div class="grid grid-cols-2 gap-4">
                        <!-- Personal Info -->
                        <div class="bg-white rounded-xl p-4 shadow-sm">
                            <h5 class="text-sm font-bold text-gray-700 mb-3 flex items-center gap-2">
                                <span class="w-6 h-6 bg-blue-100 rounded-lg flex items-center justify-center text-sm">👤</span>
                                Personal Info
                            </h5>
                            <div class="space-y-2 text-sm">
                                <div class="flex justify-between"><span class="text-gray-500">Phone</span><span class="font-medium">${donor.phone}</span></div>
                                <div class="flex justify-between"><span class="text-gray-500">Gender</span><span class="font-medium capitalize">${donor.gender}</span></div>
                                <div class="flex justify-between"><span class="text-gray-500">Age</span><span class="font-medium">${age} years</span></div>
                                <div class="flex justify-between"><span class="text-gray-500">DOB</span><span class="font-medium">${new Date(donor.date_of_birth).toLocaleDateString('en-GB', { day: '2-digit', month: 'short', year: 'numeric' })}</span></div>
                            </div>
                        </div>

                        <!-- Medical Info -->
                        <div class="bg-white rounded-xl p-4 shadow-sm">
                            <h5 class="text-sm font-bold text-gray-700 mb-3 flex items-center gap-2">
                                <span class="w-6 h-6 bg-red-100 rounded-lg flex items-center justify-center text-sm">🏥</span>
                                Medical Info
                            </h5>
                            <div class="space-y-2 text-sm">
                                <div class="flex justify-between"><span class="text-gray-500">Blood Group</span><span class="font-bold text-red-600">${donor.blood_group}</span></div>
                                <div class="flex justify-between"><span class="text-gray-500">Weight</span><span class="font-medium">${donor.weight} kg</span></div>
                                <div class="flex justify-between"><span class="text-gray-500">Height</span><span class="font-medium">${donor.height} cm</span></div>
                                <div class="flex justify-between"><span class="text-gray-500">Conditions</span><span class="font-medium">${donor.medical_conditions || 'None'}</span></div>
                            </div>
                        </div>

                        <!-- Address Info -->
                        <div class="bg-white rounded-xl p-4 shadow-sm">
                            <h5 class="text-sm font-bold text-gray-700 mb-3 flex items-center gap-2">
                                <span class="w-6 h-6 bg-green-100 rounded-lg flex items-center justify-center text-sm">📍</span>
                                Address
                            </h5>
                            <div class="space-y-2 text-sm">
                                <p class="text-gray-700">${donor.address}</p>
                                <div class="flex justify-between"><span class="text-gray-500">City</span><span class="font-medium">${donor.city}</span></div>
                                <div class="flex justify-between"><span class="text-gray-500">State</span><span class="font-medium">${donor.state}</span></div>
                                <div class="flex justify-between"><span class="text-gray-500">Pincode</span><span class="font-medium">${donor.pincode}</span></div>
                            </div>
                        </div>

                        <!-- Availability -->
                        <div class="bg-white rounded-xl p-4 shadow-sm">
                            <h5 class="text-sm font-bold text-gray-700 mb-3 flex items-center gap-2">
                                <span class="w-6 h-6 bg-purple-100 rounded-lg flex items-center justify-center text-sm">📅</span>
                                Availability
                            </h5>
                            <div class="space-y-2 text-sm">
                                <div class="flex justify-between"><span class="text-gray-500">Available</span><span class="font-medium capitalize">${Array.isArray(donor.availability) ? donor.availability.join(', ') : donor.availability}</span></div>
                                <div class="flex justify-between"><span class="text-gray-500">Travel</span><span class="font-medium">${donor.travel_distance} km</span></div>
                                <div class="flex justify-between"><span class="text-gray-500">Registered</span><span class="font-medium">${new Date(donor.created_at).toLocaleDateString('en-GB', { day: '2-digit', month: 'short', year: 'numeric' })}</span></div>
                                <div class="flex justify-between"><span class="text-gray-500">By User</span><span class="font-medium">${donor.user ? donor.user.name : 'N/A'}</span></div>
                            </div>
                        </div>
                    </div>

                    <!-- Consents -->
                    <div class="bg-white rounded-xl p-4 shadow-sm">
                        <h5 class="text-sm font-bold text-gray-700 mb-3 flex items-center gap-2">
                            <span class="w-6 h-6 bg-yellow-100 rounded-lg flex items-center justify-center text-sm">✅</span>
                            Consents
                        </h5>
                        <div class="flex gap-3">
                            <div class="flex-1 flex items-center gap-2 p-2 rounded-lg ${donor.consent_medical ? 'bg-green-50 text-green-700' : 'bg-gray-100 text-gray-400'}">
                                <span class="text-lg">${donor.consent_medical ? '✓' : '✗'}</span>
                                <span class="text-xs font-medium">Medical</span>
                            </div>
                            <div class="flex-1 flex items-center gap-2 p-2 rounded-lg ${donor.consent_contact ? 'bg-green-50 text-green-700' : 'bg-gray-100 text-gray-400'}">
                                <span class="text-lg">${donor.consent_contact ? '✓' : '✗'}</span>
                                <span class="text-xs font-medium">Contact</span>
                            </div>
                            <div class="flex-1 flex items-center gap-2 p-2 rounded-lg ${donor.consent_privacy ? 'bg-green-50 text-green-700' : 'bg-gray-100 text-gray-400'}">
                                <span class="text-lg">${donor.consent_privacy ? '✓' : '✗'}</span>
                                <span class="text-xs font-medium">Privacy</span>
                            </div>
                        </div>
                    </div>
                </div>
            `;

                document.getElementById('donorModalContent').innerHTML = content;
                document.getElementById('donorModal').classList.remove('hidden');
                document.getElementById('donorModal').classList.add('flex');
            }

            function closeDonorModal() {
                document.getElementById('donorModal').classList.add('hidden');
                document.getElementById('donorModal').classList.remove('flex');
            }

            // Close modal on outside click
            document.getElementById('donorModal').addEventListener('click', function(e) {
                if (e.target === this) {
                    closeDonorModal();
                }
            });

            function showRejectModal(donorId) {
                const modal = document.getElementById('rejectModal');
                const form = document.getElementById('rejectForm');
                form.action = `/admin/donors/${donorId}/reject`;
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            }

            function closeRejectModal() {
                const modal = document.getElementById('rejectModal');
                const form = document.getElementById('rejectForm');
                form.reset();
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }

            // Close reject modal on outside click
            document.getElementById('rejectModal').addEventListener('click', function(e) {
                if (e.target === this) {
                    closeRejectModal();
                }
            });
        </script>
    @endpush
@endsection
