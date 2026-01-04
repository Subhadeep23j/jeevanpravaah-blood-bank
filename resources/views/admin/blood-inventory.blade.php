@extends('admin.dashboard-layout')

@section('title', 'Blood Inventory - Admin Panel')

@section('content')
    <!-- Main Content -->
    <main class="flex-1 overflow-y-auto p-4 pt-2">
        <!-- Header Section -->
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Blood Inventory</h1>
                <p class="text-sm text-gray-500 mt-1">Manage and track blood stock levels</p>
            </div>
            <button onclick="openAddStockModal()"
                class="mt-4 sm:mt-0 w-full sm:w-auto px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition-colors flex items-center justify-center gap-2 shadow-sm">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10.5 1.5H9.5v7h-7v1h7v7h1v-7h7v-1h-7v-7z" clip-rule="evenodd" />
                </svg>
                Add Stock
            </button>
        </div>
        <!-- Summary Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            <!-- Total Units Available -->
            <div
                class="bg-gradient-to-br from-green-50 to-green-100 rounded-xl p-6 shadow-md border border-green-200 hover:shadow-lg transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-green-700 text-xs font-semibold uppercase tracking-wide">Total Available</p>
                        <p class="text-3xl font-black text-green-700 mt-2">{{ $totals['total_available'] }}</p>
                        <p class="text-xs text-green-600 mt-1">Units ready</p>
                    </div>
                    <div class="w-14 h-14 bg-green-200/50 rounded-full flex items-center justify-center">
                        <svg class="w-7 h-7 text-green-600" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Total Units -->
            <div
                class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-6 shadow-md border border-blue-200 hover:shadow-lg transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-blue-700 text-xs font-semibold uppercase tracking-wide">Total Units</p>
                        <p class="text-3xl font-black text-blue-700 mt-2">{{ $totals['total_units'] }}</p>
                        <p class="text-xs text-blue-600 mt-1">In inventory</p>
                    </div>
                    <div class="w-14 h-14 bg-blue-200/50 rounded-full flex items-center justify-center">
                        <svg class="w-7 h-7 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm3.5-9c.83 0 1.5-.67 1.5-1.5S16.33 8 15.5 8 14 8.67 14 9.5s.67 1.5 1.5 1.5zm-7 0c.83 0 1.5-.67 1.5-1.5S9.33 8 8.5 8 7 8.67 7 9.5 7.67 11 8.5 11zm3.5 6.5c2.33 0 4.31-1.46 5.11-3.5H6.89c.8 2.04 2.78 3.5 5.11 3.5z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Reserved Units -->
            <div
                class="bg-gradient-to-br from-yellow-50 to-yellow-100 rounded-xl p-6 shadow-md border border-yellow-200 hover:shadow-lg transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-yellow-700 text-xs font-semibold uppercase tracking-wide">Reserved</p>
                        <p class="text-3xl font-black text-yellow-700 mt-2">{{ $totals['total_reserved'] }}</p>
                        <p class="text-xs text-yellow-600 mt-1">Pending use</p>
                    </div>
                    <div class="w-14 h-14 bg-yellow-200/50 rounded-full flex items-center justify-center">
                        <svg class="w-7 h-7 text-yellow-600" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Approved Donors -->
            <div
                class="bg-gradient-to-br from-red-50 to-red-100 rounded-xl p-6 shadow-md border border-red-200 hover:shadow-lg transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-red-700 text-xs font-semibold uppercase tracking-wide">Donors</p>
                        <p class="text-3xl font-black text-red-700 mt-2">{{ $totals['total_approved_donors'] }}</p>
                        <p class="text-xs text-red-600 mt-1">Approved</p>
                    </div>
                    <div class="w-14 h-14 bg-red-200/50 rounded-full flex items-center justify-center">
                        <svg class="w-7 h-7 text-red-600" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Blood Inventory - Desktop Table -->
        <div class="bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden hidden md:block">
            <div class="px-4 py-3 border-b border-gray-200 bg-gradient-to-r from-red-50 to-orange-50">
                <h2 class="text-lg font-bold text-gray-900">Blood Stock Details</h2>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200">
                            <th class="px-4 py-3 text-left font-semibold text-gray-700">Blood Type</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-700">Total Units</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-700">Reserved</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-700">Available</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-700">Donors</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-700">Status</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-700">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($bloodStockData as $stock)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-4 py-3">
                                    <span
                                        class="inline-flex items-center justify-center w-10 h-10 rounded-lg bg-red-100 text-red-700 font-bold text-sm">
                                        {{ $stock['blood_type'] }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 font-semibold text-gray-800">{{ $stock['units_available'] }}</td>
                                <td class="px-4 py-3 font-semibold text-yellow-700">{{ $stock['units_reserved'] }}</td>
                                <td class="px-4 py-3 font-semibold text-green-700">{{ $stock['actual_available'] }}</td>
                                <td class="px-4 py-3">
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-700">
                                        {{ $stock['approved_donors'] }}
                                    </span>
                                </td>
                                <td class="px-4 py-3">
                                    @if ($stock['status'] === 'available')
                                        <span
                                            class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">
                                            <span class="w-2 h-2 bg-green-500 rounded-full mr-1.5"></span>Available
                                        </span>
                                    @elseif($stock['status'] === 'low')
                                        <span
                                            class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-700">
                                            <span class="w-2 h-2 bg-yellow-500 rounded-full mr-1.5"></span>Low
                                        </span>
                                    @elseif($stock['status'] === 'critical')
                                        <span
                                            class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-orange-100 text-orange-700">
                                            <span class="w-2 h-2 bg-orange-500 rounded-full mr-1.5"></span>Critical
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-red-100 text-red-700">
                                            <span class="w-2 h-2 bg-red-500 rounded-full mr-1.5"></span>Out
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    <button onclick="openAddStockModal('{{ $stock['blood_type'] }}')"
                                        class="px-2.5 py-1.5 text-xs font-medium text-white bg-red-600 hover:bg-red-700 rounded transition-colors">
                                        Add
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center text-gray-500">
                                    <p class="text-lg font-medium">No blood stock data available</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Blood Inventory - Mobile Card View -->
        <div class="md:hidden space-y-4">
            @forelse($bloodStockData as $stock)
                <div
                    class="bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden hover:shadow-lg transition-shadow">
                    <!-- Header -->
                    <div
                        class="bg-gradient-to-r from-red-50 to-orange-50 px-4 py-3 border-b border-gray-200 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 rounded-lg bg-red-100 flex items-center justify-center">
                                <span class="font-black text-red-700 text-lg">{{ $stock['blood_type'] }}</span>
                            </div>
                            <div>
                                <p class="font-bold text-gray-900">{{ $stock['blood_type'] }} Blood</p>
                                <p class="text-xs text-gray-500">
                                    @if ($stock['status'] === 'available')
                                        <span class="text-green-600 font-medium">✓ Available</span>
                                    @elseif($stock['status'] === 'low')
                                        <span class="text-yellow-600 font-medium">⚠ Low Stock</span>
                                    @elseif($stock['status'] === 'critical')
                                        <span class="text-orange-600 font-medium">⚠ Critical</span>
                                    @else
                                        <span class="text-red-600 font-medium">✕ Out of Stock</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Stats Grid -->
                    <div class="grid grid-cols-2 gap-3 p-4 bg-white">
                        <div class="bg-blue-50 p-3 rounded-lg">
                            <p class="text-xs text-gray-600 font-medium">Total Units</p>
                            <p class="text-2xl font-black text-blue-700 mt-1">{{ $stock['units_available'] }}</p>
                        </div>
                        <div class="bg-green-50 p-3 rounded-lg">
                            <p class="text-xs text-gray-600 font-medium">Available</p>
                            <p class="text-2xl font-black text-green-700 mt-1">{{ $stock['actual_available'] }}</p>
                        </div>
                        <div class="bg-yellow-50 p-3 rounded-lg">
                            <p class="text-xs text-gray-600 font-medium">Reserved</p>
                            <p class="text-2xl font-black text-yellow-700 mt-1">{{ $stock['units_reserved'] }}</p>
                        </div>
                        <div class="bg-purple-50 p-3 rounded-lg">
                            <p class="text-xs text-gray-600 font-medium">Donors</p>
                            <p class="text-2xl font-black text-purple-700 mt-1">{{ $stock['approved_donors'] }}</p>
                        </div>
                    </div>

                    <!-- Action Button -->
                    <div class="px-4 py-3 border-t border-gray-200 bg-gray-50">
                        <button onclick="openAddStockModal('{{ $stock['blood_type'] }}')"
                            class="w-full px-3 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition-colors text-sm flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10.5 1.5H9.5v7h-7v1h7v7h1v-7h7v-1h-7v-7z"
                                    clip-rule="evenodd" />
                            </svg>
                            Add Stock
                        </button>
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-xl shadow-md border border-gray-100 px-6 py-12 text-center">
                    <p class="text-lg font-medium text-gray-900">No blood stock data</p>
                    <p class="text-sm text-gray-500 mt-1">Blood stock information will appear here</p>
                </div>
            @endforelse
        </div>

        <!-- Legend -->
        <div class="mt-8 bg-white rounded-xl shadow-md border border-gray-100 p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4">Status Legend</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="flex items-center gap-3">
                    <div class="w-3 h-3 rounded-full bg-green-500"></div>
                    <span class="text-sm text-gray-700">Available (50+ units)</span>
                </div>
                <div class="flex items-center gap-3">
                    <div class="w-3 h-3 rounded-full bg-yellow-500"></div>
                    <span class="text-sm text-gray-700">Low Stock (20-49)</span>
                </div>
                <div class="flex items-center gap-3">
                    <div class="w-3 h-3 rounded-full bg-orange-500"></div>
                    <span class="text-sm text-gray-700">Critical (1-19)</span>
                </div>
                <div class="flex items-center gap-3">
                    <div class="w-3 h-3 rounded-full bg-red-500"></div>
                    <span class="text-sm text-gray-700">Out of Stock</span>
                </div>
            </div>
        </div>
    </main>

    <!-- Add Stock Modal -->
    <div id="addStockModal"
        class="hidden fixed inset-0 bg-black/60 backdrop-blur-sm z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full">
            <!-- Header -->
            <div
                class="bg-gradient-to-r from-red-600 to-red-500 px-6 py-4 flex items-center justify-between rounded-t-2xl">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10.5 1.5H9.5v7h-7v1h7v7h1v-7h7v-1h-7v-7z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-white">Add Blood Stock</h3>
                        <p id="stockBloodType" class="text-red-100 text-sm">Blood Type</p>
                    </div>
                </div>
                <button onclick="closeAddStockModal()" class="text-white/80 hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Form -->
            <form id="addStockForm" method="POST" class="p-6 space-y-4">
                @csrf

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Blood Type *</label>
                    <select id="bloodTypeInput" name="blood_type" required
                        class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-red-500 focus:ring-2 focus:ring-red-200 focus:outline-none transition-all">
                        <option value="">-- Select Blood Type --</option>
                        <option value="A+">A+</option>
                        <option value="A-">A-</option>
                        <option value="B+">B+</option>
                        <option value="B-">B-</option>
                        <option value="O+">O+</option>
                        <option value="O-">O-</option>
                        <option value="AB+">AB+</option>
                        <option value="AB-">AB-</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Units to Add *</label>
                    <input type="number" id="unitsInput" name="units" min="1" max="1000"
                        placeholder="Enter quantity"
                        class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-red-500 focus:ring-2 focus:ring-red-200 focus:outline-none transition-all"
                        required>
                    <p class="text-xs text-gray-500 mt-1">Add between 1 and 1000 units</p>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Notes (Optional)</label>
                    <textarea id="notesInput" name="notes" rows="3" placeholder="Add any notes about this stock addition..."
                        class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-red-500 focus:ring-2 focus:ring-red-200 focus:outline-none transition-all resize-none"></textarea>
                </div>

                <div class="flex gap-3 pt-4">
                    <button type="button" onclick="closeAddStockModal()"
                        class="flex-1 px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium rounded-lg transition-colors">
                        Cancel
                    </button>
                    <button type="submit"
                        class="flex-1 px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-bold rounded-lg transition-colors flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10.5 1.5H9.5v7h-7v1h7v7h1v-7h7v-1h-7v-7z" clip-rule="evenodd" />
                        </svg>
                        Add Stock
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            let selectedBloodType = null;

            function openAddStockModal(bloodType = null) {
                selectedBloodType = bloodType || null;
                const modal = document.getElementById('addStockModal');
                const form = document.getElementById('addStockForm');
                const bloodTypeInput = document.getElementById('bloodTypeInput');
                const stockBloodType = document.getElementById('stockBloodType');

                if (bloodType) {
                    bloodTypeInput.value = bloodType;
                    stockBloodType.textContent = `Add units for ${bloodType}`;
                } else {
                    bloodTypeInput.value = '';
                    stockBloodType.textContent = 'Select blood type';
                }

                document.getElementById('unitsInput').value = '';
                document.getElementById('notesInput').value = '';

                modal.classList.remove('hidden');
                modal.classList.add('flex');
            }

            function closeAddStockModal() {
                const modal = document.getElementById('addStockModal');
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }

            document.getElementById('addStockForm').addEventListener('submit', async function(e) {
                e.preventDefault();

                const bloodType = document.getElementById('bloodTypeInput').value;
                const units = document.getElementById('unitsInput').value;
                const notes = document.getElementById('notesInput').value;

                if (!bloodType || !units) {
                    alert('Please fill in all required fields');
                    return;
                }

                try {
                    const response = await fetch('/admin/blood-stock/add', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            blood_type: bloodType,
                            units: parseInt(units),
                            notes: notes
                        })
                    });

                    const data = await response.json();

                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Stock Added!',
                            text: `Successfully added ${units} units of ${bloodType}`,
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => {
                            closeAddStockModal();
                            location.reload();
                        });
                    } else {
                        Swal.fire('Error', data.message || 'Failed to add stock', 'error');
                    }
                } catch (error) {
                    Swal.fire('Error', 'Failed to add stock', 'error');
                    console.error('Error:', error);
                }
            });

            // Close modal on outside click
            document.getElementById('addStockModal').addEventListener('click', function(e) {
                if (e.target === this) {
                    closeAddStockModal();
                }
            });
        </script>
    @endpush
@endsection
