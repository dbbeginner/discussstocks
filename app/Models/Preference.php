<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Preference extends Model
{
    use HasFactory;

    protected $table = 'preferences';

    public $timestamps = true;

    protected $fillable = [
        'user_id', 'setting', 'value'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
