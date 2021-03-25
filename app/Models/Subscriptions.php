<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscriptions extends Model
{
    use HasFactory;

    protected $table = 'subscriptions';

    public $timestamps = true;

    protected $fillable = [
        'user_id', 'content_id'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function channel()
    {
        return $this->hasOne(Channel::class, 'id', 'parent_id');
    }

}
