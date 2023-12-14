<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; 
use Illuminate\Auth\Events\Verified;
class ProfileUserController extends Controller
{
    public function profile()
    {
        $user = auth()->user();
        return view('user.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();
    
        $rules = [
            'name' => 'required|string|max:255',
            'lname' => 'nullable|string|max:255',
            'phone' => 'required|digits_between:8,12',
            'info' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'currentemail' => ['nullable', 'string', 'email'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'currentpassword' => ['nullable', 'string', 'min:8'],            
            'password' => ['required', 'string', 'min:8'],
        ];
    
        $request->validate($rules);
    
        $currentPasswordStatus = Hash::check($request->currentpassword, $user->password);
        $currentEmailStatus = $request->currentemail === $user->email;
    
        if (!$currentPasswordStatus || !$currentEmailStatus) {
            $userData = [
                'name' => $request->name,
                'lname' => $request->lname,
                'phone' => $request->phone,
                'info' => $request->info,
                'email' => $request->currentemail ? $request->currentemail  : $request->email ,
                'password' => Hash::make($request->currentpassword) ? Hash::make($request->currentpassword) : Hash::make($request->password),
            ];
    
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $fileName = time() . rand(1000, 50000) . '.' . $image->getClientOriginalExtension();
                $image->move('upload/user', $fileName);
                
                \Illuminate\Support\Facades\Log::info('Image moved successfully. File name: ' . $fileName);
                
                $imagePath = 'upload/user/' . $fileName;
                $userData['image'] = $imagePath;
            }
            
    
            $user->update($userData);
    
            if ($request->filled('email') && $request->email !== $user->email) {
                $user->sendEmailVerificationNotification();
                event(new Verified($user));
            }
    
            return redirect()->route('user.profile')->with('success', 'Profile updated successfully');
        }
    
        return redirect()->route('user.profile')->with('error', 'Invalid current password or email');
    }
    
}


