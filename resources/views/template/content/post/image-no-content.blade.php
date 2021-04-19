<div class="row" style="margin-bottom: 3pt;">
    <div class="post-type-container">
        <span class="post-type">{{ $post->subtype }}</span>
    </div>
    <div class="post-content-container">
        <h1 class="content-title">
            <img src="/images/thumb/{{ $post->content }}" class="post-image-thumbnail">
            <a id="{{ $post->hashId() }}" href="{{ $post->url() }}">{{ $post->title }}</a>
        </h1>

        @include('template.content.post.components.by-line')

        @include('template.content.post-meta')

    </div>

</div>
