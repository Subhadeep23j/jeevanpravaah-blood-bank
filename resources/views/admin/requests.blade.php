@extends('admin.dashboard-layout')
@section('title', 'Blood Requests - JeevanPravaah Admin')
@section('page_title', 'Blood Requests')

@section('content')
    <div class="space-y-4">
        {{-- Stats Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            {{-- Total Requests --}}
            <div
                class="bg-white rounded-2xl shadow-lg p-4 border border-gray-100 hover:shadow-xl transition-shadow duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Requests</p>
                        <p class="text-3xl font-bold text-gray-900 mt-1">{{ number_format($stats['total_requests']) }}</p>
                        <p class="text-xs text-gray-500 mt-1">All blood requests</p>
                    </div>
                    <div
                        class="w-14 h-14 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center shadow-lg">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>

            {{-- Pending Requests --}}
            <div
                class="bg-white rounded-2xl shadow-lg p-4 border border-gray-100 hover:shadow-xl transition-shadow duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Pending Requests</p>
                        <p class="text-3xl font-bold text-gray-900 mt-1">{{ number_format($stats['pending_requests']) }}</p>
                        <p class="text-xs text-orange-600 mt-1">Awaiting action</p>
                    </div>
                    <div
                        class="w-14 h-14 bg-gradient-to-br from-orange-500 to-orange-600 rounded-2xl flex items-center justify-center shadow-lg">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            {{-- Approved Requests --}}
            <div
                class="bg-white rounded-2xl shadow-lg p-4 border border-gray-100 hover:shadow-xl transition-shadow duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Approved Requests</p>
                        <p class="text-3xl font-bold text-gray-900 mt-1">{{ number_format($stats['approved_requests']) }}
                        </p>
                        <p class="text-xs text-green-600 mt-1">In progress</p>
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

            {{-- Fulfilled Requests --}}
            <div
                class="bg-white rounded-2xl shadow-lg p-4 border border-gray-100 hover:shadow-xl transition-shadow duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Fulfilled Requests</p>
                        <p class="text-3xl font-bold text-gray-900 mt-1">{{ number_format($stats['fulfilled_requests']) }}
                        </p>
                        <p class="text-xs text-blue-600 mt-1">Completed</p>
                    </div>
                    <div
                        class="w-14 h-14 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center shadow-lg">
                        <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        {{-- Requests Table --}}
        <div class="bg-white rounded-2xl shadow-lg p-4 border border-gray-100">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold text-gray-900">Blood Requests</h3>
                <div class="flex gap-2">
                    <select id="status-filter"
                        class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-red-500">
                        <option value="">All Status</option>
                        <option value="pending">Pending</option>
                        <option value="approved">Approved</option>
                        <option value="fulfilled">Fulfilled</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                    <input type="text" id="search-input" placeholder="Search requests..."
                        class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-red-500 w-48">
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-gray-200 bg-gray-50">
                            <th class="text-left py-3 px-4 font-semibold text-gray-700">Patient Name</th>
                            <th class="text-left py-3 px-4 font-semibold text-gray-700">Blood Type</th>
                            <th class="text-left py-3 px-4 font-semibold text-gray-700">Units</th>
                            <th class="text-left py-3 px-4 font-semibold text-gray-700">Hospital</th>
                            <th class="text-left py-3 px-4 font-semibold text-gray-700">Urgency</th>
                            <th class="text-left py-3 px-4 font-semibold text-gray-700">Status</th>
                            <th class="text-left py-3 px-4 font-semibold text-gray-700">Date</th>
                            <th class="text-center py-3 px-4 font-semibold text-gray-700">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($bloodRequests as $request)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="py-4 px-4">
                                    <div class="flex flex-col">
                                        <p class="font-semibold text-gray-900">{{ $request->patient_name }}</p>
                                        <p class="text-xs text-gray-500">by {{ $request->user->first_name ?? 'N/A' }}</p>
                                    </div>
                                </td>
                                <td class="py-4 px-4">
                                    <span
                                        class="inline-flex items-center justify-center w-10 h-10 bg-red-100 text-red-700 rounded-lg font-bold text-sm">
                                        {{ $request->blood_type }}
                                    </span>
                                </td>
                                <td class="py-4 px-4">
                                    <p class="font-medium text-gray-900">{{ $request->units_required }}</p>
                                </td>
                                <td class="py-4 px-4">
                                    <p class="text-gray-700">{{ $request->hospital_name }}</p>
                                </td>
                                <td class="py-4 px-4">
                                    <span
                                        class="inline-block px-3 py-1 rounded-full text-xs font-semibold
                                        {{ $request->urgency === 'critical' ? 'bg-red-100 text-red-700' : ($request->urgency === 'urgent' ? 'bg-orange-100 text-orange-700' : 'bg-yellow-100 text-yellow-700') }}">
                                        {{ ucfirst($request->urgency) }}
                                    </span>
                                </td>
                                <td class="py-4 px-4">
                                    <span
                                        class="inline-block px-3 py-1 rounded-full text-xs font-semibold
                                        {{ $request->status === 'pending' ? 'bg-blue-100 text-blue-700' : ($request->status === 'approved' ? 'bg-green-100 text-green-700' : ($request->status === 'fulfilled' ? 'bg-purple-100 text-purple-700' : 'bg-red-100 text-red-700')) }}">
                                        {{ ucfirst($request->status) }}
                                    </span>
                                </td>
                                <td class="py-4 px-4 text-gray-600">
                                    {{ $request->created_at->format('M d, Y') }}
                                </td>
                                <td class="py-4 px-4 text-center">
                                    <button class="text-blue-600 hover:text-blue-800 font-semibold text-sm"
                                        onclick="openRequestModal({{ $request->id }})">View</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-8 text-gray-500">
                                    <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                        </path>
                                    </svg>
                                    <p class="text-sm">No blood requests found</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if ($bloodRequests->hasPages())
                <div class="mt-4 flex justify-center">
                    {{ $bloodRequests->links() }}
                </div>
            @endif
        </div>
    </div>

    <div id="requestModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 items-center justify-center p-4"
        style="display: none;">
        <div class="bg-white rounded-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
            <div class="sticky top-0 bg-white border-b border-gray-200 p-4 flex items-center justify-between">
                <h3 class="text-xl font-bold text-gray-900">Request Details</h3>
                <button onclick="closeRequestModal()" class="text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>

            <div class="p-6 space-y-4">
                <div id="modalContent">
                    {{-- Content will be loaded dynamically --}}
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Mock data for demo - replace with actual AJAX call
            const requestsData = {
                @foreach ($bloodRequests as $request)
                    {{ $request->id }}: {
                        id: {{ $request->id }},
                        patient_name: '{{ $request->patient_name }}',
                        phone: '{{ $request->phone }}',
                        address: '{{ $request->address }}',
                        hospital_name: '{{ $request->hospital_name }}',
                        blood_type: '{{ $request->blood_type }}',
                        doctor_prescription: '{{ $request->doctor_prescription }}',
                        units_required: {{ $request->units_required }},
                        urgency: '{{ $request->urgency }}',
                        status: '{{ $request->status }}',
                        user_name: '{{ $request->user->first_name ?? 'N/A' }}',
                        date: '{{ $request->created_at->format('M d, Y H:i A') }}'
                    },
                @endforeach
            };

            function openRequestModal(id) {
                const request = requestsData[id];
                if (!request) return;

                const html = `
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="text-xs font-semibold text-gray-500">Patient Name</label>
                            <p class="text-gray-900 font-semibold">${request.patient_name}</p>
                        </div>
                        <div>
                            <label class="text-xs font-semibold text-gray-500">Blood Type</label>
                            <p class="text-gray-900 font-semibold text-lg">${request.blood_type}</p>
                        </div>
                        <div>
                            <label class="text-xs font-semibold text-gray-500">Units Required</label>
                            <p class="text-gray-900 font-semibold">${request.units_required}</p>
                        </div>
                        <div>
                            <label class="text-xs font-semibold text-gray-500">Phone</label>
                            <p class="text-gray-900">${request.phone}</p>
                        </div>
                        <div class="md:col-span-2">
                            <label class="text-xs font-semibold text-gray-500">Address</label>
                            <p class="text-gray-900">${request.address}</p>
                        </div>
                        <div>
                            <label class="text-xs font-semibold text-gray-500">Hospital</label>
                            <p class="text-gray-900">${request.hospital_name}</p>
                        </div>
                        <div>
                            <label class="text-xs font-semibold text-gray-500">Urgency</label>
                            <p class="text-gray-900">${request.urgency}</p>
                        </div>
                        <div>
                            <label class="text-xs font-semibold text-gray-500">Status</label>
                            <p class="text-gray-900">${request.status}</p>
                        </div>
                        <div>
                            <label class="text-xs font-semibold text-gray-500">Requested By</label>
                            <p class="text-gray-900">${request.user_name}</p>
                        </div>
                        <div class="md:col-span-2">
                            <label class="text-xs font-semibold text-gray-500">Doctor Prescription</label>
                            <p class="text-gray-900">${request.doctor_prescription || 'N/A'}</p>
                        </div>
                        <div class="md:col-span-2">
                            <label class="text-xs font-semibold text-gray-500">Date</label>
                            <p class="text-gray-900">${request.date}</p>
                        </div>
                    </div>
                `;

                document.getElementById('modalContent').innerHTML = html;
                document.getElementById('requestModal').classList.remove('hidden');
                document.getElementById('requestModal').style.display = 'flex';
            }

            function closeRequestModal() {
                document.getElementById('requestModal').classList.add('hidden');
                document.getElementById('requestModal').style.display = 'none';
            }

            // Filter functionality
            document.getElementById('status-filter').addEventListener('change', function() {
                filterTable();
            });

            document.getElementById('search-input').addEventListener('keyup', function() {
                filterTable();
            });

            function filterTable() {
                const statusFilter = document.getElementById('status-filter').value.toLowerCase();
                const searchInput = document.getElementById('search-input').value.toLowerCase();
                const rows = document.querySelectorAll('tbody tr');

                rows.forEach(row => {
                    let showRow = true;

                    if (statusFilter) {
                        const statusCell = row.querySelector('td:nth-child(6)');
                        const status = statusCell ? statusCell.textContent.toLowerCase() : '';
                        showRow = status.includes(statusFilter);
                    }

                    if (showRow && searchInput) {
                        const text = row.textContent.toLowerCase();
                        showRow = text.includes(searchInput);
                    }

                    row.style.display = showRow ? '' : 'none';
                });
            }

            // Close modal when clicking outside
            document.getElementById('requestModal').addEventListener('click', function(e) {
                if (e.target === this) {
                    closeRequestModal();
                }
            });
        </script>
    @endpush
@endsection
