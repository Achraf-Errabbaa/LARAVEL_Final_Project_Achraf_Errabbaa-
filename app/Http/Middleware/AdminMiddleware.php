<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->role === 'admin') {
            \Log::info('Admin access granted to: ' . auth()->user()->name);
            return $next($request);
        }
    
        \Log::warning('Access denied for: ' . auth()->user()->name);
        return redirect()->route('dashboard');
    }
}
