<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Vinkla\Hashids\Facades\Hashids;
use App\Models\Votes;

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

        (int)$voteCount = $this->countOfVotes($contentId);
        (int)$upvoteCount = $this->countOfUpvotes($contentId);
        $percentPositive = round($upvoteCount / $voteCount * 100, 0) . '%';

        return [
            'countOfVotes' => $voteCount,
            'countOfUpvotes' => $upvoteCount,
            'percent' => $percentPositive,
        ];

    }

    private function countOfVotes($contentId) {
        return (int) Votes::where('content_id', '=', $contentId)->count();
    }

    private function countOfUpvotes($contentId) {
        return (int) Votes::where('content_id', '=', $contentId)->where('vote', '=', 1)->count();
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
