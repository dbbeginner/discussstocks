<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Vinkla\Hashids\Facades\Hashids;
use App\Models\Settings;

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
        'password',
    ];

    /**
     * Default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'active' => false,
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
            // Duplicate the guest users settings and apply to this user
            $defaultSettings = Settings::where('user_id', '=', '1')->get();

            foreach($defaultSettings as $setting){
                $save = new Settings;
                $save->user_id = $post->id;
                $save->setting = $setting->setting;
                $save->value = $setting->value;
                $save->save();
            }
        });

        static::saved( function($model) {

        });
    }

    public function channel()
    {
        return $this->hasMany(Channel::class, 'user_id', 'id');
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'user_id', 'id');
    }

    public function replies()
    {
        return $this->hasMany(Replies::class, 'user_id', 'id');
    }
    public function votes()
    {
        return $this->hasMany(Votes::class, 'user_id');
    }

    public function settings() {
        return $this->hasMany(Settings::class, 'user_id');
    }

    public function subscriptions() {
        return $this->hasMany(Subscriptions::class, 'user_id', 'id');
    }


    public function hashId() {
        return Hashids::encode( $this->id );
    }

    public function fromHashId( $hashId) {
        return User::where('id','=', Hashids::decode($hashId))->first();
    }

    public function isSubscribedTo($channel_id) {
        return Subscriptions::where('user_id', '=', $this->id)
            ->where('content_id', '=', $channel_id)
            ->get()
            ->count();
    }
    public function subscribed()
    {
        return $this->hasMany(Subscriptions::class, 'user_id', 'id');
    }


}
