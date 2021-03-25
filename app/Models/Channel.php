<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Scopes\ChannelScope;
use App\Models\Subscriptions;
use Illuminate\Support\Facades\Auth;

// The Channels model extends the Content model and stores its data in the Content table.
// Scope insures that calls to All channels returns only Channels, and not other data stored in the database.

class Channel extends Content
{
    use HasFactory;
    use SoftDeletes;

    protected $attributes = [
        'type' => 'channel',
    ];

    protected static function boot()
    {

        parent::boot();

        static::created(function($model){
            // Automatically subscribe a user to the channel that they created.
            Subscriptions::create(['user_id' => Auth::user()->id, 'content_id' => $model->id]);
        });

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
        return $this->hasMany(Post::class, 'parent_id', 'id');
    }

}
