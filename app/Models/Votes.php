<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Votes extends Model
{
    use HasFactory;

    protected $table = 'votes';

    protected $primaryKey = 'id';

    public $incrementing = true;

    public $timestamps = true;

    public function post()
    {
        return $this->hasOne(Posts::class, 'id', 'content_id');
    }

    public function reply()
    {
        return $this->hasOne(Replies::class, 'id', 'content_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

}
