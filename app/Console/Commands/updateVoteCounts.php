<?php

namespace App\Console\Commands;

use App\Models\Content;
use Illuminate\Console\Command;
use App\Models\Votes;

class updateVoteCounts extends Command
{

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

    }

}
