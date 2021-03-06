<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reply;
use Illuminate\Support\Facades\Auth;
use Vinkla\Hashids\Facades\Hashids;
use App\Models\User;

class ReplyController extends Controller
{

    //
    public function Store(Request $request)
    {
        $request->merge([
            'user_id' => Hashids::decode($request->input('user_id'))[0],
            'content_id' => Hashids::decode($request->input('reply_id'))[0],
        ]);

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'content_id' => 'required|exists:content,id',
            'content' => 'required|min:2|max:5000',
        ]);

        $reply = Reply::create([
            'parent_id' => $request->input('content_id'),
            'user_id' => $request->input('user_id'),
            'content' => $request->input('content'),
            'published_at' => now(),
        ]);

        return json_encode(['html' => \View('template.content.reply-body', ['reply' => $reply])->render() ]);

    }
}
