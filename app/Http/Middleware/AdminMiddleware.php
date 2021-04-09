<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        $roles = ['admin', 'superadmin'];

        if(!Auth::guest() && in_array(Auth::user()->role, $roles))
        {
            return $next($request);
        }

        abort(403, 'This route requires administrative rights');
    }
}
