<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserActivationController extends Controller
{
    //

    public function create(Request $request) {
        if(!$request->has('token') || $request->input('token') == null) {
            return view('auth.activate');
        }

        return $this->store($request);
    }

    public function store(Request $request) {
        $request->validate([
            'token' => 'required',
        ]);

        $user = User::where('token', '=', $request->input('token'))->first();

        if(!$user) {
            return redirect()
                ->to('/activate')
                ->with('error', 'Token not found. <a href="/activate/replace">Need a new one</a>?');
        }

        $user->email_verified_at = now();
        $user->token = null;
        $user->role = 'registered';
        $user->save();

        return redirect()
            ->to('/')
            ->with('success', 'Account activated!');

    }
}
