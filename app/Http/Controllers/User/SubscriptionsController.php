<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Subscriptions;
use Illuminate\Http\Request;
use App\Models\Channels;
use Vinkla\Hashids\Facades\Hashids;
use App\Models\Content;

class SubscriptionsController extends Controller
{
    //

    public function index(Channels $channels, Request $request) {
        $data['channels'] = Channels::where('type', '=', 'channel')
            ->withCount('posts')
            ->orderByDesc('title')
            ->simplePaginate( setting('pagination'));

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
            $sub = new Subscriptions;
            $sub->content_id = $content_id;
            $sub->user_id = $user_id;
            $sub->save();
            return ['status' => true ];
        }

    }
}