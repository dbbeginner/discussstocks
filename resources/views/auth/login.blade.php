@extends('template')

@section('title')
    Login Form
@stop

@section('content')
    <div class="content">
        <div style="width: 100%; display: inline-block; margin-bottom: 20pt;">
            <form method="post" action="/login">
                <div class="form-group">
                    <label for="InputUsername">Username or Email Address</label>
                    <input name="username" type="text" class="form-control form-control-lg" id="InputUsername" aria-describedby="usernameHelp" placeholder="Enter username or email" value="{{ old('name') }}">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>

                <div class="form-group">
                    <label for="InputPassword">Password</label>
                    <input name="password" type="password" class="form-control form-control-lg" id="InputPassword" placeholder="Password">
                </div>

                <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                <button type="submit" class="btn btn-primary" style="margin-bottom: 15pt;">Login</button>
            </form>
        </div>
    </div>
@stop
