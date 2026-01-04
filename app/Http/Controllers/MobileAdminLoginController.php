<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class MobileAdminLoginController extends Controller
{
    /**
     * Mobile admin login - Returns API token
     */
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $admin = Admin::where('email', $validated['email'])->first();

        if (!$admin || !Hash::check($validated['password'], $admin->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid email or password'
            ], 401);
        }

        $token = $admin->createToken('mobile-admin-token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Logged in successfully',
            'data' => [
                'admin' => $admin,
                'token' => $token
            ]
        ]);
    }

    /**
     * Mobile admin logout - Revoke token
     */
    public function logout(Request $request)
    {
        if ($request->user()) {
            $request->user()->tokens()->delete();
            return response()->json([
                'success' => true,
                'message' => 'Logged out successfully'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Not authenticated'
        ], 401);
    }

    /**
     * Get admin profile
     */
    public function profile(Request $request)
    {
        $admin = $request->user();

        if (!($admin instanceof Admin)) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 403);
        }

        return response()->json([
            'success' => true,
            'data' => $admin
        ]);
    }
}
