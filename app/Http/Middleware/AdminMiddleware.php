<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {    
        if (auth()->check() && auth()->user()->role_as === 1) {
            return $next($request);
        }
        return response(view('error.403'), 403);
    }
}
