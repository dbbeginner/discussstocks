<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubscriptionManager extends Controller
{
    //

public function viewSubscriptions(Request $request) {
        return Auth::user()->id;
    }
}
