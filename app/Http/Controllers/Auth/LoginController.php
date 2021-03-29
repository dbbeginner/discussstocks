<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function create(){
        return view('auth.login');
    }

    public function store(Request $request){
        $user = $this->retrieveUserRecord($request);

        if($user && Auth::attempt(['name' => $user->name, 'password' => $request->password], $request->remember)) {

            if(null === $user->email_verified_at) {
                Auth::logout();

                $request->session()->invalidate();

                $request->session()->regenerateToken();

                return redirect()->to('/')->with('error', 'Account is not <a href="/verify">verified</a> yet.');
            }

            $request->session()->regenerate();

            return redirect()->to($request->current)->with('success', 'Login succeeded');
        }
        return redirect()->back()->with('warning', 'Login failed with these credentials.');
    }



    private function retrieveUserRecord(Request $request){
        $user = User::where('name', '=', $request->username)->first();

        if(!isset($user->id)) {
            $user = User::where('email', '=', $request->username)->first();
        }

        if(!$user) {
            return false;
        }

        return $user;
    }


    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->to('/')->with('success', 'Logged out');
    }
}
