<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Vinkla\Hashids\Facades\Hashids;
use App\Models\Heartbeat;

class HeartbeatController extends Controller
{
    //

    public function index(Request $request)
    {
        if(!is_null($request->input('id'))) {
            $heartbeat = Heartbeat::where([
                'id' => Hashids::decode($request->input('id'))[0]
            ])->first();
            $heartbeat->touch();
            return [
                'visit_id' =>Hashids::encode($heartbeat->id),
            ];
        }
        return [
            'visit_id' => null,
        ];
    }

}
