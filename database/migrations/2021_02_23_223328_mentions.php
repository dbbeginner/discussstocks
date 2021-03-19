<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Mentions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('mentions');
        Schema::create('mentions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('content_id')
                ->index();
            $table->unsignedBigInteger('user_id')
                ->index();
            $table->string('ticker')
                ->index();
            $table->integer('sentiment')
                ->nullable()
                ->comment('Id like this to be a slider, where when a user mentions a stock, they get a popup and drag the slider left to right to indicate how strongly they feel about it');
            $table->timestamps();
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
        Schema::dropIfExists('mentions');
    }
}
