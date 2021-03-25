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

class LinkCreationController extends Controller {

    public function index(Request $request){
        $data['url'] = $request->old('page-url');
        $data['subscriptions'] = Channel::whereIn('id', Auth::user()->subscriptions()->pluck('content_id'))
            ->orderBy('title')
            ->get();
        return view('post.create.url', $data);
    }

    public function verify(Request $request)
    {
        $request->validate([
            'url' => ['url'],
            'channel_id' => ['required', new isUserSubscribedToChannel]
        ]);

        $content = $request->input('url');
        $title   = $request->input('title');
        $user_id = Hashids::decode($request->input('user_id'))[0];
        $channel_id = Hashids::decode($request->input('channel_id'))[0];

        if(strlen(trim($title)) == 0) {
            $title = $this->getTitle($content);
        }

        $request->session()->put('title', $title);
        $request->session()->put('content', $content);
        $request->session()->put('channel_id', $channel_id);
        $request->session()->put('channel_title', Channel::where('id', '=', $channel_id)->first()['title']);
        $request->session()->put('user_id', $user_id);
        $request->session()->put('username', User::where('id', '=', $user_id)->first()['name']);

        return view('post.verify.url');
    }


    public function store(Request $request) {
        Post::create([
            'parent_id' => $request->session()->get('channel_id'),
            'user_id' => $request->session()->get('user_id'),
            'type' => 'post',
            'subtype' => 'url',
            'title' => $request->session()->get('channel_title'),
            'content' => $request->session()->get('content')]);

        $request->session()->forget('channel_id');
        $request->session()->forget('channel_title');
        $request->session()->forget('user_id');
        $request->session()->forget('username');
        $request->session()->forget('title');
        $request->session()->forget('content');

        return redirect('/')->with('success', 'Your post is created');
    }

    public function getTitle($url)
    {
        if (filter_var(trim($url), FILTER_VALIDATE_URL)) {
            $data = file_get_contents($url);
            if(preg_match('/<title[^>]*>(.*?)<\/title>/ims', $data, $matches)) {
                return $matches[1];
            }
        }
        return false;
    }

    public function titleHelper(Request $request) {
        return json_encode(['title' => $this->getTitle($request->input('url'))]);
    }
}