<div class="row" style="margin-bottom: 3pt;">
    <div class="post-type-container">
        <span class="post-type">{{ $post->subtype }}</span>
    </div>
    <div class="post-content-container">
        <h1 class="post-title">
            <a id="{{ $post->hashId() }}" href="{{ $post->url() }}">{{ $post->title }}</a>
            @include('template.content.post.votes-badge')
        </h1>

        <p class="post-byline">
            Created {{ $post->created_at->diffForHumans() }} ago by <a href="/u/{{ $post->user->name }}">{{ $post->user->name }}</a>
            in <a href="{{ $post->parent->url() }}">{{ $post->parent->title }}</a>
        </p>

        @include('template.content.post-meta')

    </div>

</div>
