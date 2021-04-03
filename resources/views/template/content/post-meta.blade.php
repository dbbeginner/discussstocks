<ul class="post-meta">
    <li>
        <a href="{{ $post->url() }}">{{ $post->reply_count }} replies</a>
    </li>
    <li>
        <span id="share-{{ $post->hashId() }}" class="pseudo-link" onclick="shareLink('{{ $post->hashId() }}')">Share link</span>
    </li>
    <li style="float:right;">
        Last activity {{ $post->updated_at->diffForHumans() }}
    </li>
</ul>
