<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\AccountActivatedNotification; 
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

class StatusController extends Controller
{
    public function index()
    {
        $user = User::where('role_as', '2')
        ->orWhere('role_as', '3')
        ->get();
        return view('admin.status.status-user',compact('user'));
    }

    public function edit($id)
    {
        $user = User::find($id);   
        return view('admin.status.edit',compact('user'));
    }


    public function update(Request $request, $id)
    {
        $user = User::find($id);
    
        if (!$user) {
            return redirect()->route('admin.status.users')->with('error', 'User not found');
        }
    
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:8',
            'status' => 'required|in:pending,active',
        ]);
    
        $previousStatus = $user->status;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->status = $request->input('status');
        $user->update();
    
        if ($previousStatus === 'pending' && $user->status === 'active') {
            Mail::to($user->email)->send(new AccountActivatedNotification($user->name));
        }
    
        return redirect()->route('admin.status.users')->with('success', 'User Status Updated Successfully');
    }
    

public function delete($id)
{
    $user = User::find($id);

    if ($user) {
        $user->delete();
        return redirect()->route('admin.status.users')->with('success', 'User deleted successfully');
    } else {
        return redirect()->route('admin.status.users')->with('error', 'User not found');
    }
}

}
