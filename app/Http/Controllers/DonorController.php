<?php

namespace App\Http\Controllers;

use App\Models\Donor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DonorController extends Controller
{
    /**
     * Show the donation form with dynamic stats
     */
    public function showForm()
    {
        // Get statistics for the donate page
        $stats = [
            'lives_saved' => Donor::where('approval_status', 'approved')->count() * 3,
            'active_donors' => Donor::where('approval_status', 'approved')->count(),
            'registered_users' => User::count(),
        ];

        // Blood group availability
        $bloodGroupStats = Donor::where('approval_status', 'approved')
            ->selectRaw('blood_group, COUNT(*) as count')
            ->groupBy('blood_group')
            ->pluck('count', 'blood_group')
            ->toArray();

        return view('donate', compact('stats', 'bloodGroupStats'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            // Personal
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'date_of_birth' => ['required', 'date'],
            'gender' => ['required', 'in:male,female,other'],

            // Medical
            'blood_group' => ['required', 'in:A+,A-,B+,B-,O+,O-,AB+,AB-'],
            'weight' => ['required', 'integer', 'min:45', 'max:400'],
            'height' => ['required', 'integer', 'min:100', 'max:300'],
            'medical_conditions' => ['nullable', 'string'],

            // Location & Availability
            'address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:120'],
            'state' => ['required', 'string', 'max:120'],
            'pincode' => ['required', 'digits:6'],
            'availability' => ['nullable', 'array'],
            'availability.*' => ['string'],
            'travel_distance' => ['required', 'in:5,10,20,50,unlimited'],

            // Consents
            'consent_medical' => ['accepted'],
            'consent_contact' => ['accepted'],
            'consent_privacy' => ['accepted'],
        ]);

        // Normalize fields for DB
        $validated['availability'] = $request->input('availability', []);
        $validated['consent_medical'] = $request->boolean('consent_medical');
        $validated['consent_contact'] = $request->boolean('consent_contact');
        $validated['consent_privacy'] = $request->boolean('consent_privacy');

        // Always trust the authenticated user's email
        if ($request->user()) {
            $validated['email'] = $request->user()->email;
        }

        DB::transaction(function () use ($request, $validated) {
            $validated['user_id'] = $request->user()->id;
            $donor = Donor::create($validated);

            // Increment the user's donations_count atomically
            $request->user()->increment('donations_count');
        });

        return redirect()->route('donate')
            ->with('success', 'Thank you for registering as a donor!');
    }
}
