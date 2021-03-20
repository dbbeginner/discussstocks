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

    public function store(Request $request){
        $post = $request->all();
        $contentId = Hashids::decode($post['content_id'])[0];
        $userId = Hashids::decode($post['user_id'])[0];
        $voteValue = $this->VoteDirectionToValue( $post['direction']);

        $vote = Votes::where('content_id', '=', $contentId)->where('user_id', '=', $userId)->first();

        if($vote) {
        // if we find a vote, reverse that vote
            $vote->delete();
            $result['status'] = "identical vote, deleting";
        } else {
        // If there is no match for a vote on this content_id by this user_id, we can record the vote.
            Votes::create(['content_id' => $contentId, 'user_id' => $userId, 'vote' => $voteValue]);
            $result['status'] = "vote recorded";
        }


        $permanentUpvotes = Content::where('id', '=', $contentId)->first()->upvotes_total;
        $additionalUpvotes = DB::table('votes')->where('content_id', '=', $contentId)->where('swept_at', '=', null)->sum('vote');

        $permanentVotes = Content::where('id', '=', $contentId)->first()->votes_total;
        $additionalVotes = DB::table('votes')->where('content_id', '=', $contentId)->where('swept_at', '=', null)->count('vote');

        $percent = round( (($permanentUpvotes + $additionalUpvotes) / ($permanentVotes + $additionalVotes) * 100), 0) . '%';

        return ['votes' => $percent];

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
