<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PostController;

class HomepageController extends Controller
{
    //

    public function index(PostController $postController) {
        if(Auth::guest()) {
            return $postController->recentPosts();
        }
        return "registered home page";
    }
}
