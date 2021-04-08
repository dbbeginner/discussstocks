@extends('template')

@inject('render', \App\Helpers\TextRenderer::class)

@section('title')
    {{ $user->name }} profile
@stop

@section('content')
    <form class="form" method="post" action="/user/profile/edit">
        <div class="content">
            <h5>Display Name</h5>
            <div class="form-group">
                <input class="form-control" name="name" id="name" value="{{ $user->name }}" disabled>
            </div>

            <h5>Email</h5>
            <div class="input-group">
                <input class="form-control" name="email" id="email" value="{{ $user->email }}" disabled>
                <div class="input-group-append">
                    <a class="btn btn-outline-secondary" href="/user/email">Edit Email</a>
                </div>
            </div>
            @error('email')
            <div class="validation-feedback  alert alert-danger">{{ $message }}</div>
            @enderror

            <h5>Bio</h5>
            <div class="form-group">
                <textarea id="bio" name="bio" rows=12 class="form-control">{{ $user->bio }}</textarea>
            </div>
            <div class="form-group">
                <small>You may use markdown here</small>
            </div>
            @error('bio')
            <div class="validation-feedback  alert alert-danger">{{ $message }}</div>
            @enderror

            <h5>Image</h5>
            <div class="form-group">
                <label for="image">Choose Image</label>
                <input id="image" type="file" name="image">
            </div>
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <input type="reset" class="btn btn-secondary" value="Reset" />
            <input type="submit" class="btn btn-success" value="submit" />
        </div>
    </form>
@stop
