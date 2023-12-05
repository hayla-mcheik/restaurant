<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\ApproveEmailNotification;
use App\Rules\GmailDomain;
class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function status(Request $request)
{
    return $request->user()->status;
}

public function authenticated(Request $request, $user)
{
    $request->validate([
        'email' => ['required', 'email', 'unique:users,email', new GmailDomain],
        'password' => 'required',
    ], [
        'email.required' => 'Please enter your email address',
        'password.required' => 'Please enter your password',
    ]);

    if ($user->role_as == '3') {
        if ($user->status == 'active') {
            return redirect('user/dashboard')->with('message', 'Welcome to Dashboard');
        } else {
            auth()->logout();
            
        Mail::to($user->email)->send(new ApproveEmailNotification($user->name));
            return back()->with('status', 'Your account is not yet active. Please wait for admin approval.');
        }
    } 
    else if ($user->role_as == '2') {
        if ($user->status == 'active') {
            return redirect('manager/dashboard')->with('message', 'Welcome to Dashboard');
        } else {
            auth()->logout();
            
        Mail::to($user->email)->send(new ApproveEmailNotification($user->name));
            return back()->with('status', 'Your account is not yet active. Please wait for admin approval.');
        }
    } 
    else if ($user->role_as == '1') {
        if ($user->status == 'active') {
       \Log::info('Role as : status' );

            return redirect('admin/dashboard')->with('message', 'Welcome to Dashboard');
        } else {
            auth()->logout();
            
        Mail::to($user->email)->send(new ApproveEmailNotification($user->name));
        toastr()->error('Your account is not yet active. Please wait for admin approval.');

        }
    } 
    else {
        return back()->withErrors('Login details are not valid.');
    }
}

}
