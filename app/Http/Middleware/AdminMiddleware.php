<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->user_type === 'admin') {
            return $next($request);
        }

        return redirect()->route('admin.login')->with('error', 'You do not have admin privileges.');
    }
}
