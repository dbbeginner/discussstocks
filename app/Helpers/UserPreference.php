<?php

use App\Models\Preference;

function user_preference($user_id, $setting_name, $default = null) {

    $result = Preference::where('setting', '=', $setting_name)->where('user_id', '=', $user_id)->first();

    if(!$result){
        return $default;
    }
    return $result->value;
}