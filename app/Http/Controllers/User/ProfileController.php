<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    //

    public function index()
    {
        return view('user.view', [
            'user' => User::where('id', '=', Auth::user()->id)->first(),
        ]);
    }

    public function edit(Request $request)
    {
        return view('user.edit', [
            'user' => User::where('id', '=', Auth::user()->id)->first(),
        ]);
    }

    public function verify(Request $request)
    {
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
            'bio' => 'max:1000'
        ]);

        User::where('id', '=', Auth::user()->id)->update([
            'bio' => $request->input('bio'),
        ]);

        return redirect('/user/profile')
            ->with('success', 'User record updated');
    }
}
