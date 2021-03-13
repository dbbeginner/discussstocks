<?php

use App\Models\Settings;

function setting($setting_name, $default = null) {
    if(Auth::guest()) {
        $user_id = 1; }
        else { $user_id = Auth::user()->id;
    }

    $result = Settings::where('setting', '=', $setting_name)->where('user_id', '=', $user_id)->first();

    if(!$result){
        return $default;
    }
    return $result->value;
}