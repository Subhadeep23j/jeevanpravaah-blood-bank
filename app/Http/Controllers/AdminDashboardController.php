<?php

namespace App\Http\Controllers;

use App\Models\Donor;
use App\Models\User;
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
}
