<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use App\Http\Controllers\PostController;
use App\Models\User;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    //

    public function create(){
        return view('verification-request');
    }

    public function verify(Request $request){
        $user = User::where('token', '=', $request->token)->first();
        if(!$user){
            return view('accounts.verify')->with('message', 'Token not found so verification failed. Want a new token sent?');
        }
        $user->token = null;
        $user->active = true;
        $user->save();
        return view('accounts.verify')->with('message', 'Token not found so verification failed. Want a new token sent?');
    }
}
