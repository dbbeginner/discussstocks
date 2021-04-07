@extends('template')

@inject('render', \App\Helpers\TextRenderer::class)

@section('content')

    @include('template.content.post')

    @if(Auth::Guest())
        <div class="reply-container" style="margin-left: 17pt; width: calc(100% - 34pt); max-width: 700px; margin-bottom: 20pt; padding: 3pt; padding-right: 30pt; text-align: justify;">
            <h4 style="margin-left: 30pt;">
                You must be logged in to view or make replies to this
            </h4>
        </div>
    @else
        <div class="reply-container ">
            <div class="reply-content-container">
                <ul class="replies">
                    @foreach ($replies as $reply)
                    <li>
                        <div id="container-{{ $reply->hashId() }}" style="display: inline-block; width: calc(100% - 30pt); margin-right: 3px; padding: 0px; ">
                            <p> <strong>{{ $reply->user->name }}</strong> said at {{ $reply->created_at->format('h:i a') }} on {{ $reply->created_at->format('m/d/Y') }} </p>

                            {!! $render->markdownToHtml( $reply->content ) ?? "" !!}

                            <div class="align-top" style="margin-top: -6pt; padding-left: -6pt;">
                                @if(!Auth::guest())
                                    <button class="vote vote-down" onclick="upvote('{{ $reply->hashId() }}', '{{ Auth::user()->hashId() }}', 'down')" style="margin-left: -6pt;">
                                        <i class="far fa-arrow-alt-circle-down"></i>
                                    </button>
                                @endif

                                <span id="votesum-{{ $reply->hashId() }}" style="margin-left: 1pt; margin-right: 1pt; font-weight: bold;">
                                    {{ $reply->sumOfVotes() }}
                                </span>


                                @if(!Auth::guest())
                                    <button class="vote" onclick="upvote('{{ $reply->hashId() }}', '{{ Auth::user()->hashId() }}', 'up')">
                                        <i class="far fa-arrow-alt-circle-up"></i>
                                    </button>
                                @endif
                                <button class="btn btn-link reply-button" id="reply-{{$reply->hashId()}}" onclick="showReplyContainer('{{ $reply->hashid() }}')">Add Reply</button>
                            </div>
                        </div>
                    </li>
                    @include('template.content.reply-container')
                  @endforeach
                </ul>
            </div>
        </div>
    @endif
@stop
