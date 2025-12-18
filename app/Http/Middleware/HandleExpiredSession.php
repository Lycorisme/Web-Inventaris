<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HandleExpiredSession
{
    public function handle(Request $request, Closure $next): Response
    {
        // Check if session has expired or CSRF token is invalid
        if ($request->isMethod('post') && !$request->session()->has('_token')) {
            return redirect('/login')->with('error', 'Your session has expired. Please login again.');
        }

        return $next($request);
    }
}
