<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();

        // If no specific roles are required, just check if user is authenticated
        if (empty($roles)) {
            return $next($request);
        }

        // Check if user has one of the required roles
        if (!in_array($user->role, $roles)) {
            // Redirect to appropriate dashboard based on user role
            switch ($user->role) {
                case 'admin':
                    return redirect('/admin/dashboard');
                case 'editor':
                    return redirect('/editor/dashboard');
                case 'reader':
                    return redirect('/dashboard');
                default:
                    return redirect('/');
            }
        }

        return $next($request);
    }
}
