<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;

class UserActivationController extends Controller
{
    //

    public function create(Request $request) {
        if(!$request->has('token') || $request->input('token') == null) {
            return view('auth.verify');
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
                ->to('/verify')
                ->with('error', 'Token not found. <a href="/verify/replace">Need a new one</a>?');
        }

        $user->email_verified_at = now();
        $user->token = null;
        $user->role = 'registered';
        $user->save();

        return new Response(\redirect()
            ->to( config('app.url') )
            ->with('success', 'Account verified, you can now login'));

    }
}
