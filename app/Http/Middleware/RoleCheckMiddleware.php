<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Auth\AuthenticationException;

class RoleCheckMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param string $role
     * @return mixed
     * @throws AuthenticationException
     */
    public function handle($request, Closure $next, $role = 'Admin')
    {
        if (Auth::user() and Auth::user()->hasRole($role)){
            return $next($request);
        }
        return abort(404);
    }
}
