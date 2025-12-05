<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donor;
use Illuminate\Support\Facades\Auth;

class AdminDonorController extends Controller
{
    public function approve($id)
    {
        $donor = Donor::findOrFail($id);

        $donor->update([
            'approval_status' => 'approved',
            'approved_at' => now(),
            'approved_by' => Auth::guard('admin')->id(),
            'rejection_reason' => null,
        ]);

        return redirect()->back()->with('success', 'Donor approved successfully!');
    }

    public function reject(Request $request, $id)
    {
        $request->validate([
            'rejection_reason' => 'required|string|max:500',
        ]);

        $donor = Donor::findOrFail($id);

        $donor->update([
            'approval_status' => 'rejected',
            'approved_at' => now(),
            'approved_by' => Auth::guard('admin')->id(),
            'rejection_reason' => $request->rejection_reason,
        ]);

        return redirect()->back()->with('success', 'Donor rejected successfully!');
    }

    public function resetStatus($id)
    {
        $donor = Donor::findOrFail($id);

        $donor->update([
            'approval_status' => 'pending',
            'approved_at' => null,
            'approved_by' => null,
            'rejection_reason' => null,
        ]);

        return redirect()->back()->with('success', 'Donor status reset to pending!');
    }
}
