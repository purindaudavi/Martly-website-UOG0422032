<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  ...$roles
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // If the user is not authenticated, they can't have a role, so we deny access
        if (! $request->user()) {
            return redirect('login');
        }

        // Check if the user's role is in the list of allowed roles
        if (! in_array($request->user()->role, $roles)) {
            // Redirect based on the user's actual role, or to a general welcome page
            switch ($request->user()->role) {
                case 'vendor':
                    return redirect('/vendor');
                case 'user':
                    return redirect('/');
                default:
                    return redirect('/');
            }
        }

        return $next($request);
    }
}