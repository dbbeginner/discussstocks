@extends('template')


@section('title')
{{ $title }}
@stop

@section('content')
    <div class="row" style="margin-left: 0px; margin-right: 15px; margin-bottom: 6pt;">
            <a class="btn btn-sm btn-light btn-search-scopes" href="/channels/ascending">Alphabetical (a-z)</a><br>
            <a class="btn btn-sm btn-light btn-search-scopes" href="/channels/descending">Alphabetical (z-a)</a>

            <a class="btn btn-sm btn-light btn-search-scopes" href="/channels/oldest">Oldest</a><br>
            <a class="btn btn-sm btn-light btn-search-scopes" href="/channels/newest">Newest</a>

            <a class="btn btn-sm btn-light btn-search-scopes" href="/channels/most-active">Most Active</a><br>
            <a class="btn btn-sm btn-light btn-search-scopes" href="/channels/least-active">Least Active</a>

            <a class="btn btn-sm btn-light btn-search-scopes" href="/channels/most-recently-active">Most Recent Activity</a><br>
            <a class="btn btn-sm btn-light btn-search-scopes" href="/channels/least-recently-active">Least Recent Activity</a>

            <a class="btn btn-sm btn-light btn-search-scopes" href="/channels/random">Random Order</a>
    </div>

@foreach($channels as $channel)
    @inject('render', \App\Helpers\TextRenderer::class)

    <div class="content">
    <h1 class="content-title inset-left">
        @if(count($channel->posts) == 0)
        {{ $channel->title }}
        @else
        <a href="{{ $channel->url() }}">{{ $channel->title }}</a>
        @endif
        <br>
        <p class="content-byline">
            Owned by <a href="/u/{{ $channel->user->name }}">{{ $channel->user->name }}</a>
        </p>
    </h1>
    <div class="inset-left content-hidden replace-stock-symbols" id="{{ $channel->id }}">
        {!! $render->markdownToHtml( $channel->content ) ?? "" !!}
    </div>
    <div class="inset-left">
        <p>
        @if(count($channel->posts) == 0)
            <strong style="color: #000; margin-right: 30pt; padding: 0pt;">No posts yet</strong>
        @else
        </p>
            <strong><a class="btn btn-link" style="color: #000; margin-right: 30pt; padding: 0pt;" href="{{ $channel->url() }}">
                    See all {{ count($channel->posts) }} posts</a></strong>
        @endif
        <button class="btn btn-link" style="padding: 0pt; color: #000;" onclick="readmore({{ $channel->id }})">Read More</button>
    </div>
</div>

@endforeach

    <div class="d-flex justify-content-center" style="margin-bottom: 30pt;">
        {!! $channels->links() !!}
    </div>

@stop


