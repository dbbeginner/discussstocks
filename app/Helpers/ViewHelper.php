<?php

namespace App\Helpers;

use Illuminate\Support\Facades\View;

class ViewHelper
{
    public static function showPosts($data, $title = null) {
        $count = $data->count();
        $content = $data->simplePaginate( setting('pagination', 10) );

        if( $count < setting('pagination') - 1) {
            $notice = "There aren't many posts here. Perhaps you want to <a href=\"/user/subscriptions\">subscribe</a> to more channels?";
        } else {
            $notice = null;
        }
        return view('posts', ['title' => $title, 'posts' => $content, 'count' => $count, 'notice' => $notice]);
    }

}