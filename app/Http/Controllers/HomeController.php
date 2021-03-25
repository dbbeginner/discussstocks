<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use App\Models\Post;
use App\Models\Subscriptions;
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
        } else {
            return $this->subscribedPosts();
        }
    }

    public function allPosts(){
        $query = Post::where('type', '=', 'post')
            ->with('user', 'votes')
            ->withCount('votes')
            ->withSum('votes', 'vote')
            ->orderByDesc('updated_at');
        $title = 'All Recently Posted';

        return $this->renderView($query, $title);
    }

    public function subscribedPosts(){
        $subscriptions = Auth::user()->subscriptions()->pluck('content_id');

        // If user is not subscribed to any channels, send them to the subscription page
        if(count($subscriptions) == 0 ) {
            return redirect('/user/subscriptions')->with('info', "You're not subscribed to any channels yet. Pick a few below");
        }

        // If user is only subscribed to one channel, load just that channels posts
        if(count($subscriptions) == 1 ) {
            $query = Post::where('parent_id', '=', $subscriptions->first() )
                ->with('user', 'votes')
                ->withCount('votes')
                ->withSum('votes', 'vote')
                ->orderByDesc('updated_at');;
        } else {
        // If the user is subscribed to more than one channel, show the posts from all those channels
            $query = Post::whereIn('parent_id', )
                ->with('user', 'votes')
                ->withCount('votes')
                ->withSum('votes', 'vote')
                ->orderByDesc('updated_at');;
        }
        $title = 'Recent Posts Based On Your Preferences';
        return $this->renderView($query, $title);
    }

    public function postsInChannel(Request $request, $slug, $hashId){
        $channel = Channel::where('id', '=', Hashids::decode($hashId))->first();
        $query = Post::where('parent_id', '=', $channel->id)
            ->with('user', 'votes')
            ->withCount('votes')
            ->withSum('votes', 'vote')
            ->orderByDesc('updated_at');;
        $title = 'Posts in ' . $channel->title;

        return $this->renderView($query, $title, $channel, 'channel');
    }

    public function renderView($data, $title = null, $channel = null, $blade = 'posts') {
        $count = $data->count();
        $content = $data->simplePaginate( preference('pagination', 10) );

        if( $count < preference('pagination') - 1) {
            $notice = "There aren't many posts here. Perhaps you want to <a href=\"/user/subscriptions\">subscribe</a> to more channels?";
        } else {
            $notice = null;
        }

        return view($blade, [
            'title' => $title,
            'posts' => $content,
            'count' => $count,
            'notice' => $notice,
            'channel' => $channel,
            ]);
    }

}