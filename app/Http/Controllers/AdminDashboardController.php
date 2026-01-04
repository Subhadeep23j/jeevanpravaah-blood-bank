<?php

namespace App\Http\Controllers;

use App\Models\Donor;
use App\Models\User;
use App\Models\BloodRequest;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Get comprehensive statistics
        $stats = [
            'total_donors' => Donor::count(),
            'approved_donors' => Donor::where('approval_status', 'approved')->count(),
            'pending_requests' => Donor::where('approval_status', 'pending')->count(),
            'rejected_donors' => Donor::where('approval_status', 'rejected')->count(),
            'total_users' => User::count(),
            'today_donors' => Donor::whereDate('created_at', today())->count(),
            'this_month_donors' => Donor::whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->count(),
            'this_week_donors' => Donor::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count(),
            'total_blood_requests' => BloodRequest::count(),
            'pending_blood_requests' => BloodRequest::where('status', 'pending')->count(),
        ];

        // Calculate growth percentages
        $lastMonthDonors = Donor::whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', now()->subMonth()->year)
            ->count();
        $stats['monthly_growth'] = $lastMonthDonors > 0
            ? round((($stats['this_month_donors'] - $lastMonthDonors) / $lastMonthDonors) * 100, 1)
            : ($stats['this_month_donors'] > 0 ? 100 : 0);

        // Blood group distribution
        $bloodGroupStats = Donor::selectRaw('blood_group, COUNT(*) as count')
            ->groupBy('blood_group')
            ->pluck('count', 'blood_group')
            ->toArray();

        // Recent donations (latest 5)
        $recentDonations = Donor::with('user')
            ->latest()
            ->take(5)
            ->get();

        // City-wise distribution
        $cityStats = Donor::selectRaw('city, COUNT(*) as count')
            ->groupBy('city')
            ->orderByDesc('count')
            ->take(5)
            ->pluck('count', 'city')
            ->toArray();

        return view('admin.admin-dashboard', compact('stats', 'bloodGroupStats', 'recentDonations', 'cityStats'));
    }

    public function donors()
    {
        // Get all donors with pagination
        $donors = Donor::with('user')->latest()->paginate(10);

        // Get statistics for the donors page
        $stats = [
            'total_donors' => Donor::count(),
            'today_donors' => Donor::whereDate('created_at', today())->count(),
            'this_month_donors' => Donor::whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->count(),
            'unique_users' => Donor::distinct('user_id')->count('user_id'),
            'approved_count' => Donor::where('approval_status', 'approved')->count(),
            'pending_count' => Donor::where('approval_status', 'pending')->count(),
            'rejected_count' => Donor::where('approval_status', 'rejected')->count(),
        ];

        // Blood group distribution
        $bloodGroupStats = Donor::selectRaw('blood_group, COUNT(*) as count')
            ->groupBy('blood_group')
            ->pluck('count', 'blood_group')
            ->toArray();

        return view('admin.donors', compact('donors', 'stats', 'bloodGroupStats'));
    }

    public function bloodInventory()
    {
        // Get all blood stocks
        $bloodStocks = \App\Models\BloodStock::all();

        // Get approved donor count by blood type
        $bloodTypeStats = Donor::where('approval_status', 'approved')
            ->selectRaw('blood_group, COUNT(*) as count')
            ->groupBy('blood_group')
            ->pluck('count', 'blood_group')
            ->toArray();

        // Map blood types to stats
        $bloodStockData = $bloodStocks->map(function ($stock) use ($bloodTypeStats) {
            return [
                'blood_type' => $stock->blood_type,
                'units_available' => $stock->units_available,
                'units_reserved' => $stock->units_reserved,
                'actual_available' => $stock->actual_available,
                'status' => $stock->stock_status,
                'approved_donors' => $bloodTypeStats[$stock->blood_type] ?? 0,
            ];
        })->toArray();

        // Calculate totals
        $totals = [
            'total_units' => array_sum(array_column($bloodStockData, 'units_available')),
            'total_reserved' => array_sum(array_column($bloodStockData, 'units_reserved')),
            'total_available' => array_sum(array_column($bloodStockData, 'actual_available')),
            'total_approved_donors' => Donor::where('approval_status', 'approved')->count(),
        ];

        return view('admin.blood-inventory', compact('bloodStockData', 'totals'));
    }

    public function addBloodStock(Request $request)
    {
        $validated = $request->validate([
            'blood_type' => 'required|string|in:A+,A-,B+,B-,O+,O-,AB+,AB-',
            'units' => 'required|integer|min:1|max:1000',
            'notes' => 'nullable|string|max:255'
        ]);

        try {
            $bloodStock = \App\Models\BloodStock::where('blood_type', $validated['blood_type'])->first();

            if (!$bloodStock) {
                return response()->json([
                    'success' => false,
                    'message' => 'Blood type not found'
                ], 404);
            }

            // Update blood stock
            $bloodStock->units_available += $validated['units'];
            $bloodStock->save();

            // Log the transaction if needed
            if ($validated['notes']) {
                // You can add a log model here
            }

            return response()->json([
                'success' => true,
                'message' => "Successfully added {$validated['units']} units of {$validated['blood_type']} blood",
                'data' => [
                    'blood_type' => $bloodStock->blood_type,
                    'units_available' => $bloodStock->units_available,
                    'actual_available' => $bloodStock->actual_available
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error adding blood stock: ' . $e->getMessage()
            ], 500);
        }
    }

    public function requests()
    {
        // Get all blood requests with pagination
        $bloodRequests = BloodRequest::with('user')
            ->latest()
            ->paginate(10);

        // Get statistics for the requests page
        $stats = [
            'total_requests' => BloodRequest::count(),
            'pending_requests' => BloodRequest::where('status', 'pending')->count(),
            'approved_requests' => BloodRequest::where('status', 'approved')->count(),
            'fulfilled_requests' => BloodRequest::where('status', 'fulfilled')->count(),
            'cancelled_requests' => BloodRequest::where('status', 'cancelled')->count(),
            'today_requests' => BloodRequest::whereDate('created_at', today())->count(),
            'this_month_requests' => BloodRequest::whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->count(),
            'critical_requests' => BloodRequest::where('urgency', 'critical')->where('status', '!=', 'fulfilled')->count(),
        ];

        // Blood type distribution for requests
        $bloodTypeStats = BloodRequest::selectRaw('blood_type, COUNT(*) as count')
            ->groupBy('blood_type')
            ->pluck('count', 'blood_type')
            ->toArray();

        return view('admin.requests', compact('bloodRequests', 'stats', 'bloodTypeStats'));
    }
}
