<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Reply;
use Faker\Factory;

class ReplyChildSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $replies = Reply::where('type', '=', 'reply')->get();
        $userCount = count(User::all());

        foreach ($replies as $reply) {

            $i = random_int(1, 5);

            while($i < 3) {
                $r = new Reply;
                $faker = Factory::create();

                $r->parent_id = $reply->id;
                $r->title = $faker->catchPhrase();
                $r->content = $faker->paragraphs(5, true);
                $r->user_id = random_int(1, $userCount);
                $r->published_at = now();
                $r->save();
                $i++;

            }
        }
    }
}
