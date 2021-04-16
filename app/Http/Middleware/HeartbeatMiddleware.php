<?php

namespace App\Http\Middleware;

use App\Models\Heartbeat;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Vinkla\Hashids\Facades\Hashids;

class HeartbeatMiddleware
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

        $request->session()->flush();
//         don't trigger middleware when the following routes/resources
        if($request->is([
            '/',
            'admin/*',
            'modals/*',
            'heartbeat',
            'heartbeat/*',
            'vote',
            'report',
            '*.png',
            '*.jpg',
            '*.jpeg',
            null,
        ])) {
            return $next($request);
        }
        elseif($request->getUri() == null)
        {
            return $next($request);
        }
        elseif(!Auth::guest() && in_array(Auth::user()->role, ['admin', 'superadmin']))
//        don't trigger if the user is an admin or superadmin
        {
            return $next($request);
        }
//        Set the user_id to 1 if it's null (for anonymous users)
        elseif(!Auth::check())
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
