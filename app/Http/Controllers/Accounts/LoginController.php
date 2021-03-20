<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function create(){
        return view('accounts.login');
    }

    public function store(Request $request){
        $user = $this->retrieveUserRecord($request);
        if($user && Auth::attempt(['name' => $user->name, 'password' => $request->password, 'active' => 1], $request->remember)) {
            $request->session()->regenerate();
            return redirect()->to($request->current)->with('success', 'Login succeeded');
        }
        return redirect()->back()->with('warning', 'Login failed for this username and password. Did you forget to <a href="/verify">verify</a> your account?');
    }

    private function retrieveUserRecord(Request $request){
        $user = User::where('name', '=', $request->username)->first();
        if(!isset($user->id)) {
            $user = User::where('email', '=', $request->username)->first();
        }
        return $user;
    }

    public function destroy(Request $request){
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->to('/')->with('success', 'Logged out');
    }
}
