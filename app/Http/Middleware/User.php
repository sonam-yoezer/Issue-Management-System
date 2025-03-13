<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Support\Facades\Auth;

class User
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        \Log::info('Checking user authentication status: ' . Auth::check());
        
        if (Auth::user() == null) {
            \Log::info('User is not authenticated.');
            return redirect('dashboard');
        }

        \Log::info('User is authenticated: ' . Auth::check());
        \Log::info('User role: ' . Auth::user()->role);

        if (Auth::user()->role != 'user') {
            return redirect('dashboard');
        }

        return $next($request);
    }
}
