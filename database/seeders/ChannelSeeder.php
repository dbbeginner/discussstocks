<?php

namespace Database\Seeders;

use App\Models\Channel;
use Faker\Factory;
use Illuminate\Database\Seeder;
use App\Models\User;

class ChannelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $userCount = User::all()->count();

        $channel_titles = [
            "dbbeginners Channel",
            "Stocks",
            "Bonds",
            "IPO",
            "Crypto",
        ];

        foreach($channel_titles as $title) {
            $faker = Factory::create();
            $category = new Channel;

            $paragraphs = rand(1, 5);
            $i = 0;
            $data = "";
            while ($i < $paragraphs) {
                $data .= $faker->paragraph(rand(4, 5)) . "\n\n";
                $i++;
            }

            $category->title = $title;
            $category->user_id = random_int(1, $userCount);
            $category->content = $data;
            $category->published_at = now();
            $category->save();
        }
    }
}
