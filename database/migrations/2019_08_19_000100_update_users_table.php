<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function($table) {
            $table->string('role')
                ->after('email')
                ->nullable()
                ->index();
            $table->boolean('active')
                ->default(false)
                ->after('email')
                ->index();
            $table->uuid('token')
                ->after('active')
                ->nullable()
                ->index();
            $table->unique('name', 'unique_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function($table) {
            $table->dropColumn('active');
            $table->dropIndex('unique_name');

        });
    }
}
