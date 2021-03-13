<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Faker\Factory;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $i = 0;

        while($i != 20) {
            $faker = Factory::create();
            $user = new User;
            $user->name = $faker->firstName . $faker->lastName;
            $user->email = $faker->email;
            $user->password = Hash::make(random_bytes(32));
            $user->save();
            $i++;
        }

    }
}
