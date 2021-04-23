<div class="votes-container">
    <button class="vote vote-up" onclick="upvote('{{ $post->hashId() }}', '{{ Auth::user()->hashId() }}', 'up')">
        <i class="fa fa-caret-up"></i>
    </button>
    <br>
    <span class="vote-count" id="votesum-{{ $post->hashId() }}">
        {{ $post->sumOfVotes() }}
   </span>
    <br>
    <button class="vote vote-down" onclick="upvote('{{ $post->hashId() }}', '{{ Auth::user()->hashId() }}', 'down')">
        <i class="fa fa-caret-down"></i>
    </button>
</div>