<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class CreateSystemUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Creates a system user with ID 2 to be default owner of any records not created by actual users
        // Password should be unguessable this way.
        $user = new \App\Models\User;
        $user->name = 'System User';
        $user->email = 'system@example.com';
        $user->role = 'guest';
        $user->active = false;
        $user->password = Hash::make(hash( "sha256", random_bytes(64)));
        $user->save();



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('system_user');
    }
}
