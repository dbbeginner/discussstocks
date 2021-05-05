<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Channel;
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
        $channels = Channel::where('type', '=', 'channel')->get();
        $userCount = count(User::all());

        $urls = array('https://apple.com', 'https://cnbc.com/', 'https://yahoo.finance', 'http://bloomberg.com/',
            'https://investopedia.com/', 'https://marketwatch.com/', 'https://bankrate.com');

        foreach($channels as $channel) {
            $i = 0;

//            Insert a URL link first
            $post = new Post;
            $faker = Factory::create();
            $post->title = $faker->catchPhrase();
            $post->content = $urls[random_int(0, count($urls) -1)];
            $post->user_id = random_int(4, $userCount);
            $post->parent_id = $channel->id;
            $post->published_at = now();
            $post->save();
            $i++;

            //            Insert a URL link first
            $post = new Post;
            $faker = Factory::create();
            $post->title = '<script in  title';
            $post->content = $faker->catchPhrase();;
            $post->user_id = random_int(4, $userCount);
            $post->parent_id = $channel->id;
            $post->published_at = now();
            $post->save();

            //            Insert a URL link first
            $post = new Post;
            $faker = Factory::create();
            $post->title = $faker->catchPhrase();
            $post->content = 'Doesnt start with <script in content';
            $post->user_id = random_int(4, $userCount);
            $post->parent_id = $channel->id;
            $post->published_at = now();
            $post->save();


            $post = new Post;
            $faker = Factory::create();
            $post->title = $faker->catchPhrase();
            $post->content = 'We like Tiptree ($TIPT)';
            $post->user_id = random_int(4, $userCount);
            $post->parent_id = $channel->id;
            $post->published_at = now();
            $post->save();



            $articles = random_int(2, 6);
            while($articles != $i) {
                $post = new Post;
                $faker = Factory::create();
                $post->title = $faker->catchPhrase();
                $post->content = $faker->paragraphs(3, true);
                $post->user_id = random_int(4, $userCount);
                $post->parent_id = $channel->id;
                $post->published_at = now();
                $post->save();
                $i++;
            }
        }
    }
}
