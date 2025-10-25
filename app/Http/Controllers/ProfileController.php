<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
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
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        // If only the avatar form was submitted, update just the image
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

        // Full profile update
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'phone' => ['nullable', 'string', 'max:15', Rule::unique('users')->ignore($user->id)],
            'aadhar' => ['nullable', 'string', 'max:12', Rule::unique('users')->ignore($user->id)],
            'address' => ['nullable', 'string', 'max:500'],
            'city' => ['nullable', 'string', 'max:100'],
            'pin' => ['nullable', 'string', 'max:6'],
            'profile_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        if ($request->hasFile('profile_image')) {
            if ($user->profile_image_path) {
                Storage::disk('public')->delete($user->profile_image_path);
            }
            $imagePath = $request->file('profile_image')->store('profile_images', 'public');
            $validated['profile_image_path'] = $imagePath;
        }

        $user->update($validated);

        return redirect()->route('profile.show')->with('success', 'Profile updated successfully!');
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
}
