@extends('template')

@section('content')
    <div class="content">
        <form method="post" action="/activate/replace">
            @csrf
            <div class="form-group">
                <label for="token">Please enter your email address. If we have an account registered to that email address, a new activation token will be sent</label>
                <input type="email" class="form-control form-control-lg" id="email" name="email" placeholder="you@example.com">
                @error('email')
                <div class="validation-feedback alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <button class="btn btn-success">Request New Token</button>
            </div>
        </form>
    </div>
@stop

