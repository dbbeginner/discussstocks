<?php

namespace App\Console\Commands;

use App\Models\Content;
use App\Models\Queue;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use App\Models\Votes;

class updateVoteCounts extends Command
{

    public $queue;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:votes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        // Create the queue
        $queue = new Queue;
        $queue->task = "Began updating vote counts";
        $queue->save();

        // claim the votes
        $votes = Votes::where('swept_at', '=', null)->get();

        foreach($votes as $vote){
            $vote->swept_at = now();
            $vote->save();

            $content = Content::where('id', '=', $vote->content_id)->first();
            $content->total_votes = $content->total_votes + 1;
            $content->total_upvotes = $content->total_upvotes + $vote->vote;
            $content->save();
        }
        // Note that the job finished
        $queue = new Queue;
        $queue->task = "Finished updating vote counts";
        $queue->save();

    }

    private function claimVotes()
    {
        return $votes;
    }


}
