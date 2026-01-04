<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BloodRequest;
use App\Models\BloodStock;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BloodRequestController extends Controller
{
    /**
     * Show the blood request form.
     */
    public function showForm()
    {
        $bloodStocks = BloodStock::getAllStocks();
        return view('request', compact('bloodStocks'));
    }

    /**
     * Store a new blood request.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'hospital_name' => 'required|string|max:255',
            'blood_type' => 'required|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
            'doctor_prescription' => 'required|image|mimes:jpeg,png,jpg|max:5120',
            'units_required' => 'required|integer|min:1|max:10',
            'urgency' => 'required|in:normal,urgent,critical',
        ]);

        // Handle prescription image upload
        $prescriptionPath = null;
        if ($request->hasFile('doctor_prescription')) {
            $prescriptionPath = $request->file('doctor_prescription')->store('prescriptions', 'public');
        }

        $bloodRequest = BloodRequest::create([
            'user_id' => Auth::id(),
            'patient_name' => $validated['patient_name'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'hospital_name' => $validated['hospital_name'],
            'blood_type' => $validated['blood_type'],
            'doctor_prescription' => $prescriptionPath,
            'units_required' => $validated['units_required'],
            'urgency' => $validated['urgency'],
            'status' => 'pending',
        ]);

        return redirect()->route('blood.request')->with('success', 'Your blood request has been submitted successfully! We will contact you shortly.');
    }
}
