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
        $contentId = Hashids::decode($post['content_id'])[0];
        $userId = Hashids::decode($post['user_id'])[0];
        $voteValue = $this->VoteDirectionToValue( $post['direction']);

        $vote = Votes::where('content_id', '=', $contentId)->where('user_id', '=', $userId)->first();

        if($vote) {
        // if we find a vote, reverse that vote
            $vote->delete();
        } else {
        // If there is no match for a vote on this content_id by this user_id, we can record the vote.
            Votes::create(['content_id' => $contentId, 'user_id' => $userId, 'vote' => $voteValue]);
        }

        $content = Content::where('id', '=', $contentId)->first();

        (int)$voteCount = $content->countOfVotes();
        (int)$voteSum = $content->sumOfVotes();
        $percentPositive = round($voteSum / $voteCount * 100, 0) . '%';

        return [
            'sumOfVotes' => $content->sumOfVotes(),
            'countOfVotes' => $content->countOfVotes(),
            'percent' => $percentPositive,
        ];

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
