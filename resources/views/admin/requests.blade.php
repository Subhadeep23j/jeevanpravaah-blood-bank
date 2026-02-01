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
                                        <p class="text-xs text-gray-500">by {{ $request->user->name ?? 'N/A' }}</p>
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
                                    <button class="text-blue-600 hover:text-blue-800 font-semibold text-sm cursor-pointer"
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

    <div id="requestModal" class="hidden fixed inset-0 z-50 items-center justify-center p-4"
        style="display: none; background-color: rgba(255, 255, 255, 0.9); backdrop-filter: blur(2px);">
        <div class="bg-white rounded-2xl max-w-3xl w-full max-h-[90vh] overflow-y-auto shadow-2xl border border-gray-200">
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

                {{-- Status Update Form --}}
                <div id="statusUpdateSection" class="border-t border-gray-200 pt-4 mt-4">
                    <h4 class="text-sm font-semibold text-gray-700 mb-3">Update Status</h4>
                    <div id="statusFormContainer">
                        <form id="statusUpdateForm" method="POST" class="flex items-center gap-3">
                            @csrf
                            <select name="status" id="statusSelect"
                                class="flex-1 px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-red-500">
                                <option value="pending">Pending</option>
                                <option value="approved">Approved</option>
                                <option value="fulfilled">Fulfilled</option>
                                <option value="cancelled">Cancelled</option>
                            </select>
                            <button type="submit"
                                class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white font-semibold rounded-lg transition-colors cursor-pointer">
                                Update Status
                            </button>
                        </form>
                    </div>
                    <div id="statusLockedMessage" class="hidden">
                        <p class="text-gray-500 text-sm bg-gray-100 px-4 py-3 rounded-lg">
                            <svg class="w-5 h-5 inline-block mr-2 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                            Status has already been updated and cannot be changed.
                        </p>
                    </div>
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
                        address: '{{ addslashes($request->address) }}',
                        hospital_name: '{{ addslashes($request->hospital_name) }}',
                        blood_type: '{{ $request->blood_type }}',
                        doctor_prescription: '{{ $request->doctor_prescription ?? '' }}',
                        prescription_url: '{{ $request->doctor_prescription && $request->doctor_prescription !== '' ? asset('storage/' . $request->doctor_prescription) : '' }}',
                        units_required: {{ $request->units_required }},
                        urgency: '{{ $request->urgency }}',
                        status: '{{ $request->status }}',
                        user_name: '{{ $request->user->name ?? 'N/A' }}',
                        date: '{{ $request->created_at->format('M d, Y H:i A') }}'
                    },
                @endforeach
            };

            function openRequestModal(id) {
                const request = requestsData[id];
                if (!request) return;

                // Update form action URL
                document.getElementById('statusUpdateForm').action = `/admin/requests/${id}/update-status`;
                document.getElementById('statusSelect').value = request.status;

                // Show/hide status form based on current status
                if (request.status === 'pending') {
                    document.getElementById('statusFormContainer').classList.remove('hidden');
                    document.getElementById('statusLockedMessage').classList.add('hidden');
                } else {
                    document.getElementById('statusFormContainer').classList.add('hidden');
                    document.getElementById('statusLockedMessage').classList.remove('hidden');
                }

                const prescriptionHtml = request.prescription_url && request.prescription_url.trim() !== '' ?
                    `<div style="margin-top: 8px; display: flex; align-items: center; gap: 12px;">
                        <img src="${request.prescription_url}" alt="Prescription Preview" 
                            style="width: 60px; height: 60px; object-fit: cover; border-radius: 8px; border: 2px solid #e5e7eb; cursor: pointer;"
                            onclick="window.open('${request.prescription_url}', '_blank')"
                            onerror="this.style.display='none'">
                        <a href="${request.prescription_url}" target="_blank" 
                            style="display: inline-flex; align-items: center; gap: 8px; padding: 10px 16px; background-color: #3b82f6; color: white; font-weight: 600; border-radius: 8px; text-decoration: none; box-shadow: 0 1px 2px rgba(0,0,0,0.1);"
                            onmouseover="this.style.backgroundColor='#2563eb'" 
                            onmouseout="this.style.backgroundColor='#3b82f6'">
                            <svg style="width: 20px; height: 20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            View Prescription
                        </a>
                    </div>` :
                    '<p style="color: #6b7280; font-size: 14px; margin-top: 4px;">No prescription uploaded</p>';

                const statusColors = {
                    'pending': 'bg-blue-100 text-blue-700',
                    'approved': 'bg-green-100 text-green-700',
                    'fulfilled': 'bg-purple-100 text-purple-700',
                    'cancelled': 'bg-red-100 text-red-700'
                };

                const urgencyColors = {
                    'normal': 'bg-yellow-100 text-yellow-700',
                    'urgent': 'bg-orange-100 text-orange-700',
                    'critical': 'bg-red-100 text-red-700'
                };

                const html = `
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="text-xs font-semibold text-gray-500">Patient Name</label>
                            <p class="text-gray-900 font-semibold">${request.patient_name}</p>
                        </div>
                        <div>
                            <label class="text-xs font-semibold text-gray-500">Blood Type</label>
                            <span class="inline-flex items-center justify-center px-3 py-1 bg-red-100 text-red-700 rounded-lg font-bold text-lg">${request.blood_type}</span>
                        </div>
                        <div>
                            <label class="text-xs font-semibold text-gray-500">Units Required</label>
                            <p class="text-gray-900 font-semibold">${request.units_required} units</p>
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
                            <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold ${urgencyColors[request.urgency] || 'bg-gray-100 text-gray-700'}">${request.urgency.charAt(0).toUpperCase() + request.urgency.slice(1)}</span>
                        </div>
                        <div>
                            <label class="text-xs font-semibold text-gray-500">Current Status</label>
                            <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold ${statusColors[request.status] || 'bg-gray-100 text-gray-700'}">${request.status.charAt(0).toUpperCase() + request.status.slice(1)}</span>
                        </div>
                        <div>
                            <label class="text-xs font-semibold text-gray-500">Requested By</label>
                            <p class="text-gray-900">${request.user_name}</p>
                        </div>
                        <div class="md:col-span-2">
                            <label class="text-xs font-semibold text-gray-500">Doctor Prescription</label>
                            ${prescriptionHtml}
                        </div>
                        <div class="md:col-span-2">
                            <label class="text-xs font-semibold text-gray-500">Request Date</label>
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
