<div class="votes-container">
    @if(Auth::check())
    <button class="vote vote-up" onclick="upvote('{{ $post->hashId() }}', '{{ Auth::user()->hashId() }}', 'up')">
        <i class="fa fa-caret-up"></i>
    </button>
    @else
    <button class="vote vote-up" disabled>
        <i class="fa fa-caret-up"></i>
    </button>
    @endif
    <br>
    <span class="vote-count" id="votesum-{{ $post->hashId() }}">
        {{ $post->sumOfVotes() }}
   </span>
    <br>
    @if(Auth::check())
    <button class="vote vote-down" onclick="upvote('{{ $post->hashId() }}', '{{ Auth::user()->hashId() }}', 'down')">
        <i class="fa fa-caret-down"></i>
    </button>
    @else
    <button class="vote vote-down" disabled>
        <i class="fa fa-caret-down"></i>
    </button>
    @endif
</div>