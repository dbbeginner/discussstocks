<ul class="post-meta">
    <li style="margin-top: -3.5pt;">
        @if(!Auth::guest())
            <button class="vote vote-down" onclick="upvote('{{ $post->hashId() }}', '{{ Auth::user()->hashId() }}', 'down')" style="margin-left: -6pt;">
                <i class="far fa-arrow-alt-circle-down"></i>
            </button>

           <span id="votesum-{{ $post->hashId() }}" style="margin-left: 1pt; margin-right: 1pt; font-weight: bold;">
                {{ $post->sumOfVotes() }}
           </span>


            <button class="vote" onclick="upvote('{{ $post->hashId() }}', '{{ Auth::user()->hashId() }}', 'up')">
                <i class="far fa-arrow-alt-circle-up"></i>
            </button>
        @else
            <span id="votesum-{{ $post->hashId() }}" style="position: relative; top: 3.25pt; margin-left: 1pt; margin-right: 1pt; font-weight: bold;">
                {{ $post->sumOfVotes() }}
           </span>
        @endif
    </li>

    <li>
        <a href="{{ $post->url() }}">{{ $post->reply_count }} replies</a>
    </li>
    <li>
        <button class="btn btn-link" style="margin:0pt; margin-top: -2pt; padding:0pt; font-size: 8pt; top: 0pt;"id="share-{{ $post->hashId() }}"
             class="pseudo-link" onclick="shareLink('{{ $post->hashId() }}')">Share link</button>
    </li>
    @if( Auth::check() )
    <li>
        <button class="btn btn-link" style="margin:0pt; margin-top: -2pt; padding:0pt; font-size: 8pt; top: 0pt;"
                onclick="showReportContentModal('{{ $post->hashId()}}', '{{ Auth::user()->hashId() }}')">Report this </button>
    </li>
    @endif
    <li>
        Last activity {{ $post->updated_at->diffForHumans() }}
    </li>
</ul>
