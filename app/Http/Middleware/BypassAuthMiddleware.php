<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BypassAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->is('schedules/send-messages')) {
            return $next($request); // Bypass authentication
        }
    
        // Continue with regular authentication logic for other URLs
        //return $this->auth->check() ? $next($request) : redirect('login');
    }
}
