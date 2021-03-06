<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mention extends Model
{
    use HasFactory;

    protected $table = 'mentions';
    public $timestamps = true;
    public $converter;

    protected $fillable = [
        'content_id', 'user_id', 'ticker_id',
    ];

    // Stock mentions model - any time a stock is mentioned elsewhere on the site, that reference will be stored here
    // and eventually, we'll poll an API for the latest price at the time of the mention.

}
