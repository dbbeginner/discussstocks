<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('settings');

        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('setting');
            $table->string('value');
            $table->timestamps();
            $table->index('user_id');
            $table->unique(['user_id', 'setting']);
        });

        $users = \App\Models\User::all();

        $settings = [
            'pagination' => 10,
            'timezone' => 'UTC',
            'time_display' => '12',
            'date_format'=> 'm/d/Y'
        ];


        foreach ( $users as $user ) {
            foreach ($settings as $key => $value) {
                $setting = new \App\Models\Settings;
                $setting->user_id = $user->id;
                $setting->setting = $key;
                $setting->value = $value;
                $setting->save();
            }
        }
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('settings');

    }
}
