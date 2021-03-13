<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Posts;
use App\Models\User;
use App\Models\Replies;
use Faker\Factory;

class ReplySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $posts = Posts::where('type', '=', 'post')->orWhere('type', '=', 'image')->get();
        $userCount = count(User::all());

        foreach ($posts as $post) {

            $i = random_int(1, 8);

            while($i < 6) {
                $comment = new Replies;
                $faker = Factory::create();

                $comment->parent_id = $post->id;
                $comment->title = $faker->catchPhrase();
                $comment->content = $faker->paragraphs(5, true);
                $comment->user_id = random_int(1, $userCount);
                $comment->save();
                $i++;

            }
        }
    }
}
