<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Vinkla\Hashids\Facades\Hashids;

class HomeController extends Controller
{
    //

    public function index(Request $request)
    {
        if (Auth::guest()) {
            return $this->allPosts();
        }

        return $this->subscribedPosts();
    }

    public function allPosts()
    {
        $query = Post::where('type', '=', 'post');

        $title = 'All Recently Posted';

        return $this->renderView($query, $title);
    }

    public function subscribedPosts()
    {

        $subscriptions = Auth::user()->getSubscriptionsForUser();


        // If user is not subscribed to any channels, send them to the subscription page
        if(count($subscriptions) == 0 ) {
            return redirect('/user/subscriptions')->with('info', "You're not subscribed to any channels yet. Pick a few below");
        }

        $query = Post::whereIn('parent_id', $subscriptions );

        $title = 'Recent Posts Based On Your Preferences';
        return $this->renderView($query, $title);
    }

    public function postsInChannel(Request $request, $slug, $hashId)
    {
        $channel = Channel::where('id', '=', Hashids::decode($hashId))->first();
        $query = Post::where('parent_id', '=', $channel->id);

        $title = 'Posts in ' . $channel->title;

        return $this->renderView($query, $title, $channel, 'channel');
    }

    public function renderView($data, $title = null, $channel = null, $blade = 'posts')
    {
        $count = $data->count();
        $content = $data->with('user', 'votes')
            ->withCount('votes')
            ->withSum('votes', 'vote')
            ->orderByDesc('updated_at')
            ->simplePaginate( preference('pagination', 10) );

        return view($blade, [
            'title' => $title,
            'posts' => $content,
            'count' => $count,
            'channel' => $channel,
            ]);
    }
}