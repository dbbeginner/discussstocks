<?php

namespace App\Http\Controllers;

use App\Models\Channels;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChannelController extends Controller
{
    //

    public function AllChannels() {

        $data['channels'] = Channels::where('type', '=', 'channel')
            ->withCount('posts')
            ->orderByDesc('updated_at')
            ->simplePaginate( setting('pagination'));

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

        // Need to check for duplicates and ask for confirmation to proceed;

        $channel = new Channels;
        $channel->title = $request->post('title');
        $channel->content = $request->post('description');
        $channel->user_id = Auth::user()->id;
        $channel->save();

        return redirect()->back()->with('success', 'Your channel named <a href="' . $channel->url() .'">' . $channel->title . '</a> was created.');

    }

    private function checkForDuplicate($title){
        return Channels::where('title', '=', $title)->where('type', '=', 'channel')->get();
    }

}
