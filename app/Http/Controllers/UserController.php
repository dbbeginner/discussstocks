<?php

namespace App\Http\Controllers;

use App\Models\Mention;
use App\Models\Post;
use App\Models\User;
use App\Models\Reply;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //

    public function index(Request $request, $username) {
        $user = $this->user($username);

        return view('user.user', ['user' => $user]);
    }


    public function posts(Request $request, $username){
        $user = $this->user($username);
        $posts = Post::where('type', '=', 'post')
            ->where('user_id', '=', $user->id)
            ->with('user', 'votes')
            ->withCount('votes')
            ->withSum('votes', 'vote')
            ->orderByDesc('updated_at');
        $data['count'] = $posts->count();
        $data['posts'] = $posts->simplePaginate( preference('pagination', 10));
        $data['user'] = $user;
        $data['title'] = 'Recent Posts';

        return view('user.posts', $data);
    }

    public function replies(Request $request, $username)
    {
        $data['user'] = User::where('name', '=', $username)->first();
        $data['replies'] = Reply::where('type', '=', 'reply')
            ->where('user_id', '=', $data['user']->id)
            ->simplePaginate( preference('pagination', 10));


        return view('user.replies', $data);

    }


    public function mentions(Request $request, $username)
    {
        $data['user'] = User::where('name', '=', $username)->first();
        $data['mentions'] = Mention::where('user_id', '=', $data['user']->id)->get();


        return view('user.mentions', $data);

    }

    private function user($username) {
        return User::where('name', '=', $username)->first();
    }
}
