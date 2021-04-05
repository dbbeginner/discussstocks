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
        $request->merge([
            'user_id' => Hashids::decode($request->input('user_id'))[0],
            'content_id' => Hashids::decode($request->input('reply_id'))[0],
        ]);

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'content_id' => 'required|exists:content,id',
            'content' => 'required|min:2|max:5000',
        ]);

        return Reply::create([
            'parent_id' => $request->input('content_id'),
            'user_id' => $request->input('user_id'),
            'content' => $request->input('content'),
        ]);
    }
}
