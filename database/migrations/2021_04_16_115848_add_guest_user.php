<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

class AddGuestUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        User::create([
            'name' => 'AnonymousVisitor',
            'image' => null,
            'bio' => null,
            'email' => 'null@example.com',
            'role' => 'guest',
            'token' => null,
            'password' => null,
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        User::where('name', '=', 'AnonymousVisitor')->delete();
    }
}
