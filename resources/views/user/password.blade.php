@extends('template')

@section('title')
    Change your password
@stop

@section('content')
    <form class="form" method="post" action="/user/password">
        <div class="content">
            <h5>Current Password</h5>
            <div class="form-group">
                <input class="form-control" type="password" name="old" id="old">
            </div>
            @error('old')
            <div class="validation-feedback  alert alert-danger">{{ $message }}</div>
            @enderror

            <h5>New Password</h5>
            <div class="form-group">
                <input class="form-control" type="password" name="password" id="password">
            </div>
            @error('password')
            <div class="validation-feedback  alert alert-danger">{{ $message }}</div>
            @enderror

            <h5>Verify</h5>
            <div class="form-group">
                <input class="form-control" type="password" name="verify" id="verify">
            </div>




            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <input type="reset" class="btn btn-secondary" value="Reset" />
            <input type="submit" class="btn btn-success" value="submit" />
        </div>
    </form>
@stop
