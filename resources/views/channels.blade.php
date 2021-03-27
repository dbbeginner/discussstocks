@extends('template')

@inject('render', \App\Helpers\TextRenderer::class)

@section('title')
Channels
@stop

@section('content')
@foreach($channels as $channel)
<div class="post-container">
    <h1 style="margin-left: 15pt; margin-top: 5pt; margin-bottom: 5pt;">
        @if(count($channel->posts) == 0)
            {{ $channel->title }}
        @else
            <a href="{{ $channel->url() }}">{{ $channel->title }}</a>
        @endif
        <span class="small">
            Owned by <strong><a href="/u/{{ $channel->user->name }}">{{ $channel->user->name }}</a></strong>
        </span>
    </h1>
    <div class="content content-hidden" id="{{ $channel->id }}">
        {!! $render->markdownToHtml( $channel->content ) ?? "" !!}
    </div>
    <div class="footer">
        @if(count($channel->posts) == 0)
            No posts yet
        @else
            <a class="btn btn-link" style="color: #000; margin-right: 30pt;" href="{{ $channel->url() }}">See all {{ count($channel->posts) }} posts</a>
        @endif
        <button class="btn btn-link" style="padding: 0pt; color: #000;" onclick="readmore({{ $channel->id }})">Read More</button>
    </div>
</div>

@endforeach

    <div class="d-flex justify-content-center" style="margin-bottom: 30pt;">
        {!! $channels->links() !!}
    </div>

@stop


