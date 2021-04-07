<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Vinkla\Hashids\Facades\Hashids;
use App\Models\Votes;
use App\Models\Content;

class VoteController extends Controller
{
    public function store(Request $request){
        $post = $request->all();
        $content_id = Hashids::decode($post['content_id'])[0];
        $user_id = Hashids::decode($post['user_id'])[0];
        $vote_value = $this->VoteDirectionToValue( $post['direction']);

        $vote = Votes::where('content_id', '=', $content_id)->where('user_id', '=', $user_id)->first();

        if($vote) {
        // if we find a vote, reverse that vote
            $vote->delete();
        } else {
        // If there is no match for a vote on this content_id by this user_id, we can record the vote.
            Votes::create(['content_id' => $content_id, 'user_id' => $user_id, 'vote' => $vote_value]);
        }

        $content = Content::where('id', '=', $content_id)->first();

        (int)$vote_count = $content->countOfVotes();
        (int)$vote_sum = $content->sumOfVotes();

        if($vote_count == 0 || $vote_sum == 0) {
            $percent_positive = '0%';
        } else {
            $percent_positive = round($vote_sum / $vote_count * 100, 0) . '%';
        }

        return json_encode([
            'sumOfVotes' => $vote_count,
            'countOfVotes' => $vote_sum,
            'percent' => $percent_positive,
        ]);
    }

    private function VoteDirectionToValue($direction) {
        if($direction == 'up') {
            return 1;
        } elseif ($direction == 'down') {
            return -1;
        } else {
            return;
        }
    }
}
