<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use phpDocumentor\Reflection\Types\False_;

class RegistrationController extends Controller
{
    //

    public function create(){
        return view('register');
    }

    public function register(Request $request){
        $input = $request->all();
        if($this->isEmailValid($input['email']) === false) {
            return Redirect::back()->with('error', $input['email'] . ' is not a valid email');
        }

        if($this->isEmailUnique($input['email']) === false) {
            return Redirect::back()->with('error', $input['email'] . ' is not unique');
        }

        if($this->validateName($input['name']) === false) {
            return Redirect::back()->with('error', $input['name'] . ' contains illegal characters');
        }

        if(strlen($input['password']) < 8) {
            return Redirect::back()->with('error', 'Password must be 8 or more characters');
        }

        if($input['password'] !== $input['verify']) {
            return Redirect::back()->with('error', 'Passwords must match');
        }

        $user = new User;
        $user->email = $input['email'];
        $user->name = $input['name'];
        $user->password = Hash::make($input['password']);
        $user->save();

        return redirect::to('/')->with('success', 'Account created. Check your email for a link to activate your account');
    }

    public function isEmailValid($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        return true;
    }

    public function isEmailUnique($email) {
        $count = User::where('email', '=', $email)->count();
        if ($count == 0) {
            return true;
        }
        return false;
    }

    public function validateName($name) {
        if(preg_match('/^[[:alnum:]]+$/', $name)) {
            return true;
        }
        return false;
    }

}
