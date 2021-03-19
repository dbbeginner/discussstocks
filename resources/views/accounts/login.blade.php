@extends('template.template')

@section('content')
    <p>
        Placeholder text goes here. Fill it in however you want to do and have fun!
    </p>
    <div style="width: 100%; display: inline-block; margin-bottom: 20pt;">
        <form class="col-md-6 offset-md-3 bg-tertiary" method="post" action="/login">
            <div class="form-group">
                <label for="InputUsername">Username or Email Address</label>
                <input name="username" type="text" class="form-control form-control-sm" id="InputUsername" aria-describedby="usernameHelp" placeholder="Enter username or email" value="{{ old('name') }}">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>

            <div class="form-group">
                <label for="InputPassword">Password</label>
                <input name="password" type="password" class="form-control form-control-sm" id="InputPassword" placeholder="Password">
            </div>

            <input type="hidden" name="_token" value="{{ csrf_token() }}" />

            <button type="submit" class="btn btn-primary" style="margin-bottom: 15pt;">Login</button>
        </form>
    </div>
@stop
