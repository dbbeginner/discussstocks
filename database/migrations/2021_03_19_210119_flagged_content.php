<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FlaggedContent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('content_flagged');
        Schema::create('content_flagged', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('content_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('reporter_id')
                ->comment('the user_id of the user who reported it');
            $table->text('reason');
            $table->softDeletes();
            $table->timestamps();
            $table->index('content_id');
            $table->index('user_id');
            $table->index('reporter_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('content_flagged');
    }
}
