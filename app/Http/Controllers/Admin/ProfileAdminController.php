<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
class ProfileAdminController extends Controller
{
    public function adminprofile()
    {
        $admin = auth()->user();
        return view('admin.profile',compact('admin'));
    }

    public function adminprofileupdate(Request $request)
{
   $admin = auth()->user();

    // Validate the form data
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $admin->id,
        'password' => 'nullable|string|min:8',
    ]);

    $admin->name = $request->input('name');
    $admin->email = $request->input('email');

    if ($request->filled('password')) {
        $admin->password = bcrypt($request->input('password'));
    }

    $admin->save();

    return redirect()->route('admin.profile')->with('success', 'Profile updated successfully');
}
}
