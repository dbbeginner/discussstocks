<?php

namespace App\Http\Controllers;

use App\Rules\validTimeZoneBySymbol;
use Illuminate\Http\Request;
use App\Models\Settings;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserSettingsController extends Controller
{
    //

    public function index(Request $request) {

        $data['timezones'] = $this->loadTimezonesFromJson();

        return view('user.settings', $data);

    }


    private function loadTimezonesFromJson() {
        return json_decode(Storage::disk('resources')->get('timezones.json'), TRUE);
    }

    private function validateTimezoneEntry($input) {
        $values = $this->loadTimezonesFromJson();

        foreach ($values as $v) {
            if ($input == $v['symbol']) {
                return true;
            }
        }
        return false;
    }
    
    /**
     * Store user settings.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request){
        $request->validate([
            'pagination' => ['required', 'integer', 'between:10,20'],
            'timezone' => ['required', new validTimeZoneBySymbol ],
            ]);

        $this->saveSetting(Auth::user()->id, 'pagination', $request->input('pagination'));

        $this->saveSetting(Auth::user()->id, 'timezone', $request->input('timezone'));

        return redirect()->back()->with('success', 'settings saved!');

    }

    public function saveSetting($user_id, $setting, $value) {
        $settings = Settings::where('user_id', '=', $user_id)
            ->where('setting', '=', $setting)
            ->first();

        $settings->value = $value;

        $settings->save();

    }
}
