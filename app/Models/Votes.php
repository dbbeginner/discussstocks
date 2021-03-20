<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Votes extends Model
{
    use HasFactory;

    protected $table = 'votes';

    protected $primaryKey = 'id';

    protected $touches = [
        'content',
    ];

    protected $fillable = [
        'content_id', 'user_id', 'vote'
    ];

    public $incrementing = true;

    public $timestamps = true;

    public function content()
    {
        return $this->hasOne(Content::class, 'id', 'content_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

}
