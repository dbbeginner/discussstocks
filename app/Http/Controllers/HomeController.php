<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Posts;
use App\Models\Subscriptions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PostController;

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

        return \App\Helpers\ViewHelper::showPosts($query, $title);
    }

    public function subscribedPosts(){
        $query = Posts::whereIn('parent_id', Auth::user()->subscriptions()->pluck('content_id'))
            ->with('user', 'votes')
            ->withCount('votes')
            ->withSum('votes', 'vote')
            ->orderByDesc('updated_at');;
        $title = 'Recent Posts Based On Your Preferences';
        return \App\Helpers\ViewHelper::showPosts($query, $title);
    }

}