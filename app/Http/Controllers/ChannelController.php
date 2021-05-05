<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Rules\isChannelTitleUnique;

class ChannelController extends Controller
{
    //

    public function index(Request $request, $order = null)
    {
        switch ($order) {
            case null:
              return $this->mostRecentlyActive();
            case 'ascending':
                return $this->ascending();
            case 'descending':
                return $this->descending();
            case 'oldest':
                return $this->oldest();
            case 'newest':
                return  $this->newest();
            case 'most-active':
                return $this->mostActive();
            case 'least-active':
                return $this->leastActive();
            case 'most-recently-active':
                return $this->mostRecentlyActive();
            case 'least-recently-active':
                return $this->leastRecentlyActive();
            case 'random':
                return  $this->random();
        }
        return $this->mostRecentlyActive();
    }

    public function newest()
    {
        return view ('channels', [
            'title' => 'Channels (newest to oldest)',
            'channels' =>  Channel::where('type', '=', 'channel')
                ->whereNotNull('published_at')
                ->withCount('posts')
                ->orderByDesc('created_at')
                ->simplePaginate( preference('pagination', 10))
        ]);
    }

    public function oldest()
    {
        return view ('channels', [
            'title' => 'Channels (oldest to newest)',
            'channels' =>  Channel::where('type', '=', 'channel')
                ->whereNotNull('published_at')
                ->withCount('posts')
                ->orderBy('created_at')
                ->simplePaginate( preference('pagination', 10))
        ]);
    }

    public function mostActive()
    {
        return view ('channels', [
            'title' => 'Channels (most posts)',
            'channels' =>  Channel::where('type', '=', 'channel')
                ->whereNotNull('published_at')
                ->withCount('posts')
                ->orderByDesc('posts_count')
                ->simplePaginate( preference('pagination', 10))
        ]);
    }

    public function leastActive()
    {
        return view ('channels', [
            'title' => 'Channels (lowest number of posts)',
            'channels' =>  Channel::where('type', '=', 'channel')
                ->whereNotNull('published_at')
                ->withCount('posts')
                ->orderBy('posts_count')
                ->simplePaginate( preference('pagination', 10))
        ]);
    }

    public function mostRecentlyActive()
    {
        return view ('channels', [
            'title' => 'Channels (most recent activity)',
            'channels' =>  Channel::where('type', '=', 'channel')
                ->whereNotNull('published_at')
                ->withCount('posts')
                ->orderByDesc('updated_at')
                ->simplePaginate( preference('pagination', 10))
        ]);
    }

    public function leastRecentlyActive()
    {
        return view ('channels', [
            'title' => 'Channels (least recent activity)',
            'channels' =>  Channel::where('type', '=', 'channel')
                ->whereNotNull('published_at')
                ->withCount('posts')
                ->orderBy('updated_at')
                ->simplePaginate( preference('pagination', 10))
        ]);
    }

    public function ascending()
    {

        return view ('channels', [
            'title' => 'Channels (alphabetical, A-Z)',
            'channels' =>  Channel::where('type', '=', 'channel')
                ->whereNotNull('published_at')
                ->withCount('posts')
                ->orderBy('title')
                ->simplePaginate( preference('pagination', 10))
        ]);
    }

    public function descending()
    {
        return view ('channels', [
            'title' => 'Channels (alphabetical, Z-A)',
            'channels' =>  Channel::where('type', '=', 'channel')
                ->whereNotNull('published_at')
                ->withCount('posts')
                ->orderByDesc('title')
                ->simplePaginate( preference('pagination', 10))
        ]);
    }

    public function random()
    {
        return view ('channels', [
            'title' => 'Channels (random order)',
            'channels' =>  Channel::where('type', '=', 'channel')
                ->whereNotNull('published_at')
                ->withCount('posts')
                ->inRandomOrder()
                ->simplePaginate( preference('pagination', 10))
        ]);
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
            'published_at' => now(),
            'user_id' => Auth::user()->id]
        );

        return redirect()->back()->with('success', 'Your channel named <a href="' . $channel->url() .'">' . $channel->title . '</a> was created.');

    }

}
