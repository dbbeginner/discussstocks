<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscriptions extends Model
{
    use HasFactory;

    protected $table = 'subscriptions';

    public $timestamps = true;

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function channel()
    {
        return $this->hasOne(Channels::class, 'id', 'parent_id');
    }

}
