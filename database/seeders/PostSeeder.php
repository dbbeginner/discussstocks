<?php

namespace Database\Seeders;

use App\Models\Posts;
use App\Models\Channels;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $channels = Channels::where('type', '=', 'channel')->get();
        $userCount = count(User::all());

        foreach($channels as $channel) {
            $i = 0;
            $articles = random_int(0, 6);
            while($articles != $i) {
                $post = new Posts;
                $faker = Factory::create();
                $post->title = $faker->catchPhrase();
                $post->content = $faker->paragraphs(3, true);
                $post->user_id = random_int(4, $userCount);
                $post->parent_id = random_int(1, count($channels));
                $post->save();
                $i++;
            }
        }
    }
}
