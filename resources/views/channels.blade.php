@extends('template.template')

@inject('render', \App\Helpers\TextRenderer::class)

@section('title')
Channels
@stop

@section('content')
@foreach($channels as $channel)
<div class="category">
    <h1>
        <a href="{{ $channel->url() }}">{{ $channel->title }}</a>
        <span class="small">
            Owned by <strong><a href="/u/{{ $channel->user->name }}">{{ $channel->user->name }}</a></strong>
        </span>
    </h1>
    <div class="content content-hidden" id="{{ $channel->id }}">
        {!! $render->markdownToHtml( $channel->content ) ?? "" !!}
    </div>
    <div class="footer">
        <a class="btn btn-link" style="padding: 0pt;" href="{{ $channel->url() }}">See all {{ count($channel->posts) }} posts</a>
        <button class="btn btn-link" style="padding: 0pt; color: #000;" onclick="readmore({{ $channel->id }})">Read More</button>
    </div>
</div>

@endforeach

    <div class="d-flex justify-content-center" style="margin-bottom: 30pt;">
        {!! $channels->links() !!}
    </div>

@stop


