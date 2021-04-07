@inject('render', \App\Helpers\TextRenderer::class)

<li>
    <div id="container-{{ $reply->hashId() }}" style="display: inline-block; width: calc(100% - 30pt); margin-right: 3px; padding: 0px;">

        <p> <strong>{{ $reply->user->name }}</strong> said
            at {{ $reply->created_at->format( 'h:i a' ) }}
            on {{ $reply->created_at->format( 'm/d/Y' ) }} </p>

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