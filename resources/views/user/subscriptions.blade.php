@extends('template.template')

@section('content')

    @foreach($channels as $channel)
        <div class="row" style="margin-bottom: 5pt;">
            <div class="col-sm-10">
                <strong>{{ $channel->title }}</strong><br>
                <small>
                    <em>Created by {{ $channel->user->name }}</em> {{ $channel->posts_count }} posts | <small>{{ $channel->updated_at->diffForHumans() }} since last activity</small>
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

    <div class="d-flex justify-content-center" style="margin-top: 15pt; margin-bottom: 15pt;">
        {!! $channels->links() !!}
    </div>
@stop