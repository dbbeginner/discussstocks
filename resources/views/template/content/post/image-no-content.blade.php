<div class="row" style="margin-bottom: 3pt;">
    <div class="post-type-container">
        <span class="post-type">{{ $post->subtype }}</span>
    </div>
    <div class="post-content-container">
        <h1 class="post-title">
            <img src="/images/thumb/{{ $post->content }}" style="height: 45pt; display: block; float: right;">
            <a id="{{ $post->hashId() }}" href="{{ $post->url() }}">{{ $post->title }}</a>
{{--            @include('template.content.post.votes-badge')--}}
        </h1>

        @include('template.content.post.components.by-line')

        @include('template.content.post-meta')

    </div>

</div>
