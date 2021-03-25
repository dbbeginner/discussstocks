@extends('template.')

@section('content')
    <form method="post" action="/activate/replace">
        @csrf
        <div class="form-group">
            <label for="token">Request new activation link to your email:</label>
            <input type="email" class="form-control form-control-lg" id="email" name="email" placeholder="you@example.com">
            @error('email')
            <div class="validation-feedback alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <button class="btn btn-success">Request New Token</button>
        </div>
    </form>
@stop

@section('sidebar')

@stop

