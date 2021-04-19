<?php

namespace App\Http\Middleware;

use App\Models\Heartbeat;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Vinkla\Hashids\Facades\Hashids;

class GeneratePageviewId
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
        $request->session()->forget('heartbeat_id');

        // If user is not logged in, set ID to 1
        if(!Auth::check())
        {
            $user_id = 1;
        } else {
            $user_id = Auth::user()->id;
        }

        $heartbeat = Heartbeat::create([
            'user_id' => $user_id,
            'useragent' => $request->header('User-Agent'),
            'uri' => $request->path(),
        ]);

        $request->session()->put('heartbeat_id', Hashids::encode($heartbeat->id) );

        return $next($request);
    }
}
