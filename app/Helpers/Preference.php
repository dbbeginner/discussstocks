<?php

use App\Models\Preference;
use Illuminate\Support\Facades\Auth;

function preference($setting_name, $default = null) {
    if(Auth::guest()) {
        return $default;
    }

    $result = Preference::where('setting', '=', $setting_name)
        ->where('user_id', '=', Auth::user()->id)
        ->first();

    if(!$result){
        return $default;
    }
    return $result->value;
}