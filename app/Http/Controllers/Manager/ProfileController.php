<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller
{
    public function profile()
    {
        $owner = auth()->user();
        return view('manager.profile', compact('owner'));
    }

// ProfileController.php

public function updateprofile(Request $request)
{
   $owner = auth()->user();

    // Validate the form data
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $owner->id,
        'password' => 'nullable|string|min:8',
    ]);

    // Update user data
    $owner->name = $request->input('name');
    $owner->email = $request->input('email');

    if ($request->filled('password')) {
        $owner->password = bcrypt($request->input('password'));
    }

    $owner->save();

    return redirect()->route('manager.profile')->with('success', 'Profile updated successfully');
}

}
