@extends('template')

@section('title')
Forgotten Password
@stop

@section('content')
    <div class="content">

        <p>
        Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
        </p>

        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <!-- Email Address -->
                <div class="form-group">
                    <label for="InputUsername">Email Address</label>
                    <input name="email" type="text" class="form-control form-control-lg" id="InputUsername" aria-describedby="usernameHelp" placeholder="user@example.com" value="{{ old('name') }}">
                    <small id="emailHelp" class="form-text text-muted">Submitting this form means you consent to receiving a password reset email</small>
                </div>

                @error('email')
                <div class="validation-feedback alert alert-danger">{{ $message }}</div>
                @enderror

                <button type="submit" class="btn btn-primary" style="margin-bottom: 15pt;">Send Password Reset</button>

        </form>
    </div>
@stop
