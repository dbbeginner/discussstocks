<p class="post-byline">
    Created {{ $post->created_at->diffForHumans() }} ago
    @if(Auth::check() && Auth::user()->id == $post->user->id)
        by <a href="/u/{{ $post->user->name }}" style="color: #e08036; font-weight: bold;">you</a>
    @else
        by <a href="/u/{{ $post->user->name }}">{{ $post->user->name }}</a>
    @endif
    in <a href="{{ $post->parent->url() }}">{{ $post->parent->title }}</a>
</p>