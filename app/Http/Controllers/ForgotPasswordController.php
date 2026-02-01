<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\EmailOtp;
use App\Mail\OtpMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class ForgotPasswordController extends Controller
{
    /**
     * Show the forgot password form
     */
    public function showForgotForm()
    {
        return view('auth.forgot-password');
    }

    /**
     * Send OTP to email for password reset
     */
    public function sendResetOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ], [
            'email.exists' => 'No account found with this email address.',
        ]);

        $user = User::where('email', $request->email)->first();

        // Generate OTP
        $otpRecord = EmailOtp::generateFor($request->email);

        try {
            Mail::to($request->email)->send(new OtpMail($otpRecord->otp, $user->name));
        } catch (\Exception $e) {
            Log::error('Password Reset OTP Email Error: ' . $e->getMessage());
            return back()->withErrors(['email' => 'Failed to send OTP email. Please try again.'])->withInput();
        }

        // Store email in session for verification
        Session::put('password_reset_email', $request->email);

        return redirect()->route('password.verify.otp.form')
            ->with('success', 'OTP sent to ' . $request->email . '. Please check your inbox.');
    }

    /**
     * Show OTP verification form
     */
    public function showVerifyOtpForm()
    {
        if (!Session::has('password_reset_email')) {
            return redirect()->route('password.request')
                ->withErrors(['error' => 'Please enter your email first.']);
        }

        return view('auth.verify-reset-otp', [
            'email' => Session::get('password_reset_email')
        ]);
    }

    /**
     * Verify OTP and show reset password form
     */
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6',
        ]);

        $email = Session::get('password_reset_email');

        if (!$email) {
            return redirect()->route('password.request')
                ->withErrors(['error' => 'Session expired. Please try again.']);
        }

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

        // Set session flag for password reset
        Session::put('password_reset_verified', true);

        return redirect()->route('password.reset.form');
    }

    /**
     * Show reset password form
     */
    public function showResetForm()
    {
        if (!Session::has('password_reset_verified') || !Session::has('password_reset_email')) {
            return redirect()->route('password.request')
                ->withErrors(['error' => 'Please verify your email first.']);
        }

        return view('auth.reset-password', [
            'email' => Session::get('password_reset_email')
        ]);
    }

    /**
     * Reset the password
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $email = Session::get('password_reset_email');

        if (!$email || !Session::has('password_reset_verified')) {
            return redirect()->route('password.request')
                ->withErrors(['error' => 'Session expired. Please try again.']);
        }

        $user = User::where('email', $email)->first();

        if (!$user) {
            return redirect()->route('password.request')
                ->withErrors(['error' => 'User not found.']);
        }

        // Update password
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        // Clear session data
        Session::forget(['password_reset_email', 'password_reset_verified']);

        return redirect()->route('login')
            ->with('success', 'Password reset successfully! Please login with your new password.');
    }

    /**
     * Resend OTP
     */
    public function resendOtp()
    {
        $email = Session::get('password_reset_email');

        if (!$email) {
            return redirect()->route('password.request')
                ->withErrors(['error' => 'Please enter your email first.']);
        }

        $user = User::where('email', $email)->first();

        if (!$user) {
            return redirect()->route('password.request')
                ->withErrors(['error' => 'User not found.']);
        }

        // Generate new OTP
        $otpRecord = EmailOtp::generateFor($email);

        try {
            Mail::to($email)->send(new OtpMail($otpRecord->otp, $user->name));
        } catch (\Exception $e) {
            Log::error('Password Reset Resend OTP Error: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Failed to resend OTP. Please try again.']);
        }

        return back()->with('success', 'New OTP sent to ' . $email);
    }
}
