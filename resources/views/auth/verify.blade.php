@extends('template')

@section('title')
Verify your email
@stop

@section('content')
    <div class="content">
        <p>You must verify your email address before logging into the site.</p>

        <form method="post" action="/verify">
            @csrf
            <div class="form-group">
                <label for="token">Paste your activation token here:</label>
                <input type="text" class="form-control form-control-lg" id="token" name="token">
                @error('token')
                <div class="validation-feedback  alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <a class="btn btn-secondary" href="/verify/replace">Resend Welcome Email</a>
                <button class="btn btn-success">Verify</button>
            </div>
        </form>
    </div>
@stop

