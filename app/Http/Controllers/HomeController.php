<?php

namespace App\Http\Controllers;

use App\Models\Channels;
use App\Models\Content;
use App\Models\Posts;
use App\Models\Subscriptions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Hash;
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
        $query = Posts::where('type', '=', 'post')
            ->with('user', 'votes')
            ->withCount('votes')
            ->withSum('votes', 'vote')
            ->orderByDesc('updated_at');
        $title = 'All Recently Posted';

        return $this->renderView($query, $title);
    }

    public function subscribedPosts(){
        $query = Posts::whereIn('parent_id', Auth::user()->subscriptions()->pluck('content_id'))
            ->with('user', 'votes')
            ->withCount('votes')
            ->withSum('votes', 'vote')
            ->orderByDesc('updated_at');;
        $title = 'Recent Posts Based On Your Preferences';
        return $this->renderView($query, $title);
    }

    public function postsInChannel(Request $request, $slug, $hashId){
        $channel = Channels::where('id', '=', Hashids::decode($hashId))->first();
        $query = Posts::where('parent_id', '=', $channel->id)
            ->with('user', 'votes')
            ->withCount('votes')
            ->withSum('votes', 'vote')
            ->orderByDesc('updated_at');;
        $title = 'Posts in ' . $channel->title;

        return $this->renderView($query, $title, $channel, 'channel');
    }

    public function renderView($data, $title = null, $channel = null, $blade = 'posts') {
        $count = $data->count();
        $content = $data->simplePaginate( setting('pagination', 10) );

        if( $count < setting('pagination') - 1) {
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