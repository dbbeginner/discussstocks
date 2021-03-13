<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;
use League\CommonMark\CommonMarkConverter;
use League\CommonMark\Environment;
use League\CommonMark\Extension\Table\TableExtension;
use Mews\Purifier\Facades\Purifier;
use Vinkla\Hashids\Facades\Hashids;

// The Content table is the main storage repository for this application, and holds Channels, Posts and Replies.
// While the content model provides the underlying functionality, it is extended by the Channels, Posts and Replies models
// which provide their own specific logic for their types of data.

// It has a number of methods that we can access from other models, or that automatically run when another model saves
// its data:
//

//
// Any post, channel or reply that is created automatically is given an upvote from the user that created it.

class Content extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'content';
    public $timestamps = true;
    public $converter;
    public $hashids;

    // load the CommonMark environment in order to display posts using MarkDown libraries to format them back to HTML
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $environment = Environment::createCommonMarkEnvironment();

        $environment->addExtension(new TableExtension);

        $this->converter = new CommonMarkConverter([
            'allow_unsafe_links' => false,
            'max_nesting_level' => 5,
            'html_input' => 'escape'


        ], $environment);
    }

    protected static function boot()
    {
        parent::boot();
        static::saving(function($model){

//          The DetectScripts method scans any content for the string <script>, and if it detects that,
//          automatically flags the content as questionable.
            if($model->title != $model->detectScripts($model->title)) {
                $model->flagged_by_user_id = 1;
                $model->flagged_reason = "detected unknown script";
                $model->deleted_at = now();
            };

//            Generate a more SEO friendly slug for the content. This data is indexed but it's not unique,
//            meaning multiple people can have posts of the same title.
            $model->slug = Str::slug($model->title);
        });

        static::created(function($model){
            // Add initial upvote from user that created the content
            $vote = new Votes;
            $vote->content_id = $model->id;
            $vote->user_id = $model->user_id;
            $vote->vote = 1;
            $vote->swept_at = null;
            $vote->save();
        });

        static::saved(function($model){
            // scans the content for any stock symbols (identified by '$' plus a string of letters)
            $model->StoreStockMentions($model);
        });
    }

    // scan each word of each post for a stock mention, which is $ followed by letters.
    // If the post has mentions in it, save these to the mentions table.
    // To do: return the fact that mentions existed to the controller so we can ask for sentiment.
    // To do: get a realtime quote of the stock to store in the mentions table.
    public function StoreStockMentions($model) {
        $strings = explode(' ', $model->content);
        foreach ($strings as $string){

            $string = preg_replace("/[^a-zA-Z\$]/", "", $string);

            if(str_starts_with($string, '$')){
                $string = str_replace('$', "", $string);
                if(is_numeric($string)){
                    return;
                } else {
                    $mention = new \App\Models\Mentions;
                    $mention->content_id = $model->id;
                    $mention->user_id = $model->user_id;
                    $mention->ticker = strtoupper($string);
                    $mention->save();
                }
            }
        }
    }



    public function detectScripts($input){
        return preg_replace('#<script(.*?)>(.*?)</script>#is', '', $input);
    }


    // The prunes images out of markdown posts. The last thing I want is someone spamming comments with bad images
    public function FormattedContent() {
        return Purifier::clean(new HtmlString($this->converter->convertToHtml($this->content)));
    }

    public function TruncatedContent($length = 300){

            // return with no change if string is shorter than $limit
            if(strlen($this->content) <= $length) {
                return $this->content;
            }

            // is $break present between $limit and the end of the string?
            if(false !== ($breakpoint = strpos($this->content, " ", $length))) {
                if($breakpoint < strlen($this->content) - 1) {
                    $this->content = substr($this->content, 0, $length) . "...";
                }
            }

            return $this->content;
    }

    // Outputs the full URL to a given content
    public function url(){
        $prefix = null;
        switch ($this->type) {
            case 'channel':
                $prefix = 'c';
                break;
            case 'post':
                $prefix = 'p';
                break;
            case 'reply':
                $prefix = 'r';
                break;
        }
        return config('app.url') . "/$prefix/" . $this->slug . '/' . Hashids::encode($this->id);
    }

    // Outputs the shortened URL (only the encoded hash_id) of a piece of content
    public function shortUrl(){
        return config('app.url') . '/' . Hashids::encode($this->id);
    }

    // Outputs the hashed Id of a contents ID for display in user facing pages
    public function hashid(){
        return Hashids::encode($this->id);
    }

    public function children()
    {
        return $this->hasMany(Content::class, 'parent_id', 'id');
    }

    public function parent(){
        return $this->hasOne(Content::class, 'id', 'parent_id');
    }

    // this iterates through parents of a content record in order to find the parent record of the given type.
    // for instance, this can be used to find what post a child reply belongs to, or even what channel that reply
    // belongs to.
    public function parentByType($type, $id = null){

        if($this->parent()->first()->type == $type) {
            return $this->parent()->first();
        }
        return $this->parent()->first()->parentByType($type);
    }

}