<?php

use App\Models\Preference;

function preference($setting_name, $default = null) {
    if(Auth::guest()) {
        $user_id = 1; }
        else { $user_id = Auth::user()->id;
    }

    $result = Preference::where('setting', '=', $setting_name)->where('user_id', '=', $user_id)->first();

    if(!$result){
        return $default;
    }
    return $result->value;
}