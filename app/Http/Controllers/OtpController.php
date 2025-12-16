<?php

namespace App\Http\Controllers;

use App\Models\EmailOtp;
use App\Models\User;
use App\Mail\OtpMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class OtpController extends Controller
{
    /**
     * Step 1: Show registration form (collects all data)
     */
    public function showRegisterForm()
    {
        if (Auth::check()) {
            return redirect('/');
        }
        return view('auth.register');
    }

    /**
     * Step 2: Validate registration data and send OTP
     */
    public function sendOtp(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|digits:10|unique:users,phone',
            'aadhar' => 'required|digits:12|unique:users,aadhar',
            'address' => 'required|string',
            'city' => 'required|string',
            'pin' => 'required|digits:6',
            'password' => 'required|confirmed|min:6',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg,bmp|max:2048'
        ]);

        // Store registration data in session (except password for security)
        $sessionData = [
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'aadhar' => $validatedData['aadhar'],
            'address' => $validatedData['address'],
            'city' => $validatedData['city'],
            'pin' => $validatedData['pin'],
            'password_hash' => Hash::make($validatedData['password']),
        ];

        // Handle profile image - store file and save path only
        if ($request->hasFile('profile_image')) {
            $path = $request->file('profile_image')->store('profile-images', 'public');
            $sessionData['profile_image_path'] = $path;
        }

        Session::put('registration_data', $sessionData);

        // Generate and send OTP
        $otpRecord = EmailOtp::generateFor($validatedData['email']);

        try {
            Mail::to($validatedData['email'])->send(new OtpMail($otpRecord->otp, $validatedData['name']));
        } catch (\Exception $e) {
            Log::error('OTP Email Error: ' . $e->getMessage());
            return back()->withErrors(['email' => 'Failed to send OTP email: ' . $e->getMessage()])->withInput();
        }

        return redirect()->route('otp.verify.form')
            ->with('success', 'OTP sent to ' . $validatedData['email'] . '. Please check your inbox.');
    }

    /**
     * Step 3: Show OTP verification form
     */
    public function showVerifyForm()
    {
        if (!Session::has('registration_data')) {
            return redirect()->route('register')
                ->withErrors(['error' => 'Please complete registration form first.']);
        }

        $email = Session::get('registration_data')['email'];
        return view('auth.verify-otp', compact('email'));
    }

    /**
     * Step 4: Verify OTP and create user
     */
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6',
        ]);

        if (!Session::has('registration_data')) {
            return redirect()->route('register')
                ->withErrors(['error' => 'Session expired. Please register again.']);
        }

        $registrationData = Session::get('registration_data');
        $email = $registrationData['email'];

        // Find the OTP record
        $otpRecord = EmailOtp::where('email', $email)
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

        // Create the user
        $user = User::create([
            'name' => $registrationData['name'],
            'email' => $registrationData['email'],
            'phone' => $registrationData['phone'],
            'aadhar' => $registrationData['aadhar'],
            'address' => $registrationData['address'],
            'city' => $registrationData['city'],
            'pin' => $registrationData['pin'],
            'password' => $registrationData['password_hash'],
            'profile_image_path' => $registrationData['profile_image_path'] ?? null,
            'email_verified_at' => now(),
        ]);

        // Clear session data
        Session::forget('registration_data');

        // Log in the user
        Auth::login($user);

        return redirect('/')
            ->with('success', 'Welcome to JeevanPravaah, ' . $user->name . '! Your email has been verified.');
    }

    /**
     * Resend OTP
     */
    public function resendOtp()
    {
        if (!Session::has('registration_data')) {
            return redirect()->route('register')
                ->withErrors(['error' => 'Session expired. Please register again.']);
        }

        $registrationData = Session::get('registration_data');
        $email = $registrationData['email'];
        $name = $registrationData['name'];

        // Generate new OTP
        $otpRecord = EmailOtp::generateFor($email);

        try {
            Mail::to($email)->send(new OtpMail($otpRecord->otp, $name));
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to resend OTP. Please try again.']);
        }

        return back()->with('success', 'New OTP sent to ' . $email);
    }
}
