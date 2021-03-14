<?php

namespace App\Http\Controllers;

use App\Models\Channels;
use App\Models\Posts;
use App\Models\Replies;
use Illuminate\Http\Request;
use App\Models\Settings;
use Illuminate\Support\Facades\Hash;
use Vinkla\Hashids\Facades\Hashids;
use App\Helpers\ParentByType;

class PostController extends Controller
{
    //

    public function recentPosts(){

        $data['posts'] = Posts::where('type', '=', 'post')
            ->with('user', 'votes')
            ->withCount('votes')
            ->withSum('votes', 'vote')
            ->orderByDesc('updated_at')
            ->simplePaginate( setting('pagination', 10) );

        $data['title'] = 'Recent Posts';

        return view('posts', $data);
    }

    public function viewPostsInChannel(Request $request, $slug, $hash_id){
        $data['posts'] = Posts::where('parent_id', '=', Hashids::decode($hash_id))
            ->with('user', 'votes')
            ->withSum('votes', 'vote')
            ->orderByDesc('updated_at')
            ->simplePaginate( setting( 'pagination', 10) );

        $channel = Channels::where('id', '=', Hashids::decode($hash_id))->first();

        $data['title'] = 'Viewing posts filed in ' . $channel->title;

        return view( 'posts', $data);

    }

    public function viewPost($slug, $hashid){

        $data['post'] = Posts::where('type', '=', 'post')
            ->where('id', '=', Hashids::decode($hashid))
            ->with('user', 'votes', 'repliesWithChildren')
            ->withCount('votes')
            ->withSum('votes', 'vote')
            ->orderByDesc('updated_at')
            ->first();

        $data['title'] = $data['post']->title;

        $data['replies'] = Replies::where('type', '=', 'reply')
            ->where('parent_id', '=', $data['post']->id)
            ->with('user', 'votes', 'repliesWithChildren')
            ->get();

        return view('post', $data);
    }

}
