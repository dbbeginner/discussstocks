@extends('user.user')

@inject('render', \App\Helpers\TextRenderer::class)

@section('title')
    recent replies By {{ $user->name }}
@stop

@section('userdata')

    @foreach($replies as $reply)
    <div class="post-container">

        <h6>
            Reply to <a href="{{ $reply->parentByType('post')->url() }}">{{ $reply->parentByType('post')->title }}</a> posted in {{ $reply->parentByType('channel')->title }} {{ $reply->parentByType('post')->created_at->diffForHumans() }}
        </h6>

        {!! $render->markdownToHtml( $reply->content ) !!}

    </div>
    @endforeach
@stop