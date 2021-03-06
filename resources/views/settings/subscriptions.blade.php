@extends('template')

@section('title')
    Manage Subscriptions
@stop

@section('page-title')
    <h1 class="page-title">Edit Subscriptions</h1>
@stop

@section('content')

<div class="content">
@foreach($channels as $channel)
<div class="channel-container">
    <div style="display: inline-block;">
        <span style="font-size: 12pt; " data-toggle="tooltip" data-placement="top" title="Created by {{ $channel->user->name }}">
            <strong style="text-transform: uppercase;">{{ $channel->title }}</strong><br>
            <small><small>{{ $channel->posts_count }} posts. Last activity {{ $channel->updated_at->diffForHumans() }}</small></small>
        </span>
    </div>
    <div style="display: inline-block; width: 140pt; text-align: right; float: right;">
        @if(Auth::user()->isSubscribedTo($channel->id))
            <button id="{{ $channel->hashId() }}" class="btn subscription-button subscribed" onclick="subscribe('{{ $channel->hashId() }}', '{{ Auth::user()->hashId() }}' )">
                Subscribed
            </button>
        @else
            <button id="{{ $channel->hashId() }}" class="btn subscription-button" onclick="subscribe('{{ $channel->hashId() }}', '{{ Auth::user()->hashId() }}' )">
                Not Subscribed
            </button>
        @endif
    </div>
</div>
@endforeach
</div>

<div class="d-flex justify-content-center" style="margin-top: 15pt; margin-bottom: 15pt;">
    {!! $channels->links() !!}
</div>

@stop