<?php

namespace App\Importers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\StockTicker;

class StockInfo
{

    public $user;

    public function __construct()
    {
        if(Auth::guest()) {
            $this->user = "Guest (ID: 1)";
        } else {
            $this->user = Auth::user()->name . ' (ID: '. Auth::user()->id . ')';
        }

    }

    public function getFromTicker($ticker) {
        log::info("$ticker: Looking up ticker for " . $this->user);

        $stock = StockTicker::where('ticker', '=', $ticker)->first();

        if($stock) {
            log::info("$ticker: Found in database");
            return $stock->id;
        }

        $externalData = $this->queryApiByTicker($ticker);
        log::info("$ticker: Querying FMP for information");

        if($externalData){
            $stock = StockTicker::create([
                'ticker' => $ticker,
                'name' => $externalData['companyName'],
                'isin' => $externalData['isin'],
                'cusip' => $externalData['cusip'],
                'industry' => $externalData['industry'],
                'description' => $externalData['description'],
                'exchange' => $externalData['exchange'],
                'exchangeShortName' => $externalData['exchangeShortName'],
            ]);
            log::info(" $ticker: Stored in database for future use");

            return $stock->id;
        }




        Log::info("$ticker: unable to find in external service");
        return false;

    }

    private function queryApiByTicker($ticker){
        $json = file_get_contents('https://financialmodelingprep.com/api/v3/profile/' . $ticker . '?apikey=' . config('api.fmp'));

        $array = json_decode($json, true);

        if(array_key_exists(0, $array)) {
            return $array[0];
        }

        return false;

    }

}