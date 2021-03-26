@extends('template')

@inject('render', \App\Helpers\TextRenderer::class)

@section('title')
    Edit Email
@stop

@section('content')
    <form class="form" method="post" action="/user/email">
        <div class="content">
            <h5>Current Email</h5>
            <p>{{ $user->email }}</p>

            <h5>Email</h5>
            <div class="form-group">
                <input class="form-control" name="email" id="email">
            </div>
            @error('email')
            <div class="validation-feedback  alert alert-danger">{{ $message }}</div>
            @enderror

            <h5>Verify
            <div class="form-group">
                <input class="form-control" name="verify" id="verify">
            </div>

            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <input type="reset" class="btn btn-secondary" value="Reset" />
            <input type="submit" class="btn btn-success" value="submit" />
        </div>
    </form>
@stop
