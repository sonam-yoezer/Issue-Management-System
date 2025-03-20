<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class Technician
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Ensure the user is authenticated
        if (!Auth::check() || Auth::user()->role !== 'technician') {
            // If not a technician or not authenticated, redirect to a different page (e.g., dashboard)
            return redirect('dashboard');
        }

        // Allow the request to proceed if the user is authenticated and is a technician
        return $next($request);
    }
}
