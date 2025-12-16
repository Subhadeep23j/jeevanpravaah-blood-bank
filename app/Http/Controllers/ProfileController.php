<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\EmailOtp;
use App\Mail\OtpMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    /**
     * Display the user's profile.
     */
    public function show()
    {
        return view('user.profile', ['user' => Auth::user()]);
    }

    /**
     * Validate profile data and send OTP for verification.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        // If only the avatar form was submitted, update just the image (no OTP needed)
        if ($request->hasFile('profile_image') && !$request->has('name')) {
            $request->validate([
                'profile_image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            ]);

            if ($user->profile_image_path) {
                Storage::disk('public')->delete($user->profile_image_path);
            }

            $imagePath = $request->file('profile_image')->store('profile_images', 'public');
            $user->profile_image_path = $imagePath;
            $user->save();

            return redirect()->route('profile.show')->with('success', 'Profile image updated successfully!');
        }

        // Full profile update - validate data first
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'phone' => ['nullable', 'string', 'max:15', Rule::unique('users')->ignore($user->id)],
            'aadhar' => ['nullable', 'string', 'max:12', Rule::unique('users')->ignore($user->id)],
            'address' => ['nullable', 'string', 'max:500'],
            'city' => ['nullable', 'string', 'max:100'],
            'pin' => ['nullable', 'string', 'max:6'],
        ]);

        // Store profile update data in session
        Session::put('profile_update_data', $validated);

        // Generate and send OTP to user's current email
        $otpRecord = EmailOtp::generateFor($user->email);

        try {
            Mail::to($user->email)->send(new OtpMail($otpRecord->otp, $user->name));
        } catch (\Exception $e) {
            Log::error('Profile Update OTP Email Error: ' . $e->getMessage());
            return back()->withErrors(['email' => 'Failed to send OTP email: ' . $e->getMessage()])->withInput();
        }

        return redirect()->route('profile.verify.otp.form')
            ->with('success', 'OTP sent to ' . $user->email . '. Please verify to update your profile.');
    }

    /**
     * Show OTP verification form for profile update.
     */
    public function showVerifyOtpForm()
    {
        if (!Session::has('profile_update_data')) {
            return redirect()->route('profile.show')
                ->withErrors(['error' => 'No pending profile update. Please submit the form first.']);
        }

        $user = Auth::user();
        return view('user.verify-profile-otp', ['email' => $user->email]);
    }

    /**
     * Verify OTP and update profile.
     */
    public function verifyOtpAndUpdate(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6',
        ]);

        if (!Session::has('profile_update_data')) {
            return redirect()->route('profile.show')
                ->withErrors(['error' => 'Session expired. Please submit the profile update form again.']);
        }

        $user = Auth::user();
        $profileData = Session::get('profile_update_data');

        // Find the OTP record
        $otpRecord = EmailOtp::where('email', $user->email)
            ->where('verified', false)
            ->latest()
            ->first();

        if (!$otpRecord) {
            return back()->withErrors(['otp' => 'No OTP found. Please request a new one.']);
        }

        if ($otpRecord->isExpired()) {
            return back()->withErrors(['otp' => 'OTP has expired. Please request a new one.']);
        }

        if ($otpRecord->otp !== $request->otp) {
            return back()->withErrors(['otp' => 'Invalid OTP. Please try again.']);
        }

        // Mark OTP as verified
        $otpRecord->update(['verified' => true]);

        // Update the user profile
        $user->update($profileData);

        // Clear session data
        Session::forget('profile_update_data');

        return redirect()->route('profile.show')
            ->with('success', 'Profile updated successfully!');
    }

    /**
     * Resend OTP for profile update.
     */
    public function resendProfileOtp()
    {
        if (!Session::has('profile_update_data')) {
            return redirect()->route('profile.show')
                ->withErrors(['error' => 'No pending profile update. Please submit the form first.']);
        }

        $user = Auth::user();

        // Generate new OTP
        $otpRecord = EmailOtp::generateFor($user->email);

        try {
            Mail::to($user->email)->send(new OtpMail($otpRecord->otp, $user->name));
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to resend OTP. Please try again.']);
        }

        return back()->with('success', 'New OTP sent to ' . $user->email);
    }

    /**
     * Update the user's password.
     */
    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if (!Hash::check($validated['current_password'], Auth::user()->password)) {
            return back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        Auth::user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('profile.show')->with('success', 'Password updated successfully!');
    }

    /**
     * Initiate account deletion - verify password and send OTP.
     */
    public function initiateDestroy(Request $request)
    {
        $request->validate([
            'password' => ['required'],
        ]);

        $user = Auth::user();

        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'The password is incorrect.']);
        }

        // Mark that deletion has been initiated
        Session::put('account_deletion_initiated', true);

        // Generate and send OTP to user's email
        $otpRecord = EmailOtp::generateFor($user->email);

        try {
            Mail::to($user->email)->send(new OtpMail($otpRecord->otp, $user->name));
        } catch (\Exception $e) {
            Log::error('Account Deletion OTP Email Error: ' . $e->getMessage());
            return back()->withErrors(['email' => 'Failed to send OTP email: ' . $e->getMessage()]);
        }

        return redirect()->route('profile.delete.otp.form')
            ->with('success', 'OTP sent to ' . $user->email . '. Please verify to delete your account.');
    }

    /**
     * Show OTP verification form for account deletion.
     */
    public function showDeleteOtpForm()
    {
        if (!Session::has('account_deletion_initiated')) {
            return redirect()->route('profile.show')
                ->withErrors(['error' => 'Please initiate account deletion first.']);
        }

        $user = Auth::user();
        return view('user.verify-delete-otp', ['email' => $user->email]);
    }

    /**
     * Verify OTP and delete account.
     */
    public function verifyOtpAndDestroy(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6',
        ]);

        if (!Session::has('account_deletion_initiated')) {
            return redirect()->route('profile.show')
                ->withErrors(['error' => 'Session expired. Please initiate account deletion again.']);
        }

        $user = Auth::user();

        // Find the OTP record
        $otpRecord = EmailOtp::where('email', $user->email)
            ->where('verified', false)
            ->latest()
            ->first();

        if (!$otpRecord) {
            return back()->withErrors(['otp' => 'No OTP found. Please request a new one.']);
        }

        if ($otpRecord->isExpired()) {
            return back()->withErrors(['otp' => 'OTP has expired. Please request a new one.']);
        }

        if ($otpRecord->otp !== $request->otp) {
            return back()->withErrors(['otp' => 'Invalid OTP. Please try again.']);
        }

        // Mark OTP as verified
        $otpRecord->update(['verified' => true]);

        // Clear session data
        Session::forget('account_deletion_initiated');

        // Delete profile image if exists
        if ($user->profile_image_path) {
            Storage::disk('public')->delete($user->profile_image_path);
        }

        // Logout the user
        Auth::logout();

        // Delete the user
        $user->delete();

        // Invalidate session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Your account has been deleted successfully.');
    }

    /**
     * Resend OTP for account deletion.
     */
    public function resendDeleteOtp()
    {
        if (!Session::has('account_deletion_initiated')) {
            return redirect()->route('profile.show')
                ->withErrors(['error' => 'Please initiate account deletion first.']);
        }

        $user = Auth::user();

        // Generate new OTP
        $otpRecord = EmailOtp::generateFor($user->email);

        try {
            Mail::to($user->email)->send(new OtpMail($otpRecord->otp, $user->name));
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to resend OTP. Please try again.']);
        }

        return back()->with('success', 'New OTP sent to ' . $user->email);
    }

    public function allblog()
    {
        $data = User::all();
        return response()->json(['status' => true, 'data' =>  $data]);
        return response()->json(['status' => false, 'data' =>  null]);
    }
}
