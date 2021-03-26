<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class EmailController extends Controller
{
    //

    public function index(Request $request) {

        return view('user.email', [
            'user' => User::where('id', '=', Auth::user()->id)->first(),
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'email' => 'required|email|same:verify',
        ]);

        $user = User::where('id', '=', Auth::user()->id)
            ->update([
                'email' => $request->input('email'),
                ]);

        return redirect('/user/profile')->with('success', 'Email address has been updated');
    }

}
