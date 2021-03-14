<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Scopes\ChannelScope;

// The Channels model extends the Content model and stores its data in the Content table.
// Scope insures that calls to All channels returns only Channels, and not other data stored in the database.

class Channels extends Content
{
    use HasFactory;
    use SoftDeletes;

    protected $attributes = [
        'type' => 'channel',
    ];

    protected static function boot()
    {

        static::addGlobalScope(new ChannelScope());

        parent::boot();

        static::saving(function($model){
        });

        static::saved(function($model){
        });
    }

    public function scopeActive($query) {
        return $query->where('flagged_at', '=', null);
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
