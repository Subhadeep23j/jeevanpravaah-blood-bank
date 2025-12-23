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

    public function bulkAction(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:donors,id',
            'action' => 'required|in:approve,reject,reset',
            'reason' => 'nullable|string|max:500',
        ]);

        $ids = $request->ids;
        $action = $request->action;
        $adminId = Auth::guard('admin')->id();
        $count = count($ids);

        switch ($action) {
            case 'approve':
                Donor::whereIn('id', $ids)->update([
                    'approval_status' => 'approved',
                    'approved_at' => now(),
                    'approved_by' => $adminId,
                    'rejection_reason' => null,
                ]);
                $message = "$count donor(s) approved successfully!";
                break;

            case 'reject':
                Donor::whereIn('id', $ids)->update([
                    'approval_status' => 'rejected',
                    'approved_at' => now(),
                    'approved_by' => $adminId,
                    'rejection_reason' => $request->reason ?? 'Bulk rejection',
                ]);
                $message = "$count donor(s) rejected successfully!";
                break;

            case 'reset':
                Donor::whereIn('id', $ids)->update([
                    'approval_status' => 'pending',
                    'approved_at' => null,
                    'approved_by' => null,
                    'rejection_reason' => null,
                ]);
                $message = "$count donor(s) reset to pending!";
                break;

            default:
                return response()->json(['success' => false, 'message' => 'Invalid action'], 400);
        }

        return response()->json(['success' => true, 'message' => $message]);
    }
}
