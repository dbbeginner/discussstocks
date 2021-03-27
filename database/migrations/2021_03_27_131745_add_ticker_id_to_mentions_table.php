<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTickerIdToMentionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mentions', function (Blueprint $table) {
            //
            $table->dropIndex('mentions_ticker_index');
            $table->dropColumn('ticker');

            $table->unsignedBigInteger('ticker_id')
                ->after('user_id');
            $table->index('ticker_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mentions', function (Blueprint $table) {
            //
            $table->dropIndex('mentions_ticker_id_index');
            $table->dropColumn('ticker_id');

            $table->string('ticker')
                ->index();
        });
    }
}
