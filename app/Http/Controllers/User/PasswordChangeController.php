<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Rules\checkCurrentPassword;

class PasswordChangeController extends Controller
{
    //

    public function index(Request $request) {

        return view('user.password');
    }

    public function store(Request $request){
        $request->validate([
            'old' => ['required', new checkCurrentPassword],
            'password' => 'required|min:8|max:72|same:verify',
        ]);

        $user = User::where('id', '=', Auth::user()->id)->first();
        $user->password = Hash::make($request->input('password'));
        $user->save();

        return redirect('/user/profile')->with('success', 'Your password has been updated');
    }

}
