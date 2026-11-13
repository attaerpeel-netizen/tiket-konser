<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

/**
 * Manages the profile of the currently authenticated administrator.
 */
class ProfileController extends Controller
{
    /**
     * Display the administrator's profile.
     */
    public function index()
    {
        return view('profile.index', [
            'user' => auth()->user(),
        ]);
    }

    /**
     * Update the administrator's profile in storage.
     */
    public function update(Request $request)
    {
        $user = auth()->user();

        // Validate the input; the email must be unique except for this user.
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'password' => ['nullable', 'confirmed', Password::defaults()],
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];

        // Only change the password when a new one was provided.
        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->route('profile.index')->with('success', 'Profil administrator berhasil diperbarui.');
    }
}
