<?php

namespace App\Http\Controllers;

use App\Models\Donor;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Get statistics from database
        $stats = [
            'lives_saved' => Donor::where('approval_status', 'approved')->sum('user_id') > 0
                ? Donor::where('approval_status', 'approved')->count() * 3
                : 0, // Each donation can save up to 3 lives
            'active_donors' => Donor::where('approval_status', 'approved')->count(),
            'registered_users' => User::count(),
            'cities' => Donor::where('approval_status', 'approved')
                ->distinct('city')
                ->count('city'),
            'pending_requests' => Donor::where('approval_status', 'pending')->count(),
        ];

        // Get blood group statistics
        $bloodGroupStats = Donor::where('approval_status', 'approved')
            ->selectRaw('blood_group, COUNT(*) as count')
            ->groupBy('blood_group')
            ->pluck('count', 'blood_group')
            ->toArray();

        // Find the blood group with lowest availability (for emergency shortage display)
        $shortageBloodGroup = null;
        if (!empty($bloodGroupStats)) {
            $shortageBloodGroup = array_search(min($bloodGroupStats), $bloodGroupStats);
        }

        return view('welcome', compact('stats', 'bloodGroupStats', 'shortageBloodGroup'));
    }
}
