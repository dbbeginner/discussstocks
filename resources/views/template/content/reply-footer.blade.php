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
    <button class="btn btn-link reply-button" id="reply-{{$reply->hashId()}}">Add Reply</button>
</div>