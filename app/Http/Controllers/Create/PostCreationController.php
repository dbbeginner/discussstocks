<?php

namespace App\Http\Controllers\Create;

use App\Http\Controllers\Controller;
use App\Models\Channel;
use App\Rules\isUserSubscribedToChannel;
use Illuminate\Http\Request;
use Vinkla\Hashids\Facades\Hashids;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostCreationController extends Controller {

    public function index(Request $request){
        $data['subscriptions'] = Channel::whereIn('id', Auth::user()->subscriptions()->pluck('content_id'))
            ->orderBy('title')
            ->get();
        return view('post.create.article', $data);
    }

    public function verify(Request $request)
    {
        $request->validate([
            'title'     =>      ['required'],
            'content'   =>      ['max:5000']
        ]);

        $title = $request->input('title');
        $content = $request->input('content');
        $user_id = Hashids::decode($request->input('user_id'))[0];
        $channel_id = Hashids::decode($request->input('channel_id'))[0];

        $request->session()->put('title', $title);
        $request->session()->put('content', $content);
        $request->session()->put('channel_id', $channel_id);
        $request->session()->put('channel_title', Channel::where('id', '=', $channel_id)->first()['title']);
        $request->session()->put('user_id', $user_id);
        $request->session()->put('username', User::where('id', '=', $user_id)->first()['name']);

        return view('post.verify.article');
    }


    public function store(Request $request) {
        if(Post::create([
            'parent_id' => $request->session()->get('channel_id'),
            'user_id' => $request->session()->get('user_id'),
            'type' => 'post',
            'subtype' => 'post',
            'title' => $request->session()->get('title'),
            'content' => $request->session()->get('content')])) {

            $request->session()->forget('channel_id');
            $request->session()->forget('channel_title');
            $request->session()->forget('user_id');
            $request->session()->forget('username');
            $request->session()->forget('title');
            $request->session()->forget('content');
        } else {
            return "An error occured";
        }

        return redirect('/')->with('success', 'Your post is created');
    }
}