<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

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
                // If user is already authenticated, redirect to home
                if ($request->is('login') || $request->is('register')) {
                    return redirect()->route('home');
                }
                return redirect(RouteServiceProvider::HOME);
            }
        }

        // For guests trying to access auth pages, allow the request
        if ($request->is('login') || $request->is('register')) {
            return $next($request);
        }

        // For all other guest requests, show the landing page
        if (!Auth::check() && $request->path() === '/') {
            return $next($request);
        }

        // If not authenticated and not on the landing page, redirect to landing
        if (!Auth::check() && $request->path() !== '/') {
            return redirect('/');
        }

        return $next($request);
    }
}
