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
        // null password should prevent logins with this user_id
        DB::table('users')->insert([
            'id' => '1',
            'name' => 'Guest',
            'email' => 'guest@example.com',
            'password' => null,
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
