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

        $data['timezones'] = $this->loadTimezonesFromJson();
        $data['assets'] = ['local', 'hosted'];
        $data['analytics'] = ['Google', 'Matomo'];
        $data['advertising'] = ['yes', 'no'];

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
        $request->validate([
            'pagination' => ['required', 'integer', 'between:10,50'],
            'timezone' => ['required', new validTimeZoneBySymbol ],
            'assets' => ['required', 'in:local,hosted'],
            'advertising' => ['required', 'in:yes,no'],
            'analytics' => ['required', 'in:Google,Matomo'],
            ]);

        $this->saveSetting(Auth::user()->id, 'pagination', $request->input('pagination'));

        $this->saveSetting(Auth::user()->id, 'timezone', $request->input('timezone'));

        $this->saveSetting(Auth::user()->id, 'assets', $request->input('assets'));

        $this->saveSetting(Auth::user()->id, 'advertising', $request->input('advertising'));

        $this->saveSetting(Auth::user()->id, 'analytics', $request->input('analytics'));

        return redirect()->back()->with('success', 'settings saved!');

    }

    public function saveSetting($user_id, $setting, $value) {
        $settings = Preference::where('user_id', '=', $user_id)
            ->where('setting', '=', $setting)
            ->first();

        $settings->value = $value;

        $settings->save();

    }

}
