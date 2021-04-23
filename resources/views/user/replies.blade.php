@extends('user.user')

@inject('render', \App\Helpers\TextRenderer::class)

@section('title')
    recent replies By {{ $user->name }}
@stop

@section('userdata')

    @foreach($replies as $reply)
    <div class="content">

        <h6>
            Reply to <a href="{{ $reply->parentPost()->url() }}">{{ $reply->parentPost()->title }}</a> posted in {{ $reply->parentChannel()->title }} {{ $reply->parentPost()->created_at->diffForHumans() }}
        </h6>

        {!! $render->markdownToHtml( $reply->content ) !!}

    </div>
    @endforeach
@stop