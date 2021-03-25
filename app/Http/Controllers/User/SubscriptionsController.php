<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Subscriptions;
use Illuminate\Http\Request;
use App\Models\Channel;
use Vinkla\Hashids\Facades\Hashids;

class SubscriptionsController extends Controller
{
    //

    public function index(Channel $channels, Request $request) {
        $data['channels'] = Channel::where('type', '=', 'channel')
            ->withCount('posts')
            ->orderByDesc('title')
            ->simplePaginate( preference('pagination', 10 ));

        return view('settings.subscriptions', $data);

    }

    public function store(Request $request){
        $post = $request->all();
        $content_id = Hashids::decode($post['content_id'])[0];
        $user_id = Hashids::decode($post['user_id'])[0];


        $query = Subscriptions::where('content_id', '=', $content_id)
            ->where('user_id', '=', $user_id)
            ->first();

        if($query) {
            $query->forceDelete();
            return ['status' => false];
        } else {
            Subscriptions::create([
                'user_id' => $user_id,
                'content_id' => $content_id,
            ]);
            return ['status' => true ];
        }

    }
}