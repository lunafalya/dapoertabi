<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
 public function show()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('editprofile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        try { 
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Update data dasar
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;

        // Update foto jika ada upload
        if ($request->hasFile('profile_photo')) {
            $path = $request->file('profile_photo')->store('profiles', 'public');
            $user->profile_photo = $path;
        }

        $user->save();

            return redirect()->route('profile.show')->with('success', 'Update Profile successful!');
    } catch (\Exception $e) { // ⬅️ Penting! Harus ada \Exception $e
        return redirect()->route('profile.show')->with('error', 'Update Profile failed, please try again.');
    }

}

}
