<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FlaggedContent extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'content_flagged';

    public $timestamps = true;

    protected $fillable = [
        'content_id', 'user_id', 'reporter_id', 'reason',
    ];

    public function parent()
    {
        return $this->hasOne(Content::class, 'id', 'content_id');
    }

}
