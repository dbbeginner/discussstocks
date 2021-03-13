<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

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

        static::saved( function($model) {
            $defaultSettings = \App\Models\Settings::where('user_id', '=', '1')->get();

            foreach($defaultSettings as $setting){
                $save = new \App\Models\Settings;
                $save->user_id = $model->id;
                $save->setting = $setting->setting;
                $save->value = $setting->value;
                $save->save();
            }
        });
    }

    public function channel()
    {
        return $this->hasMany(Channels::class, 'user_id');
    }

    public function posts()
    {
        return $this->hasMany(Posts::class, 'user_id');
    }

    public function replies()
    {
        return $this->hasMany(Replies::class, 'user_id');
    }
    public function votes()
    {
        return $this->hasMany(Votes::class, 'user_id');
    }

    public function settings() {
        return $this->hasMany(Settings::class, 'user_id');
    }
}
