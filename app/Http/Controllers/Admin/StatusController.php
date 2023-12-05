<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
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
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = $request->input('password');
        $user->status = $request->input('status');
        $user->update();
        return back()->with('message','user Status Updated Successfully');
    }

public function delete($id)
{
    $user = User::find($id);

    if ($user) {
        $user->delete();
        return redirect()->route('admin.status.users')->with('message', 'User deleted successfully');
    } else {
        return redirect()->route('admin.status.users')->with('error', 'User not found');
    }
}

}
