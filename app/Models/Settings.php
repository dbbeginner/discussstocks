<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Settings extends Model
{
    use HasFactory;

    protected $table = 'settings';

    public $timestamps = true;

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}