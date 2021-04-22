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
                <form id="parent-reply">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ Auth::user()->hashid() }}">
                    <input type="hidden" name="reply_id" value="{{ $post->hashId() }}">
                    <div class="create-reply" style="padding: 5pt 5pt 5pt 25pt; text-align: right;">
                        <p class="text-left">
                            <label class="col-form-label">Reply as {{ Auth::user()->name }}</label>
                        </p>
                        <div class="parent-reply grow-wrap">
                            <textarea class="form-control" name="content" id="parent-reply-content" style="min-height: 60pt; font-size: 11pt; " onInput="this.parentNode.dataset.replicatedValue = this.value"></textarea>
                        </div>
                        <div class="col-12">
                            <button id="submit-parent-reply" class="btn btn-sm btn-primary" style="border-radius: 6pt; margin: 6pt auto auto auto; padding: 2pt 12pt 2pt 12pt;" onclick="submitParentReply()">
                                <strong>Save Reply</strong>
                            </button>
                        </div>
                    </div>
                </form>
                <ul id="replies" class="replies">
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
