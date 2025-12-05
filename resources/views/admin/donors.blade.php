@extends('admin.dashboard-layout')
@section('title', 'Donors Management - JeevanPravaah')
@section('page_title', 'All Donors')

@section('content')
    <div class="space-y-6">
        <!-- Statistics Overview -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl shadow-lg p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-blue-100 text-sm font-medium mb-1">Total Donors</p>
                        <h3 class="text-3xl font-black">{{ App\Models\Donor::count() }}</h3>
                    </div>
                    <div class="w-14 h-14 bg-white bg-opacity-20 rounded-xl flex items-center justify-center">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-red-500 to-red-600 rounded-2xl shadow-lg p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-red-100 text-sm font-medium mb-1">Today's Donors</p>
                        <h3 class="text-3xl font-black">{{ App\Models\Donor::whereDate('created_at', today())->count() }}
                        </h3>
                    </div>
                    <div class="w-14 h-14 bg-white bg-opacity-20 rounded-xl flex items-center justify-center">
                        <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-2xl shadow-lg p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-green-100 text-sm font-medium mb-1">This Month</p>
                        <h3 class="text-3xl font-black">
                            {{ App\Models\Donor::whereMonth('created_at', now()->month)->count() }}</h3>
                    </div>
                    <div class="w-14 h-14 bg-white bg-opacity-20 rounded-xl flex items-center justify-center">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl shadow-lg p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-purple-100 text-sm font-medium mb-1">Unique Users</p>
                        <h3 class="text-3xl font-black">{{ App\Models\Donor::distinct('user_id')->count('user_id') }}</h3>
                    </div>
                    <div class="w-14 h-14 bg-white bg-opacity-20 rounded-xl flex items-center justify-center">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters and Search -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-4">
            <div class="flex flex-col md:flex-row gap-4 items-center justify-between">
                <div class="flex-1 w-full md:w-auto">
                    <div class="relative">
                        <input type="text" id="searchDonor" placeholder="Search by name, email, blood group..."
                            class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                        <svg class="w-5 h-5 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>
                <div class="flex gap-2">
                    <select id="bloodGroupFilter"
                        class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                        <option value="">All Blood Groups</option>
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
                        class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                        <option value="">All Genders</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Donors Table -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-red-50 to-orange-50">
                <h2 class="text-xl font-black text-gray-900">All Donors</h2>
            </div>

            @if (App\Models\Donor::count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full" id="donorsTable">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">#
                                </th>
                                <th class="px-4 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                    Name</th>
                                <th class="px-4 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                    Contact</th>
                                <th class="px-4 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                    Blood Group</th>
                                <th class="px-4 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                    Gender</th>
                                <th class="px-4 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Age
                                </th>
                                <th class="px-4 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                    Location</th>
                                <th class="px-4 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                    Date</th>
                                <th class="px-4 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                    Status</th>
                                <th class="px-4 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach (App\Models\Donor::with('user')->latest()->get() as $index => $donor)
                                <tr class="hover:bg-gray-50 transition-colors duration-200 donor-row"
                                    data-name="{{ strtolower($donor->first_name . ' ' . $donor->last_name) }}"
                                    data-email="{{ strtolower($donor->email) }}" data-blood="{{ $donor->blood_group }}"
                                    data-gender="{{ $donor->gender }}">
                                    <td class="px-4 py-3 whitespace-nowrap">
                                        <span class="text-sm font-bold text-gray-900">{{ $index + 1 }}</span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="flex items-center">
                                            <div
                                                class="w-10 h-10 bg-gradient-to-br from-red-500 to-red-600 rounded-full flex items-center justify-center text-white font-bold flex-shrink-0">
                                                {{ strtoupper(substr($donor->first_name, 0, 1)) }}
                                            </div>
                                            <div class="ml-3">
                                                <div class="text-sm font-bold text-gray-900">{{ $donor->first_name }}
                                                    {{ $donor->last_name }}</div>
                                                <div class="text-xs text-gray-500">ID:
                                                    #{{ str_pad($donor->id, 4, '0', STR_PAD_LEFT) }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="text-sm text-gray-900">{{ $donor->phone }}</div>
                                        <div class="text-xs text-gray-500">{{ $donor->email }}</div>
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap">
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold bg-red-100 text-red-800">
                                            {{ $donor->blood_group }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap">
                                        <span class="text-sm text-gray-900">{{ $donor->gender }}</span>
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap">
                                        <span
                                            class="text-sm text-gray-900">{{ \Carbon\Carbon::parse($donor->date_of_birth)->age }}
                                            yrs</span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="text-sm text-gray-900">{{ $donor->city }}</div>
                                        <div class="text-xs text-gray-500">{{ $donor->state }}</div>
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $donor->created_at->format('M d, Y') }}
                                        </div>
                                        <div class="text-xs text-gray-500">{{ $donor->created_at->diffForHumans() }}</div>
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap">
                                        @if ($donor->approval_status === 'approved')
                                            <span
                                                class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-green-100 text-green-800">
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                Approved
                                            </span>
                                        @elseif($donor->approval_status === 'rejected')
                                            <span
                                                class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-red-100 text-red-800">
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                Rejected
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-yellow-100 text-yellow-800">
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                Pending
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap">
                                        <div class="flex items-center gap-2">
                                            <button onclick="showDonorDetails({{ $donor->id }})"
                                                class="inline-flex items-center px-2 py-1 bg-blue-100 hover:bg-blue-200 text-blue-700 text-xs font-medium rounded-lg transition-colors">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                                View
                                            </button>

                                            @if ($donor->approval_status !== 'approved')
                                                <form action="{{ route('admin.donors.approve', $donor->id) }}"
                                                    method="POST" class="inline"
                                                    data-confirm="Are you sure you want to approve this donor?">
                                                    @csrf
                                                    <button type="submit"
                                                        class="inline-flex items-center px-2 py-1 bg-green-100 hover:bg-green-200 text-green-700 text-xs font-medium rounded-lg transition-colors">
                                                        <svg class="w-3 h-3 mr-1" fill="currentColor"
                                                            viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd"
                                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                        Approve
                                                    </button>
                                                </form>
                                            @endif

                                            @if ($donor->approval_status !== 'rejected')
                                                <button onclick="showRejectModal({{ $donor->id }})"
                                                    class="inline-flex items-center px-2 py-1 bg-red-100 hover:bg-red-200 text-red-700 text-xs font-medium rounded-lg transition-colors">
                                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    Reject
                                                </button>
                                            @endif

                                            @if ($donor->approval_status !== 'pending')
                                                <form action="{{ route('admin.donors.reset', $donor->id) }}"
                                                    method="POST" class="inline"
                                                    data-confirm="Reset this donor's status to pending?">
                                                    @csrf
                                                    <button type="submit"
                                                        class="inline-flex items-center px-2 py-1 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-medium rounded-lg transition-colors">
                                                        <svg class="w-3 h-3 mr-1" fill="currentColor"
                                                            viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd"
                                                                d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                        Reset
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="px-6 py-16 text-center">
                    <svg class="w-24 h-24 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">No Donors Yet</h3>
                    <p class="text-gray-600">There are no donor records in the system yet.</p>
                </div>
            @endif
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
    <div id="donorModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 z-50 items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-4xl w-full max-h-[90vh] overflow-y-auto">
            <div
                class="sticky top-0 bg-gradient-to-r from-red-500 to-orange-500 px-6 py-4 flex items-center justify-between">
                <h3 class="text-2xl font-black text-white">Donor Details</h3>
                <button onclick="closeDonorModal()"
                    class="text-white hover:text-gray-200 transition-colors cursor-pointer">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div id="donorModalContent" class="p-6">
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

            function filterDonors() {
                const searchTerm = searchInput.value.toLowerCase();
                const selectedBlood = bloodGroupFilter.value;
                const selectedGender = genderFilter.value;

                donorRows.forEach(row => {
                    const name = row.dataset.name;
                    const email = row.dataset.email;
                    const blood = row.dataset.blood;
                    const gender = row.dataset.gender;

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
            }

            searchInput.addEventListener('input', filterDonors);
            bloodGroupFilter.addEventListener('change', filterDonors);
            genderFilter.addEventListener('change', filterDonors);

            // Donor details modal
            const donorsData = @json(App\Models\Donor::with('user')->latest()->get());

            function showDonorDetails(donorId) {
                const donor = donorsData.find(d => d.id === donorId);
                if (!donor) return;

                const dob = new Date(donor.date_of_birth);
                const age = new Date().getFullYear() - dob.getFullYear();

                const content = `
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Personal Information -->
                    <div class="space-y-4">
                        <h4 class="text-lg font-bold text-gray-900 border-b-2 border-red-500 pb-2">Personal Information</h4>
                        <div class="space-y-3">
                            <div>
                                <label class="text-xs font-semibold text-gray-500 uppercase">Full Name</label>
                                <p class="text-sm font-medium text-gray-900">${donor.first_name} ${donor.last_name}</p>
                            </div>
                            <div>
                                <label class="text-xs font-semibold text-gray-500 uppercase">Email</label>
                                <p class="text-sm text-gray-900">${donor.email}</p>
                            </div>
                            <div>
                                <label class="text-xs font-semibold text-gray-500 uppercase">Phone</label>
                                <p class="text-sm text-gray-900">${donor.phone}</p>
                            </div>
                            <div>
                                <label class="text-xs font-semibold text-gray-500 uppercase">Date of Birth</label>
                                <p class="text-sm text-gray-900">${new Date(donor.date_of_birth).toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' })} (${age} years old)</p>
                            </div>
                            <div>
                                <label class="text-xs font-semibold text-gray-500 uppercase">Gender</label>
                                <p class="text-sm text-gray-900">${donor.gender}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Medical Information -->
                    <div class="space-y-4">
                        <h4 class="text-lg font-bold text-gray-900 border-b-2 border-red-500 pb-2">Medical Information</h4>
                        <div class="space-y-3">
                            <div>
                                <label class="text-xs font-semibold text-gray-500 uppercase">Blood Group</label>
                                <p class="text-sm"><span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold bg-red-100 text-red-800">${donor.blood_group}</span></p>
                            </div>
                            <div>
                                <label class="text-xs font-semibold text-gray-500 uppercase">Weight</label>
                                <p class="text-sm text-gray-900">${donor.weight} kg</p>
                            </div>
                            <div>
                                <label class="text-xs font-semibold text-gray-500 uppercase">Height</label>
                                <p class="text-sm text-gray-900">${donor.height} cm</p>
                            </div>
                            <div>
                                <label class="text-xs font-semibold text-gray-500 uppercase">Medical Conditions</label>
                                <p class="text-sm text-gray-900">${donor.medical_conditions || 'None'}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Address Information -->
                    <div class="space-y-4">
                        <h4 class="text-lg font-bold text-gray-900 border-b-2 border-red-500 pb-2">Address Information</h4>
                        <div class="space-y-3">
                            <div>
                                <label class="text-xs font-semibold text-gray-500 uppercase">Address</label>
                                <p class="text-sm text-gray-900">${donor.address}</p>
                            </div>
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label class="text-xs font-semibold text-gray-500 uppercase">City</label>
                                    <p class="text-sm text-gray-900">${donor.city}</p>
                                </div>
                                <div>
                                    <label class="text-xs font-semibold text-gray-500 uppercase">State</label>
                                    <p class="text-sm text-gray-900">${donor.state}</p>
                                </div>
                            </div>
                            <div>
                                <label class="text-xs font-semibold text-gray-500 uppercase">Pincode</label>
                                <p class="text-sm text-gray-900">${donor.pincode}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Availability & Preferences -->
                    <div class="space-y-4">
                        <h4 class="text-lg font-bold text-gray-900 border-b-2 border-red-500 pb-2">Availability & Preferences</h4>
                        <div class="space-y-3">
                            <div>
                                <label class="text-xs font-semibold text-gray-500 uppercase">Availability</label>
                                <p class="text-sm text-gray-900">${Array.isArray(donor.availability) ? donor.availability.join(', ') : donor.availability}</p>
                            </div>
                            <div>
                                <label class="text-xs font-semibold text-gray-500 uppercase">Travel Distance</label>
                                <p class="text-sm text-gray-900">${donor.travel_distance} km</p>
                            </div>
                            <div>
                                <label class="text-xs font-semibold text-gray-500 uppercase">Registered By</label>
                                <p class="text-sm text-gray-900">${donor.user ? donor.user.name : 'N/A'}</p>
                            </div>
                            <div>
                                <label class="text-xs font-semibold text-gray-500 uppercase">Registration Date</label>
                                <p class="text-sm text-gray-900">${new Date(donor.created_at).toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit' })}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Consents -->
                    <div class="md:col-span-2 space-y-4">
                        <h4 class="text-lg font-bold text-gray-900 border-b-2 border-red-500 pb-2">Consents</h4>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="flex items-center space-x-2 p-3 ${donor.consent_medical ? 'bg-green-50 border border-green-200' : 'bg-red-50 border border-red-200'} rounded-lg">
                                <svg class="w-5 h-5 ${donor.consent_medical ? 'text-green-600' : 'text-red-600'}" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-sm font-medium ${donor.consent_medical ? 'text-green-700' : 'text-red-700'}">Medical Consent</span>
                            </div>
                            <div class="flex items-center space-x-2 p-3 ${donor.consent_contact ? 'bg-green-50 border border-green-200' : 'bg-red-50 border border-red-200'} rounded-lg">
                                <svg class="w-5 h-5 ${donor.consent_contact ? 'text-green-600' : 'text-red-600'}" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-sm font-medium ${donor.consent_contact ? 'text-green-700' : 'text-red-700'}">Contact Consent</span>
                            </div>
                            <div class="flex items-center space-x-2 p-3 ${donor.consent_privacy ? 'bg-green-50 border border-green-200' : 'bg-red-50 border border-red-200'} rounded-lg">
                                <svg class="w-5 h-5 ${donor.consent_privacy ? 'text-green-600' : 'text-red-600'}" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-sm font-medium ${donor.consent_privacy ? 'text-green-700' : 'text-red-700'}">Privacy Consent</span>
                            </div>
                        </div>
                    </div>
                </div>
            `;

                document.getElementById('donorModalContent').innerHTML = content;
                document.getElementById('donorModal').classList.remove('hidden');
            }

            function closeDonorModal() {
                document.getElementById('donorModal').classList.add('hidden');
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
