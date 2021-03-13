<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;


// Replies extends the Content model and stores its data in the content table with type set as Reply.
class Replies extends Content
{
    use HasFactory;
    use SoftDeletes;

    protected $attributes = [
        'type' => 'reply',
    ];

//    Any time a Reply is created or modified, it touches the updated_at timestamp of its parent, whether that's a
//    a post or another reply
    protected $touches = [
        'post', 'parent'
    ];

//    Each reply belongs to a single post
    public function post()
    {
        return $this->belongsTo(Posts::class, 'parent_id', 'id');
    }
//    Each reply belongs to a single user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
//    Each reply can have many votes
    public function votes()
    {
        return $this->hasMany(Votes::class, 'content_id', 'id');
    }

//    Each reply can have its own replies
    public function replies()
    {
        return $this->hasMany(Replies::class, 'parent_id', 'id');
    }

//    Each replies reply can have its own replies also, and so on.
    public function repliesWithChildren()
    {
        return $this->hasMany(Replies::class, 'parent_id')->with('replies');
    }

    protected static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub
        static::saving(function ($model) {
        });

        static::saved(function($model){
            // This goes through related models until it finds the parent of the type specified, and increases the
            // parent's comment count by one.
            // In this case, we're increasing the comment count of the parent post by one
            $parent = $model->parentByType('post');
            $content = Content::where('id', $parent->id)->first();
            if($content) {
                $content->reply_count = $content->reply_count + 1;
                $content->save();
            }
        });
    }
}