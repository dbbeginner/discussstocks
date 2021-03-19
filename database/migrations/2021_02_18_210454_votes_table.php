<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class VotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('votes');
        Schema::create('votes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('content_id');
            $table->unsignedBigInteger('user_id');
            $table->tinyInteger('vote');
            $table->dateTime('swept_at')
                ->nullable();
            $table->timestamps();
            $table->index('content_id');
            $table->index('user_id');
            $table->index(['content_id', 'swept_at']);
            $table->index(['user_id', 'swept_at']);
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
        Schema::dropIfExists('votes');

    }
}
