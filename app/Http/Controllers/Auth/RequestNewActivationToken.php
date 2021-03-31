<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\ConfirmEmailAfterRegistration;

class RequestNewActivationToken extends Controller
{
    //
    public function create() {
        return view('auth.replace-token');
    }

    public function store(Request $request) {
        $request->validate([
            'email' => 'exists:users,email'
        ]);

        $user = User::where('email', '=', $request->input('email'))->first();

        if($user->hasBeenActivated() == true) {
            return redirect('/')
                ->with('success', 'Account already activated, try logging in');
        }

        $user->token = Str::uuid(4);
        $user->save();

        Mail::to($request->input(['email']))
            ->send(new ConfirmEmailAfterRegistration($user));

        return redirect('/')
            ->with('success', 'Check your email for a new activation link');
    }
}
