<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegisterForm()
    {
        // Redirect if already logged in
        if (Auth::check()) {
            return redirect('/');
        }

        return view('auth.register');
    }

    public function register(Request $req)
    {
        $validatedData = $req->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|digits:10|unique:users,phone',
            'aadhar' => 'required|digits:12|unique:users,aadhar',
            'address' => 'required',
            'city' => 'required',
            'pin' => 'required|digits:6',
            'password' => 'required|confirmed', // min:6|
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        // Hash the password before creating user
        $validatedData['password'] = Hash::make($validatedData['password']);

        // Handle profile image upload if present
        if ($req->hasFile('profile_image')) {
            $path = $req->file('profile_image')->store('profile-images', 'public');
            $validatedData['profile_image_path'] = $path; // stored relative to storage/app/public
        }

        $user = User::create($validatedData);

        // Automatically log in the user after registration
        Auth::login($user);

        // Redirect to home page (welcome page with authenticated header)
        return redirect('/')
            ->with('success', 'Welcome to JeevanPravaah, ' . $user->name . '! Your account has been created successfully.');
    }
}
