<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Scopes\PostScope;

// The Posts extends the Content model stores Posts in the Content table, which can be of different types (article, url)

class Posts extends Content
{
    use HasFactory;
    use SoftDeletes;


//     All posts are stored in Content table as post 'type'.
//     Posts can have subtypes, which indicate whether its an article, URL, etc.
    protected $attributes = [
        'type' => 'post',
        'subtype' => 'article'
        ];

//    Anytime a post is modified, it also modifies the updated_at column in its parent channel
    protected $touches = [
        'channel'
    ];

//    A post can only belong to a single channel
    public function channel()
    {
        return $this->belongsTo(Channels::class, 'parent_id', 'id');
    }

//    A post can only belong to a single user
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

//    A post can have many votes
    public function votes()
    {
        return $this->hasMany(Votes::class, 'content_id');
    }

//    A post can have many replies
    public function replies()
    {
        return $this->hasMany(Replies::class, 'parent_id');
    }

//    Replies can also have many replies
    public function repliesWithChildren()
    {
        return $this->hasMany(Replies::class, 'parent_id', 'id')->with('replies');
    }

    protected static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub

        static::addGlobalScope(new PostScope);

//      If the content of a post is a single validates as a URL, then get the title of the underlying web page,
//      store that as the title of the post, and set the post->subtype as 'url' (this is used by the View to determine
//      which template to use to display the data)
        static::saving(function ($model) {
            if (filter_var(trim($model->content), FILTER_VALIDATE_URL)) {
                $data = file_get_contents($model->content);
                $model->title = preg_match('/<title[^>]*>(.*?)<\/title>/ims', $data, $matches) ? $matches[1] : null;
                $model->subtype = 'url';
            }
        });

        static::saved(function($model){

        });
    }

    public function scopeActive($query) {
        return $query->where('flagged_at', '=', null);
    }

}
