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
        $post = $request->validate([
            'content' => 'required|min:2|max:5000',
            'parent' => 'required',
        ]);

        return Reply::create([
            'parent_id' => Hashids::decode($post['parent']),
            'user_id' => Auth::user()->id,
            'content' => $post['content'],
        ]);
    }
}
