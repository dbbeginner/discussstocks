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

    public function index(PostController $postController) {
        if(Auth::guest()) {
            $data['posts'] = $this->AllRecentPosts();
            $data['title'] = 'All Recent Posts';
        } else {
            $data['posts'] = $this->PostsFromUsersSubscriptions();
            $data['title'] = 'Recent Posts Based On Your Preferences';
        }

        return view('posts', $data);
    }

    public function AllRecentPosts(){

        return Posts::where('type', '=', 'post')
            ->with('user', 'votes')
            ->withCount('votes')
            ->withSum('votes', 'vote')
            ->orderByDesc('updated_at')
            ->simplePaginate( setting('pagination', 10) );

    }



    public function PostsFromUsersSubscriptions() {
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
