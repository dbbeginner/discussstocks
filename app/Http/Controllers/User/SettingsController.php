<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Rules\validTimeZoneBySymbol;
use Illuminate\Http\Request;
use App\Models\Preference;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    //

    public function index(Request $request) {

        $data['pagination'] = null;  // numeric field
        $data['timezones'] = $this->loadTimezonesFromJson();
        $data['assets'] = ['local', 'hosted'];
        $data['analytics'] = ['Google', 'Matomo'];
        $data['advertising'] = ['yes', 'no'];
        $data['display_email'] = ['yes', 'no'];
        $data['share_email'] = ['yes', 'no'];
        $data['receive_email'] = ['yes', 'no'];

        return view('settings.preferences', $data);

    }


    private function loadTimezonesFromJson() {
        return json_decode(Storage::disk('resources')->get('timezones.json'), TRUE);
    }

    /**
     * Store user settings.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request){
        $validated = $request->validate([
            'pagination' => ['required', 'integer', 'between:10,50'],
            'timezone' => ['required', new validTimeZoneBySymbol ],
            'assets' => ['required', 'in:local,hosted'],
            'advertising' => ['required', 'in:yes,no'],
            'analytics' => ['required', 'in:Google,Matomo'],
            'display_email' => ['required', 'in:yes,no'],
            'share_email' => ['required', 'in:yes,no'],
            'receive_email' => ['required', 'in:yes,no'],
            ]);


        foreach($validated as $setting => $value) {
            $this->saveSetting(Auth::user()->id, $setting, $value);
        }

        return redirect()->back()->with('success', 'settings saved!');

    }

    public function saveSetting($user_id, $setting, $value) {
        $preference = Preference::where('user_id', '=', $user_id)
            ->where('setting', '=', $setting)
            ->first();

        // if the user already has this preference store, update the value. If it's a new preference that doesn't exist
        // yet, then we need to create a new key and value for it.
        if($preference) {
            $preference->value = $value;
            $preference->save();
        } else {
            Preference::create([
                'user_id' => $user_id,
                'setting' => $setting,
                'value' => $value
            ]);
        }

    }

}
