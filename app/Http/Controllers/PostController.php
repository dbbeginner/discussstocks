<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use App\Models\Post;
use App\Models\Reply;
use Illuminate\Http\Request;
use Vinkla\Hashids\Facades\Hashids;

class PostController extends Controller
{
    //

    public function create(){
        return view('post.choose');
    }

    public function recentPosts(){

        $data['posts'] = Post::where('type', '=', 'post')
            ->with('user', 'votes')
            ->withCount('votes')
            ->withSum('votes', 'vote')
            ->orderByDesc('updated_at')
            ->simplePaginate( preference('pagination', 10) );

        $data['title'] = 'Recent Posts';

        return view('posts', $data);
    }

    public function viewPostsInChannel(Request $request, $slug, $hashId){
        $data['posts'] = Post::where('parent_id', '=', Hashids::decode($hashId))
            ->with('user', 'votes')
            ->withSum('votes', 'vote')
            ->orderByDesc('updated_at')
            ->simplePaginate( setting( 'pagination', 10) );

        $channel = Channel::where('id', '=', Hashids::decode($hashId))->first();

        $data['title'] = 'Viewing posts filed in ' . $channel->title;

        return view( 'posts', $data);

    }

    public function viewPost($channelSlug, $channelHashId, $postSlug, $hashId){

        $data['post'] = Post::where('type', '=', 'post')
            ->where('id', '=', Hashids::decode($hashId))
            ->with('user', 'votes', 'repliesWithChildren')
            ->withCount('votes')
            ->withSum('votes', 'vote')
            ->orderByDesc('updated_at')
            ->first();

        $data['title'] = $data['post']->title;

        $data['replies'] = Reply::where('type', '=', 'reply')
            ->where('parent_id', '=', $data['post']->id)
            ->with('user', 'votes', 'repliesWithChildren')
            ->get();

        return view('post', $data);
    }

}
