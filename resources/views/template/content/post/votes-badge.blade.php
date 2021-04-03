<div style=" width: 70px; float: right; position: relative; top: 0pt;">
    <div style="float: right; display: table; margin-right: -15px;">
    @if(!Auth::guest())
        <button class="vote vote-down" onclick="upvote('{{ $post->hashId() }}', '{{ Auth::user()->hashId() }}', 'down')">
            <i class="far fa-angle-down"></i>
        </button>
    @endif
        <div style="display: table-cell;  text-align: center; width: 40pt; vertical-align: middle; line-height: 8pt; height: 32px; border-radius: 16pt; background: #ff0000; color: #fff; font-size: 9pt;">
            <strong id="percent-{{ $post->hashId() }}">
                @if($post->total_upvotes + $post->votes_sum_vote == 0 || $post->total_votes + $post->votes_count == 0)
                    0%
                @else
                {{ round(($post->total_upvotes + $post->votes_sum_vote) / ($post->total_votes + $post->votes_count) * 100, 0) }}%
                @endif
            </strong><br>
            <small>upvoted</small>
        </div>

    @if(!Auth::guest())
        <button class="vote" onclick="upvote('{{ $post->hashId() }}', '{{ Auth::user()->hashId() }}', 'up')">
            <i class="far fa-angle-up"></i>
        </button>
    @endif
    </div>
</div>