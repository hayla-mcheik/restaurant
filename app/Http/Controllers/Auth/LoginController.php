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

    \Log::info('Role_as: ' . $user->role_as);
    if ($user->role_as == '3') {
        \Log::info('Role_as is 3');
        if (!$user->hasVerifiedEmail()) {
            auth()->logout();
            return back()->with('status', 'Your email is not verified. Please check your email for a verification link.');
        }

        return redirect('user/dashboard')->with('message', 'Welcome to Dashboard');
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
       \Log::info('Role as : status' );

            return redirect('admin/dashboard')->with('message', 'Welcome to Dashboard');
         
    } 
    
    else {
          auth()->logout();
        return back()->with('status', 'Unauthorized to access.');
    }
}

}
