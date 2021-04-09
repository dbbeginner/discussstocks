<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class SuperAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $roles = ['superadmin'];

        if(!Auth::guest() && in_array(Auth::user()->role, $roles))
        {
            return $next($request);
        }

        abort(403, 'This route requires elevated admin rights');

    }
}
