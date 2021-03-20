@extends('template.template')

@section('title')
    Edit Subscriptions
@stop

@section('page-title')
    <h1 class="page-title">Edit Subscriptions</h1>
@stop

@section('content')

    <div class="content">
    @foreach($channels as $channel)
        <div class="row" style="margin-bottom: 10pt; line-height: 12pt;">
            <div class="col-sm-10">
                <strong style="font-size: 12pt; text-transform: uppercase;" data-toggle="tooltip" data-placement="top" title="Created by {{ $channel->user->name }}">
                    {{ $channel->title }}
                </strong> ({{ $channel->posts_count }} posts)<br>
                <small>
                    <small>Last activity {{ $channel->updated_at->diffForHumans() }}</small>
                </small>
            </div>
            <div class="col-sm-2">
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