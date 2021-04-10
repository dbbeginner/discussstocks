<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Vinkla\Hashids\Facades\Hashids;
use App\Models\Preference;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'role',
        'password',
        'email_verified_at',
    ];

    /**
     * Default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'role' => 'unverified',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            $post->token = (string) Str::uuid();
        });

        static::created(function ($post) {

        });

        static::saved( function($model) {

        });
    }

    public function channels()
    {
        return $this->hasMany(Channel::class, 'user_id', 'id');
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'user_id', 'id');
    }

    public function replies()
    {
        return $this->hasMany(Reply::class, 'user_id', 'id');
    }
    public function votes()
    {
        return $this->hasMany(Votes::class, 'user_id');
    }

    public function preferences()
    {
        return $this->hasMany(Preference::class, 'user_id');
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscriptions::class, 'user_id', 'id');
    }


    public function hashId()
    {
        return Hashids::encode( $this->id );
    }

    public function fromHashId( $hash_id)
    {
        return User::where('id','=', Hashids::decode( $hash_id ))->first();
    }

    public function hasBeenActivated()
    {
        if($this->email_verified_at === null) {
            return false;
        }
        return true;
    }

    public function isSubscribedTo( $channel_id )
    {
        return Subscriptions::where('user_id', '=', $this->id)
            ->where('content_id', '=', $channel_id)
            ->get()
            ->count();
    }

    public function getSubscriptionsForUser()
    {
        return $this->hasMany(Subscriptions::class, 'user_id', 'id')->pluck('content_id');
    }

}
