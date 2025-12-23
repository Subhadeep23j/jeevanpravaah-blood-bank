@extends('admin.dashboard-layout')
@section('title', 'Admin Dashboard - JeevanPravaah')
@section('page_title', 'Dashboard')

@section('content')
    {{-- Main container with reduced vertical spacing (space-y-4) --}}
    <div class="space-y-4 max-w-full">
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4">
            {{-- Stat Cards with reduced padding (p-4) --}}
            <div
                class="bg-white rounded-2xl shadow-lg p-4 border border-gray-100 hover:shadow-xl transition-shadow duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Donors</p>
                        <p class="text-3xl font-bold text-gray-900 mt-1">{{ number_format($stats['total_donors']) }}</p>
                        <p class="text-xs text-{{ $stats['monthly_growth'] >= 0 ? 'green' : 'red' }}-600 mt-1">
                            {{ $stats['monthly_growth'] >= 0 ? '↑' : '↓' }} {{ abs($stats['monthly_growth']) }}% from last
                            month</p>
                    </div>
                    <div
                        class="w-14 h-14 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center shadow-lg">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>

            <div
                class="bg-white rounded-2xl shadow-lg p-4 border border-gray-100 hover:shadow-xl transition-shadow duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Approved Donors</p>
                        <p class="text-3xl font-bold text-gray-900 mt-1">{{ number_format($stats['approved_donors']) }}</p>
                        <p class="text-xs text-green-600 mt-1">Ready to donate</p>
                    </div>
                    <div
                        class="w-14 h-14 bg-gradient-to-br from-red-500 to-red-600 rounded-2xl flex items-center justify-center shadow-lg">
                        <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div
                class="bg-white rounded-2xl shadow-lg p-4 border border-gray-100 hover:shadow-xl transition-shadow duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Pending Requests</p>
                        <p class="text-3xl font-bold text-gray-900 mt-1">{{ number_format($stats['pending_requests']) }}</p>
                        <p class="text-xs text-orange-600 mt-1">
                            {{ $stats['pending_requests'] > 0 ? 'Needs attention' : 'All clear' }}</p>
                    </div>
                    <div
                        class="w-14 h-14 bg-gradient-to-br from-orange-500 to-orange-600 rounded-2xl flex items-center justify-center shadow-lg">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>

            <div
                class="bg-white rounded-2xl shadow-lg p-4 border border-gray-100 hover:shadow-xl transition-shadow duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Registered Users</p>
                        <p class="text-3xl font-bold text-gray-900 mt-1">{{ number_format($stats['total_users']) }}</p>
                        <p class="text-xs text-green-600 mt-1">{{ $stats['today_donors'] }} new today</p>
                    </div>
                    <div
                        class="w-14 h-14 bg-gradient-to-br from-green-500 to-green-600 rounded-2xl flex items-center justify-center shadow-lg">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
            {{-- Card with reduced padding (p-4) --}}
            <div class="bg-white rounded-2xl shadow-lg p-4 border border-gray-100">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-bold text-gray-900">Recent Donations</h3>
                    <a href="{{ route('admin.donors') }}" class="text-sm font-semibold text-red-600 hover:text-red-700">View
                        All →</a>
                </div>
                <div class="space-y-3">
                    @forelse($recentDonations as $donation)
                        <div
                            class="flex items-center justify-between p-3 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors">
                            <div class="flex items-center space-x-3">
                                <div
                                    class="w-10 h-10 bg-gradient-to-br from-red-500 to-red-600 rounded-xl flex items-center justify-center text-white font-bold shadow text-sm">
                                    {{ $donation->blood_group }}</div>
                                <div>
                                    <p class="font-semibold text-gray-900 text-sm">{{ $donation->first_name }}
                                        {{ $donation->last_name }}</p>
                                    <p class="text-xs text-gray-500">{{ $donation->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            <span
                                class="px-3 py-1 bg-{{ $donation->approval_status === 'approved' ? 'green' : ($donation->approval_status === 'pending' ? 'yellow' : 'red') }}-100 text-{{ $donation->approval_status === 'approved' ? 'green' : ($donation->approval_status === 'pending' ? 'yellow' : 'red') }}-700 rounded-full text-xs font-semibold">{{ ucfirst($donation->approval_status ?? 'Pending') }}</span>
                        </div>
                    @empty
                        <div class="text-center py-8 text-gray-500">
                            <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                                </path>
                            </svg>
                            <p class="text-sm">No donations yet</p>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- Card with reduced padding (p-4) --}}
            <div class="bg-white rounded-2xl shadow-lg p-4 border border-gray-100">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-bold text-gray-900">Blood Type Distribution</h3>
                    <span class="text-sm text-gray-500">Donors Available</span>
                </div>
                <div class="space-y-3">
                    @php
                        $bloodGroups = ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];
                        $maxCount = count($bloodGroupStats) > 0 ? max($bloodGroupStats) : 1;
                        $colors = [
                            'A+' => 'red',
                            'A-' => 'pink',
                            'B+' => 'blue',
                            'B-' => 'indigo',
                            'AB+' => 'purple',
                            'AB-' => 'violet',
                            'O+' => 'green',
                            'O-' => 'teal',
                        ];
                    @endphp
                    @foreach ($bloodGroups as $group)
                        @php
                            $count = $bloodGroupStats[$group] ?? 0;
                            $percentage = $maxCount > 0 ? ($count / $maxCount) * 100 : 0;
                            $color = $colors[$group] ?? 'gray';
                        @endphp
                        <div>
                            <div class="flex items-center justify-between mb-1">
                                <span class="text-xs font-semibold text-gray-700">{{ $group }}</span>
                                <span class="text-xs font-bold text-gray-900">{{ $count }} donors</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                <div class="bg-gradient-to-r from-red-500 to-red-600 h-2.5 rounded-full shadow-sm"
                                    style="width: {{ $percentage }}%"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-lg p-4 border border-gray-100">
            <h3 class="text-lg font-bold text-gray-900 mb-4">Quick Actions</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                {{-- Quick action buttons with reduced padding (px-4 py-3) --}}
                <button
                    class="cursor-pointer flex items-center justify-center space-x-2 px-4 py-3 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white rounded-xl font-semibold shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200 text-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    <span>Add Donor</span>
                </button>
                <button
                    class="cursor-pointer flex items-center justify-center space-x-2 px-4 py-3 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white rounded-xl font-semibold shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200 text-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                    <span>Schedule</span>
                </button>
                <button
                    class="cursor-pointer flex items-center justify-center space-x-2 px-4 py-3 bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white rounded-xl font-semibold shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200 text-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                    <span>Generate Report</span>
                </button>
                <button
                    class="cursor-pointer flex items-center justify-center space-x-2 px-4 py-3 bg-gradient-to-r from-purple-500 to-purple-600 hover:from-purple-600 hover:to-purple-700 text-white rounded-xl font-semibold shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200 text-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                        </path>
                    </svg>
                    <span>Send Alert</span>
                </button>
            </div>
        </div>

    </div>
@endsection
