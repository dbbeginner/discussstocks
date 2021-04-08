@extends('template')

@inject('render', \App\Helpers\TextRenderer::class)

@section('title')
    {{ $user->name }} profile
@stop

@section('content')
    <div class="content">
        <h5>Display Name</h5>
        <div class="form-group">
            <div class="form-control">
                {{ $user->name }}
            </div>
        </div>

        <h5>Email</h5>
        <div class="form-group">
            <div class="form-control">
                {{ $user->email }}
            </div>
        </div>

        <h5>Bio</h5>
        @if($user->bio)
            <div class="form-group">
                <div class="form-control">
                    {!! $render->markdownToHtml( $user->bio ) ?? "<p></p>" !!}
                </div>
            </div>
        @else
            <div class="form-group">
                <div class="form-control">
                    None yet
                </div>
            </div>
        @endif

        <h5>Image</h5>
        <div class="form-group">
            <div class="form-control" style="width:160px; height: 240px;">

            </div>
        </div>

        <a class="btn btn-success" href="/user/profile/edit">Edit</a>
    </div>
@stop
