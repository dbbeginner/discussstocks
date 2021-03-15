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

        $urls = array('https://apple.com', 'https://cnbc.com/', 'https://yahoo.finance', 'http://bloomberg.com/',
            'https://investopedia.com/', 'https://marketwatch.com/', 'https://bankrate.com');

        foreach($channels as $channel) {
            $i = 0;

//            Insert a URL link first
            $post = new Posts;
            $faker = Factory::create();
            $post->title = $faker->catchPhrase();
            $post->content = $urls[random_int(0, count($urls) -1)];
            $post->user_id = random_int(4, $userCount);
            $post->parent_id = $channel->id;
            $post->save();
            $i++;


            $articles = random_int(2, 6);
            while($articles != $i) {
                $post = new Posts;
                $faker = Factory::create();
                $post->title = $faker->catchPhrase();
                $post->content = $faker->paragraphs(3, true);
                $post->user_id = random_int(4, $userCount);
                $post->parent_id = $channel->id;
                $post->save();
                $i++;
            }
        }
    }
}
