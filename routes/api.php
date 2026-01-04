<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Donor;
use App\Models\User;
use App\Http\Controllers\MobileAdminLoginController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Mobile Admin Authentication (Public)
Route::prefix('v1')->group(function () {
    Route::post('/admin/login', [MobileAdminLoginController::class, 'login']);
    Route::post('/admin/logout', [MobileAdminLoginController::class, 'logout'])->middleware('auth:sanctum');
    Route::get('/admin/profile', [MobileAdminLoginController::class, 'profile'])->middleware('auth:sanctum');
});

// Public API Routes
Route::prefix('v1')->group(function () {

    // Get all approved donors (public)
    Route::get('/donors', function () {
        $donors = Donor::where('approval_status', 'approved')
            ->select('id', 'first_name', 'last_name', 'blood_group', 'city', 'state', 'availability')
            ->get();
        return response()->json([
            'success' => true,
            'data' => $donors,
            'count' => $donors->count()
        ]);
    });

    // Search donors by blood group
    Route::get('/donors/search', function (Request $request) {
        $query = Donor::where('approval_status', 'approved');

        if ($request->has('blood_group')) {
            $query->where('blood_group', $request->blood_group);
        }
        if ($request->has('city')) {
            $query->where('city', 'like', '%' . $request->city . '%');
        }
        if ($request->has('state')) {
            $query->where('state', 'like', '%' . $request->state . '%');
        }

        $donors = $query->select('id', 'first_name', 'last_name', 'blood_group', 'city', 'state', 'availability')->get();

        return response()->json([
            'success' => true,
            'data' => $donors,
            'count' => $donors->count()
        ]);
    });

    // Get blood group statistics
    Route::get('/statistics', function () {
        $stats = Donor::where('approval_status', 'approved')
            ->selectRaw('blood_group, COUNT(*) as count')
            ->groupBy('blood_group')
            ->get();

        $total = Donor::where('approval_status', 'approved')->count();

        return response()->json([
            'success' => true,
            'data' => [
                'by_blood_group' => $stats,
                'total_donors' => $total
            ]
        ]);
    });
});

// Protected API Routes (require authentication)
Route::prefix('v1')->middleware('auth:sanctum')->group(function () {

    // Get authenticated user
    Route::get('/user', function (Request $request) {
        return response()->json([
            'success' => true,
            'data' => $request->user()
        ]);
    });

    // Get user's donation history
    Route::get('/user/donations', function (Request $request) {
        $donations = Donor::where('user_id', $request->user()->id)
            ->orWhere('email', $request->user()->email)
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'data' => $donations,
            'count' => $donations->count()
        ]);
    });

    // Register as donor
    Route::post('/donors/register', function (Request $request) {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string',
            'date_of_birth' => 'required|date',
            'gender' => 'required|string',
            'blood_group' => 'required|string',
            'weight' => 'required|numeric|min:45',
            'height' => 'required|numeric',
            'address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'pincode' => 'required|string',
            'availability' => 'nullable|array',
            'travel_distance' => 'nullable|numeric',
            'medical_conditions' => 'nullable|string',
            'consent_medical' => 'required|boolean',
            'consent_contact' => 'required|boolean',
            'consent_privacy' => 'required|boolean',
        ]);

        $validated['user_id'] = $request->user()->id;
        $validated['approval_status'] = 'pending';

        $donor = Donor::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Donor registration submitted successfully',
            'data' => $donor
        ], 201);
    });
});
