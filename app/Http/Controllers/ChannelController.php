<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Rules\isChannelTitleUnique;

class ChannelController extends Controller
{
    //

    public function AllChannels() {

        $data['channels'] = Channel::where('type', '=', 'channel')
            ->withCount('posts')
            ->orderByDesc('updated_at')
            ->simplePaginate( preference('pagination', 10));

        return view('channels', $data);

    }

    public function create()
    {
        return view('channel.create', ['title' => 'Create Channel']);
    }

    public function verify()
    {
        return view('channel.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', new isChannelTitleUnique ],
            'description' => ['required', 'max:1000' ],
        ]);

        // Need to check for duplicates and ask for confirmation to proceed;
        $channel = Channel::create([
            'title' => $request->input('title'),
            'content' => $request->input('description'),
            'user_id' => Auth::user()->id]
        );

        return redirect()->back()->with('success', 'Your channel named <a href="' . $channel->url() .'">' . $channel->title . '</a> was created.');

    }

}
