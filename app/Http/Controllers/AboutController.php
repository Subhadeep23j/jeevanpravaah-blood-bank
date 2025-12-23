<?php

namespace App\Http\Controllers;

use App\Models\Donor;
use App\Models\User;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        // Get statistics from database
        $stats = [
            'lives_saved' => Donor::where('approval_status', 'approved')->count() * 3, // Each donation saves 3 lives
            'active_donors' => Donor::where('approval_status', 'approved')->count(),
            'registered_users' => User::count(),
            'cities' => Donor::where('approval_status', 'approved')
                ->distinct('city')
                ->count('city'),
        ];

        return view('about', compact('stats'));
    }
}
