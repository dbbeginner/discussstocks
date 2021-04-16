<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Heartbeat extends Model
{
    use HasFactory;

    protected $table = 'logs_heartbeat';
    public $timestamps = true;

    protected $fillable = [
        'user_id', 'uri', 'useragent',
    ];

    // Stock mentions model - any time a stock is mentioned elsewhere on the site, that reference will be stored here
    // and eventually, we'll poll an API for the latest price at the time of the mention.

}
