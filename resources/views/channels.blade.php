@extends('template')

@inject('render', \App\Helpers\TextRenderer::class)

@section('title')
{{ $title }}
@stop

@section('content')
    <div class="row" style="margin-left: 15px; margin-right: 15px;">
        <div class="col-xs-2">
            <a class="btn btn-sm btn-light" href="/channels/ascending">Alphabetical (a-z)</a><br>
            <a class="btn btn-sm btn-light" href="/channels/descending">Alphabetical (z-a)</a>
        </div>
        <div class="col-xs-2">
            <a class="btn btn-sm btn-light" href="/channels/oldest">Oldest</a><br>
            <a class="btn btn-sm btn-light" href="/channels/newest">Newest</a>
        </div>
        <div class="col-xs-2">
            <a class="btn btn-sm btn-light" href="/channels/most-active">Most Active</a><br>
            <a class="btn btn-sm btn-light" href="/channels/least-active">Least Active</a>
        </div>
        <div class="col-xs-2">
            <a class="btn btn-sm btn-light" href="/channels/most-recently-active">Most Recent Activity</a><br>
            <a class="btn btn-sm btn-light" href="/channels/least-recently-active">Least Recent Activity</a>
        </div>
        <div class="col-xs-2">
            <a class="btn btn-sm btn-light" href="/channels/random">Random Order</a>
        </div>
    </div>

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


