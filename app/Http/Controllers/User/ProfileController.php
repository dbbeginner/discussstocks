<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    //

    public function index(Request $request) {
        return view('user.view', [
            'user' => User::where('id', '=', Auth::user()->id)->first(),
        ]);
    }

    public function edit(Request $request) {
        return view('user.edit', [
            'user' => User::where('id', '=', Auth::user()->id)->first(),
        ]);
    }

    public function verify(Request $request){
        $request->validate([
            'show' => 'required',
            'bio' => 'max:1000'
        ]);


        $data = $request->all();
        $user = User::where('id', '=', Auth::user()->id)->first();

        $data['name'] = $user->name;
        $data['email'] = $user->email;

        return view('user.verify', $data );
    }

    public function store(Request $request){
        $request->validate([
            'show' => 'required',
            'bio' => 'max:1000'
        ]);

        if($request->input('show') == 'true') {
            $display_email = true;
        } else {
            $display_email = false;
        }

        User::where('id', '=', Auth::user()->id)->update([
            'bio' => $request->input('bio'),
            'display_email' => $display_email,
        ]);

        return redirect('/user/profile')->with('success', 'User record updated');
    }


}
