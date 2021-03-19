<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;

class CreateGuestUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        DB::table('users')->insert([
            'id' => '1',
            'name' => 'Guest',
            'active' => false,
            'email' => 'guest@example.com',
            'password' => Hash::make(hash( "sha256", random_bytes(64))),
            'role' => 'guest',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
