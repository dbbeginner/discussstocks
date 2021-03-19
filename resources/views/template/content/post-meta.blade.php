<ul class="post-meta">
    <li>
{{--        <div class="align-top" style="border-width: 0px; border-style: solid; display: inline-block; width: 40pt; margin: 0px; padding: 0px; background: #00459b; text-align: center; !important; color: #fff;">--}}
{{--            <span id ="votes-{{ $post->hash_id() }}" style="font-size: 6pt; baseline-shift: 3pt;">--}}
{{--                {{ ($post->total_upvotes + $post->votes_sum_vote) }}--}}
{{--            </span>--}}
{{--            @if(!Auth::guest())--}}
{{--            <button class="vote vote-down" onclick="upvote('{{ $post->hash_id() }}', '{{ Auth::user()->hash_id() }}', 'down')">--}}
{{--                <i class="far fa-angle-down"></i>--}}
{{--            </button>--}}
{{--            <button class="vote" onclick="upvote('{{ $post->hash_id() }}', '{{ Auth::user()->hash_id() }}', 'up')">--}}
{{--                <i class="far fa-angle-up"></i>--}}
{{--            </button>--}}
{{--            @endif--}}
{{--        </div>--}}
    </li>
    <li>
        <a href="{{ $post->url() }}">{{ $post->reply_count }} replies</a>
    </li>
    <li>
        <span id="share-{{ $post->hash_id() }}" class="pseudo-link" onclick="shareLink('{{ $post->hash_id() }}')">Share link</span>
    </li>
    <li style="float:right;">
        Last activity {{ $post->updated_at->diffForHumans() }}
    </li>
</ul>
