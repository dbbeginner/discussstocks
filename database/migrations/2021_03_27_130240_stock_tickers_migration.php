<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StockTickersMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('stock_tickers');
        Schema::create('stock_tickers', function (Blueprint $table) {
            $table->id();
            $table->string('ticker')
                ->unique();
            $table->string('isin')
                ->unique();
            $table->string('cusip')
                ->unique();
            $table->string('name')
                ->unique()
                ->nullable();
            $table->string('industry')
                ->index()
                ->nullable();
            $table->mediumText('description')
                ->nullable();
            $table->string('exchange')
                ->nullable();
            $table->string('exchangeShortName')
                ->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('stock_tickers');

    }
}
