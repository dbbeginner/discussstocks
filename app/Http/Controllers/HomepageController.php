<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Posts;
use App\Models\Subscriptions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PostController;

class HomepageController extends Controller
{
    //

    public function index() {
        if(Auth::guest()) {
            $content = $this->allRecentPosts();
            $title = 'All Recent Posts';
        } else {
            $content = $this->postsFromUsersSubscriptions();
            $title = 'Recent Posts Based On Your Preferences';
        }

        if(count($content) < setting('pagination') - 1) {
            $notice = "There aren't many posts here. Perhaps you want to <a href=\"/user/subscriptions\">subscribe</a> to more channels?";
        } else {
            $notice = null;
        }

        return view('posts', ['title' => $title, 'posts' => $content, 'notice' => $notice])->with('status', 'message');
    }

    public function allRecentPosts(){
        return Posts::where('type', '=', 'post')
            ->with('user', 'votes')
            ->withCount('votes')
            ->withSum('votes', 'vote')
            ->orderByDesc('updated_at')
            ->simplePaginate( setting('pagination', 10) );

    }

    public function postsFromUsersSubscriptions() {
        // Get list of channels the current logged in user is subscribed to
        $subs = Subscriptions::where('user_id', Auth::user()->id)->pluck('content_id');

        Return Posts::whereIn('parent_id', $subs)
            ->with('user', 'votes')
            ->withCount('votes')
            ->withSum('votes', 'vote')
            ->orderByDesc('updated_at')
            ->simplePaginate( setting('pagination', 10));

    }
}
