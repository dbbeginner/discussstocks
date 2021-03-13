<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Channels;
use Illuminate\Support\Facades\Auth;

class ChannelController extends Controller
{
    //

    public function all()
    {
        $data['channels'] = Channels::where('deleted_at', '=', null)
            ->where('type', '=', 'channel')
            ->withCount('posts')->orderBy('updated_at')->simplePaginate();

        return view('channels', $data);
    }

    public function create()
    {
        return view('channel.create');
    }

    public function store(Request $request)
    {

        $validator = $request->validate([
           'title' =>  'required|regex:/^[\pL\s\-]+$/u|max:60',
           'description' => 'bail|required|max:1000'
        ]);

        $channel = new Channels;
        $channel->title = $request->post('title');
        $channel->content = $request->post('description');
        $channel->user_id = Auth::user()->id;
        $channel->save();

//        $result = Channels::where('id', '=', $channel->id)->first();

        return redirect()->back()->with('success', 'Your channel named <a href="' . $channel->url() .'">' . $channel->title . '</a> was created.');

    }

}
