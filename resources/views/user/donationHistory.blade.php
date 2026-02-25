@extends('layouts.auth-app')
@section('title', 'My Donation History - JeevanPravaah')

@section('content')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@500;600;700;800&family=Inter:wght@400;500;600&display=swap');

        :root {
            --primary: #c10007;
            --primary-dark: #9a0006;
            --secondary: #e63946;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --text-primary: #1a202c;
            --text-secondary: #64748b;
            --bg-subtle: #f8fafc;
            --border-color: #e2e8f0;
        }

        * {
            font-family: 'Inter', sans-serif;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            letter-spacing: -0.02em;
        }

        .page-bg {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 50%, #fef3f2 100%);
            min-height: 100vh;
        }

        .stat-card {
            border: 1px solid var(--border-color);
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            opacity: 0;
            transition: opacity 0.3s;
        }

        .stat-card:hover {
            border-color: var(--primary);
            box-shadow: 0 4px 20px rgba(220, 38, 38, 0.08);
            transform: translateY(-2px);
        }

        .stat-card:hover::before {
            opacity: 1;
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        .stat-icon.icon-total {
            background: linear-gradient(135deg, rgba(220, 38, 38, 0.1), rgba(244, 63, 94, 0.1));
            color: var(--primary);
        }

        .stat-icon.icon-approved {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success);
        }

        .stat-icon.icon-pending {
            background: rgba(245, 158, 11, 0.1);
            color: var(--warning);
        }

        .stat-icon.icon-rejected {
            background: rgba(239, 68, 68, 0.1);
            color: var(--danger);
        }

        .stat-label {
            font-size: 0.85rem;
            color: var(--text-secondary);
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 800;
            color: var(--text-primary);
            font-family: 'Poppins', sans-serif;
        }

        .table-header {
            background: linear-gradient(135deg, #fef3f2 0%, #fef3f2 100%);
            border-bottom: 2px solid var(--border-color);
        }

        .table-header th {
            padding: 1rem 1.5rem;
            text-align: left;
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--text-primary);
        }

        .table-row {
            border-bottom: 1px solid var(--border-color);
            transition: background-color 0.2s;
        }

        .table-row:hover {
            background-color: #fef3f2;
        }

        .table-row td {
            padding: 1.2rem 1.5rem;
            vertical-align: middle;
        }

        .donation-table {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid var(--border-color);
        }

        .pill-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.4rem 0.9rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            white-space: nowrap;
        }

        .pill-approved {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success);
        }

        .pill-rejected {
            background: rgba(239, 68, 68, 0.1);
            color: var(--danger);
        }

        .pill-pending {
            background: rgba(245, 158, 11, 0.1);
            color: var(--warning);
        }

        .primary-btn {
            background: var(--primary);
            color: white;
            padding: 0.6rem 1.2rem;
            border-radius: 8px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-size: 0.95rem;
        }

        .primary-btn:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(220, 38, 38, 0.25);
        }

        .primary-btn:active {
            transform: translateY(0);
        }

        .view-details-btn {
            background: white;
            border: 1.5px solid var(--primary);
            color: var(--primary);
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-size: 0.9rem;
        }

        .view-details-btn:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-2px);
        }

        .blood-type-badge {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 0.6rem 1rem;
            border-radius: 8px;
            font-weight: 700;
            font-size: 1.1rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .location-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .location-icon {
            width: 32px;
            height: 32px;
            border-radius: 6px;
            background: rgba(220, 38, 38, 0.1);
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .date-badge {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1.1rem;
            flex-shrink: 0;
        }

        .row-index {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            background: var(--bg-subtle);
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            flex-shrink: 0;
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .header-section {
            animation: slideInUp 0.6s ease-out;
        }

        .stat-cards-container {
            animation: slideInUp 0.6s ease-out 0.1s both;
        }

        .donation-table {
            animation: slideInUp 0.6s ease-out 0.2s both;
        }

        .empty-state {
            animation: slideInUp 0.6s ease-out;
        }

        .table-section-header {
            padding: 1.5rem;
            background: white;
            border-bottom: 2px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .table-section-header h2 {
            font-size: 1.1rem;
            color: var(--text-primary);
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin: 0;
        }

        .record-count {
            background: var(--bg-subtle);
            color: var(--text-secondary);
            font-size: 0.85rem;
            font-weight: 600;
            padding: 0.4rem 0.8rem;
            border-radius: 6px;
        }

        .modal-overlay {
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(4px);
            -webkit-backdrop-filter: blur(4px);
        }

        .modal-content {
            background: white;
            border-radius: 12px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            overflow: hidden;
        }

        .modal-header {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 1.5rem;
            border-bottom: none;
            border-radius: 12px 12px 0 0;
        }

        .modal-header h3 {
            color: white;
            margin: 0;
            font-size: 1.25rem;
        }

        .modal-body {
            padding: 1.5rem;
            background: white;
            border-radius: 0 0 12px 12px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
        }

        .info-item label {
            display: block;
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--text-secondary);
            margin-bottom: 0.4rem;
        }

        .info-item p {
            color: var(--text-primary);
            font-weight: 500;
            margin: 0;
        }

        @media (max-width: 640px) {
            h1 {
                font-size: 2rem;
            }

            .stat-card {
                padding: 1.2rem;
            }

            .stat-value {
                font-size: 1.75rem;
            }

            .table-row td {
                padding: 0.8rem 1rem;
                font-size: 0.9rem;
            }

            .primary-btn {
                padding: 0.5rem 1rem;
                font-size: 0.9rem;
            }
        }
    </style>

    {{-- Main Page Container --}}
    <div class="page-bg pt-20 pb-8 sm:pt-24 sm:pb-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Header Section --}}
            <div class="header-section mb-8 sm:mb-10">
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                    <div>
                        <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-2">Donation History</h1>
                        <p class="text-base sm:text-lg text-gray-600">Track your blood donation registrations</p>
                    </div>
                    <a href="{{ route('donate') }}" class="primary-btn">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        <span>New Donation</span>
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

            {{-- Statistics Cards --}}
            <div class="stat-cards-container grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
                <div class="stat-card">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="stat-label">Total Registrations</p>
                            <p class="stat-value">{{ $totalDonations }}</p>
                        </div>
                        <div class="stat-icon icon-total">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 6H6.28l-.31-1.243A1 1 0 005 4H3z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="stat-label">Approved</p>
                            <p class="stat-value" style="color: var(--success);">{{ $approvedDonations }}</p>
                        </div>
                        <div class="stat-icon icon-approved">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="stat-label">Pending Review</p>
                            <p class="stat-value" style="color: var(--warning);">{{ $pendingDonations }}</p>
                        </div>
                        <div class="stat-icon icon-pending">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="stat-label">Rejected</p>
                            <p class="stat-value" style="color: var(--danger);">{{ $rejectedDonations }}</p>
                        </div>
                        <div class="stat-icon icon-rejected">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            @if ($totalDonations > 0)
                <div class="donation-table">
                    {{-- Table Section Header --}}
                    <div class="table-section-header">
                        <h2>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                                <path fill-rule="evenodd"
                                    d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z"
                                    clip-rule="evenodd" />
                            </svg>
                            Complete History
                        </h2>
                        <span class="record-count">{{ $totalDonations }}
                            {{ $totalDonations === 1 ? 'Record' : 'Records' }}</span>
                    </div>

                    {{-- Table --}}
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="table-header">
                                <tr>
                                    <th style="width: 50px;">#</th>
                                    <th>Date</th>
                                    <th>Blood Group</th>
                                    <th>Location</th>
                                    <th>Status</th>
                                    <th style="width: 140px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($donations as $index => $donation)
                                    <tr class="table-row">
                                        <td>
                                            <div class="row-index">{{ $totalDonations - $index }}</div>
                                        </td>
                                        <td>
                                            <div class="flex items-center gap-3">
                                                <div class="date-badge">{{ $donation->created_at->format('d') }}</div>
                                                <div>
                                                    <div class="font-semibold text-gray-900">
                                                        {{ $donation->created_at->format('M Y') }}</div>
                                                    <div class="text-xs text-gray-500">
                                                        {{ $donation->created_at->format('h:i A') }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="blood-type-badge">
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                {{ $donation->blood_group }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="location-info">
                                                <div class="location-icon">
                                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </div>
                                                <div>
                                                    <div class="font-semibold text-gray-900 text-sm">{{ $donation->city }}
                                                    </div>
                                                    <div class="text-xs text-gray-500">{{ $donation->state }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            @if ($donation->approval_status === 'approved')
                                                <span class="pill-badge pill-approved">
                                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    Approved
                                                </span>
                                            @elseif($donation->approval_status === 'rejected')
                                                <span class="pill-badge pill-rejected">
                                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    Rejected
                                                </span>
                                            @else
                                                <span class="pill-badge pill-pending">
                                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    Pending
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            <button onclick="showDonationDetails({{ $donation->id }})"
                                                class="view-details-btn">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                                View
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                {{-- Empty State --}}
                <div class="empty-state bg-white rounded-12 border border-gray-200 p-12 sm:p-16 text-center">
                    <div class="max-w-sm mx-auto">
                        <div
                            class="w-20 h-20 sm:w-24 sm:h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-10 h-10 sm:w-12 sm:h-12 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">No Donations Yet</h3>
                        <p class="text-gray-600 mb-8">Start your journey to save lives by registering for your first blood
                            donation.</p>
                        <a href="{{ route('donate') }}" class="primary-btn"
                            style="width: fit-content; margin: 0 auto; display: inline-flex;">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                            <span>Register First Donation</span>
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>

    {{-- Modal --}}
    <div id="donationModal" class="hidden fixed inset-0 z-50 overflow-y-auto pt-8 pb-8"
        style="background: rgba(0,0,0,0.5); backdrop-filter: blur(4px); -webkit-backdrop-filter: blur(4px);">
        <div class="min-h-screen px-4 py-6 flex items-center justify-center">
            <div class="relative w-full max-w-2xl modal-content transform transition-all"
                onclick="event.stopPropagation()" style="max-height: 90vh; display: flex; flex-direction: column;">

                {{-- Modal Header --}}
                <div class="modal-header flex items-center justify-between flex-shrink-0"
                    style="border-radius: 12px 12px 0 0;">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-white">Donation Details</h3>
                    </div>
                    <button onclick="closeDonationModal()"
                        class="w-8 h-8 flex items-center justify-center rounded-lg bg-white/10 hover:bg-white/20 text-white transition-colors cursor-pointer">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                {{-- Modal Body --}}
                <div id="donationModalContent" class="modal-body overflow-y-auto flex-1"
                    style="border-radius: 0 0 12px 12px;">
                    <div class="flex items-center justify-center py-8">
                        <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-red-500"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            const donations = @json($donations->values()->all());
            const user = {
                name: @json(Auth::user()->name),
                email: @json(Auth::user()->email),
                phone: @json(Auth::user()->phone),
                gender: @json(Auth::user()->gender),
                date_of_birth: @json(Auth::user()->date_of_birth),
                blood_group: @json(Auth::user()->blood_group),
                aadhar_masked: @json(Auth::user()->aadhar ? '****-****-' . substr(Auth::user()->aadhar, -4) : null)
            };
            const modal = document.getElementById('donationModal');
            const modalContent = document.getElementById('donationModalContent');

            function showDonationDetails(donationId) {
                const donation = donations.find(d => d.id === donationId);
                if (!donation) return;

                const statusConfig = {
                    approved: {
                        bg: 'bg-green-50',
                        border: 'border-green-200',
                        text: 'text-green-700',
                        label: 'Approved'
                    },
                    rejected: {
                        bg: 'bg-red-50',
                        border: 'border-red-200',
                        text: 'text-red-700',
                        label: 'Rejected'
                    },
                    pending: {
                        bg: 'bg-yellow-50',
                        border: 'border-yellow-200',
                        text: 'text-yellow-700',
                        label: 'Pending'
                    }
                };
                const status = statusConfig[donation.approval_status] || statusConfig.pending;

                const regDate = new Date(donation.created_at).toLocaleDateString('en-IN', {
                    day: '2-digit',
                    month: 'short',
                    year: 'numeric'
                });

                const dobSource = user.date_of_birth || donation.date_of_birth;
                const dob = dobSource ? new Date(dobSource).toLocaleDateString('en-IN', {
                    day: '2-digit',
                    month: 'short',
                    year: 'numeric'
                }) : 'N/A';

                const age = dobSource ? Math.floor((new Date() - new Date(dobSource)) / (365.25 * 24 * 60 * 60 * 1000)) : null;
                const gender = user.gender || donation.gender || 'N/A';

                const availTags = (donation.availability && Array.isArray(donation.availability) && donation.availability
                        .length > 0) ?
                    donation.availability.map(a =>
                        `<span class="px-3 py-1 bg-gray-100 text-gray-700 text-xs rounded-lg">${a.replace('_', ' ')}</span>`)
                    .join('') :
                    '<span class="text-gray-400 text-xs">Not specified</span>';

                const content = `
                    <div class="mb-6 pb-6 border-b border-gray-200">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex items-center gap-4">
                                <div style="background: linear-gradient(135deg, #c10007, #e63946);" class="w-16 h-16 rounded-xl flex items-center justify-center shadow-lg">
                                    <span class="text-2xl font-black text-white">${donation.blood_group}</span>
                                </div>
                                <div>
                                    <p class="font-bold text-lg text-gray-900">${donation.first_name} ${donation.last_name}</p>
                                    <p class="text-sm text-gray-500">Registered: ${regDate}</p>
                                </div>
                            </div>
                            <span class="px-3 py-2 ${status.bg} ${status.text} text-sm font-semibold rounded-lg border ${status.border}">${status.label}</span>
                        </div>
                        ${donation.rejection_reason ? `<div class="p-3 bg-red-50 border border-red-200 rounded-lg"><p class="text-sm font-semibold text-red-700">⚠ Rejection: ${donation.rejection_reason}</p></div>` : ''}
                    </div>

                    <div class="space-y-6">
                        <div>
                            <p class="text-xs font-bold text-gray-700 uppercase tracking-wide mb-3">Contact Information</p>
                            <div class="grid grid-cols-2 gap-4">
                                <div class="info-item">
                                    <label>Email</label>
                                    <p class="break-all">${donation.email}</p>
                                </div>
                                <div class="info-item">
                                    <label>Phone</label>
                                    <p>${donation.phone}</p>
                                </div>
                            </div>
                        </div>

                        <div>
                            <p class="text-xs font-bold text-gray-700 uppercase tracking-wide mb-3">Personal Details</p>
                            <div class="grid grid-cols-2 gap-4">
                                <div class="info-item">
                                    <label>Date of Birth</label>
                                    <p>${dob}</p>
                                </div>
                                <div class="info-item">
                                    <label>Age</label>
                                    <p>${age ? age + ' years' : 'N/A'}</p>
                                </div>
                                <div class="info-item">
                                    <label>Gender</label>
                                    <p class="capitalize">${gender}</p>
                                </div>
                                <div class="info-item">
                                    <label>Aadhar</label>
                                    <p>${user.aadhar_masked || 'N/A'}</p>
                                </div>
                            </div>
                        </div>

                        <div>
                            <p class="text-xs font-bold text-gray-700 uppercase tracking-wide mb-3">Medical Information</p>
                            <div class="grid grid-cols-2 gap-4">
                                <div class="info-item">
                                    <label>Weight</label>
                                    <p>${donation.weight} kg</p>
                                </div>
                                <div class="info-item">
                                    <label>Height</label>
                                    <p>${donation.height} cm</p>
                                </div>
                                <div class="info-item">
                                    <label>BMI</label>
                                    <p>${(donation.weight / ((donation.height/100) ** 2)).toFixed(1)}</p>
                                </div>
                                <div class="info-item">
                                    <label>Travel Distance</label>
                                    <p>${donation.travel_distance === 'unlimited' ? 'Any distance' : donation.travel_distance + ' km'}</p>
                                </div>
                            </div>
                            ${donation.medical_conditions ? `<div class="mt-4 p-3 bg-yellow-50 border border-yellow-200 rounded-lg"><p class="text-xs font-semibold text-yellow-700">Medical Conditions: ${donation.medical_conditions}</p></div>` : ''}
                        </div>

                        <div>
                            <p class="text-xs font-bold text-gray-700 uppercase tracking-wide mb-3">Address</p>
                            <p class="font-semibold text-gray-900">${donation.address}</p>
                            <p class="text-sm text-gray-600">${donation.city}, ${donation.state} - ${donation.pincode}</p>
                        </div>

                        <div>
                            <p class="text-xs font-bold text-gray-700 uppercase tracking-wide mb-3">Availability</p>
                            <div class="flex flex-wrap gap-2">
                                ${availTags}
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <button onclick="closeDonationModal()" class="w-full py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-lg transition-colors cursor-pointer">
                            Close
                        </button>
                    </div>
                `;

                modalContent.innerHTML = content;
                modal.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            }

            function closeDonationModal() {
                modal.classList.add('hidden');
                document.body.style.overflow = '';
                modalContent.innerHTML =
                    '<div class="flex items-center justify-center py-8"><div class="animate-spin rounded-full h-8 w-8 border-b-2" style="border-color: #c10007;"></div></div>';
            }

            modal.addEventListener('click', function(e) {
                if (e.target === modal || e.target === modal.firstElementChild) {
                    closeDonationModal();
                }
            });

            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
                    closeDonationModal();
                }
            });
        </script>
    @endpush
@endsection
