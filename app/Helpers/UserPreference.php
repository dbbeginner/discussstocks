<?php

use App\Models\Preference;

function user_preference($setting_name, $default = null, $user_id) {

    $result = Preference::where('setting', '=', $setting_name)->where('user_id', '=', $user_id)->first();

    if(!$result){
        return $default;
    }
    return $result->value;
}