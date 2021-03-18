<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use App\Mail\ConfirmEmailAfterRegistration;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Mail;

class RegistrationController extends Controller
{
    //

    public function create(){
        return view('accounts.register');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'alpha_num|unique:users',
            'email' => 'email|unique:users',
            'password' => 'min:8|confirmed'
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password'))
        ]);

        Mail::to($request->input('email'))->send(new ConfirmEmailAfterRegistration($user));

        return redirect::to('/')->with('success', 'Account created. Check your email for a link to activate your account');
    }
}
