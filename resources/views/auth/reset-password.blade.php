@extends('template')

@section('title')
    Change password
@stop

@section('content')
    <div class="content">
        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <div>
                <label for="email">Email</label>
                <input id="email" class="form-control form-control-lg" type="email" name="email" value=" {{  old('email', $request->email) }}" required autofocus />
            </div>
            @error('email')
            <div class="validation-feedback alert alert-danger">{{ $message }}</div>
            @enderror

            <!-- Password -->
            <div>
                <label for="password">Password</label>
                <input id="password" class="form-control form-control-lg" type="password" name="password" required />
            </div>
            @error('password')
            <div class="validation-feedback alert alert-danger">{{ $message }}</div>
            @enderror

            <!-- Confirm Password -->
            <div>
                <label for="password_confirmation">Confirm Password</label>

                <input id="password_confirmation" class="form-control form-control-lg" type="password" name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <button type="submit" class="btn btn-success">
                    Reset Password
                </button>
            </div>
        </form>
    </div>
@stop