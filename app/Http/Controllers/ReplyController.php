<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Content;
use App\Models\Reply;
use Illuminate\Support\Facades\Auth;
use Vinkla\Hashids\Facades\Hashids;

class ReplyController extends Controller
{

    public function __construct() {
        if(Auth::check()) {
            return Redirect()->to('home')->with('error', 'You must be logged in to do this');
        }
    }
    //
    public function Store(Request $request) {
        $post = $request->all();

        if(strlen($post['content']) > 5000) {
            return "comment too long (keep it shorter than 5000 characters!";
        }

        $parent = Content::where('id', '=', Hashids::decode($post['parent']))->first();

        $reply = new Reply;
        $reply->parent_id = $parent->id;
        $reply->user_id = 1;
        $reply->content = $post['content'];
        $reply->save();

    }
}
