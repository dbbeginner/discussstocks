<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ContentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('content');
        Schema::create('content', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_id')
                ->nullable();
            $table->unsignedBigInteger('user_id');
            $table->string('type')
                ->nullable();
            $table->string('subtype')
                ->nullable();
            $table->string('title')
                ->nullable();
            $table->longText('content')
                ->nullable();
            $table->string('slug', 128)
                ->nullable();
            $table->integer('reply_count')
                ->default(0);
            $table->integer('total_votes')
                ->default(0);
            $table->integer('total_upvotes')
                ->default('0');
            $table->timestamps();
            $table->softDeletes();
            $table->index('parent_id');
            $table->index('type');
            $table->index('slug');
            $table->index(['user_id', 'type'], 'content_by_user');
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
        Schema::dropIfExists('content');
    }
}
