<div>
    <p class="h1">
        <a href="{{ $post->slug }}">{{ $post->title }}</a>
        <span class="small">
            Posted by <strong><a href="/u/{{ $post->user->id }}">{{$post->user->name}}</a></strong>
        </span>
    </p>
    <p>
        {!! $post->FormattedContent() !!}
    </p>
</div>
