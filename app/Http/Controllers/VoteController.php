<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Vinkla\Hashids\Facades\Hashids;
use App\Models\Votes;
use App\Models\Content;
use Illuminate\Support\Facades\DB;

class VoteController extends Controller
{

    public function CastVote(Request $request){
        $post = $request->all();
        $content_id = Hashids::decode($post['content_id'])[0];
        $user_id = Hashids::decode($post['user_id'])[0];
        $vote_value = $this->VoteDirectionToValue( $post['direction']);

        $vote = Votes::where('content_id', '=', $content_id)->where('user_id','=',$user_id)->first();

        // If there is no match for a vote on this content_id by this user_id, we can record the vote.
        if(!$vote) {
            $vote = new Votes;
            $vote->content_id = $content_id;
            $vote->user_id = $user_id;
            $vote->vote = $vote_value;
            $vote->save();
            $result['status'] = "vote recorded";
        }

        // if there is a match for this vote on content_id and user_id, just delete the existing vote.
        // the user can then post a new vote.
        // It should be apparent in the UI that the user has already voted, though. That is a TODO item.
        else {
            $vote->delete();
            $result['status'] = "identical vote, deleting";
        }

        $permanent_votes = Content::where('id', '=', $content_id)->first()->upvotes_total;
        $additional_votes = DB::table('votes')->where('content_id', '=', $content_id)->where('swept_at', '=', null)->sum('vote');

        $result['new_vote_total'] = $permanent_votes + $additional_votes;

        return $result;
    }

    public function VoteDirectionToValue($direction) {
        if($direction == 'up') {
            return 1;
        } elseif ($direction == 'down') {
            return -1;
        } else {
            return;
        }
    }
}
