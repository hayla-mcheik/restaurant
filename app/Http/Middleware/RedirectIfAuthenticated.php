<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Mail;
use App\Mail\ApproveEmailNotification;
class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::user();
                if ($user->role_as == '3') {

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
            
                        return redirect('admin/dashboard')->with('message', 'Welcome to Dashboard');
                    
                } else {
                    return redirect(RouteServiceProvider::HOME);
                }
            }
        }

        return $next($request);
    }
}
