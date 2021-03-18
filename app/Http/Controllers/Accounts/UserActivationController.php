<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserActivationController extends Controller
{
    //

    public function index(Request $request) {
        if(!$request->has('token') || trim($request->input('token')) == null) {
            return view('accounts.activate');
        }

        return $this->update($request);
    }

    public function update(Request $request) {
        $user = User::where('token', '=', $request->input('token'))->first();

        if(!$user) {
            return redirect()->route('activate')->with('error', 'Token not found. <a href="/activate/replace">Need a new one</a>?');
        }

        $user->active = true;
        $user->token = null;
        $user->role = 'registered';
        $user->save();

        return redirect('/')
            ->with('success', 'Your account is activated. You can login now');

    }
}
