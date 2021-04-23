<ul class="post-meta">
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
