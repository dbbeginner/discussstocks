<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

// The Channels model extends the Content model and stores its data in the Content table.

class Channels extends Content
{
    use HasFactory;
    use SoftDeletes;

    protected $attributes = [
        'type' => 'channel',
    ];

    protected static function boot()
    {
        parent::boot();
        static::saving(function($model){
        });

        static::saved(function($model){
        });
    }

    // Every channel is owned by a single user
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    // Every channel can have multiple posts
    public function posts()
    {
        return $this->hasMany(Posts::class, 'parent_id');
    }

}
