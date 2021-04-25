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

    public function index(Request $request)
    {
        $data['subscriptions'] = Channel::whereIn('id', Auth::user()->subscriptions()->pluck('content_id'))
            ->orderBy('title')
            ->get();
        return view('post.create.article', $data);
    }

    public function verify(Request $request)
    {
        $request->validate([
            'title'     =>      ['required'],
            'content'   =>      ['max:5000'],
            'channel_id' =>     [ new isUserSubscribedToChannel ],
            'file'  =>          ['nullable', 'file', 'min:1', 'max:200', 'mimes:txt,rtf,pdf,doc,docx,xls,xlsx,ppt' ]
        ]);

        $data = $request->only(['title', 'content', 'channel_id']);
        $data['channel_title'] = Channel::where('id', '=', Hashids::decode($data['channel_id']))->first()['title'];

        return view('post.verify.article', $data );
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'title'     =>      ['required'],
            'content'   =>      ['max:5000'],
            'channel_id' =>     [ new isUserSubscribedToChannel ],
        ]);


        $post = Post::create([
            'parent_id' => Hashids::decode($request->input('channel_id'))[0],
            'user_id' => Auth::user()->id,
            'type' => 'post',
            'subtype' => 'post',
            'title' => $validated['title'],
            'content' => $validated['content']
        ]);

        return redirect('/' . $post->hashId() )->with('success', 'Your post is created');
    }
}