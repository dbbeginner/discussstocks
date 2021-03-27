<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StockTicker extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'stock_tickers';

    public $timestamps = true;

    protected $fillable = [
        'ticker', 'isin', 'cusip', 'name', 'industry', 'description', 'exchange', 'exchangeShortName'
    ];

    public function mentions() {
        return $this->hasMany(App\Models\Mention::class, 'ticker_id', 'id');
    }
}