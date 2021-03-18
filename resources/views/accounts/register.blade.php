@extends('template.template')

@section('title')
    Account Registration
@stop

@section('content')
    <div style="width: 100%; display: inline-block; margin-bottom: 20pt;">
        <form class="form form-control" method="post" action="/register">
            <div class="form-group">
                <label for="name">Username</label>
                <input name="name" type="text" class="form-control form-control-lg" id="name" aria-describedby="nameHelp" placeholder="Enter username" value="{{ old('name') }}">
                @error('name')
                <div class="validation-feedback alert alert-danger">{{ $message }}</div>
                @enderror
                <small id="emailHelp" class="form-text text-muted">This name will be displayed on the site</small>
            </div>
            <div class="form-group">
                <label for="email">Email address</label>
                <input name="email" type="email" class="form-control form-control-lg" id="InputEmail" aria-describedby="emailHelp" placeholder="user@example.com" value="{{ old('email') }}">
                @error('email')
                <div class="validation-feedback alert alert-danger">{{ $message }}</div>
                @enderror
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input name="password" type="password" class="form-control form-control-lg" id="password" placeholder="Password">
                @error('password')
                <div class="validation-feedback alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="password_confirmation">Verify</label>
                <input name="password_confirmation" type="password" class="form-control form-control-lg" id="password_confirmation" placeholder="Password">
                @error('password_confirmation')
                <div class="validation-feedback alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <button type="submit" class="btn btn-primary" style="margin-bottom: 15pt;">Create Account</button>
        </form>
    </div>
@stop


