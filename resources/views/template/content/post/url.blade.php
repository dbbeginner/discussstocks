<div class="row" style="margin-bottom: 3pt;">
    @include('template.content.post.components.votes')

    <div class="post-content-container">
        <h1 class="content-title">
            <a href="{{$post->content}}" target="_blank">{{ $post->title }}</a> <span class="url-parsed">({{ parse_url($post->content, PHP_URL_HOST) }} )</span>
            <span class="post-type post-link">{{ $post->subtype }}</span>
        </h1>

        @include('template.content.post.components.by-line')

        @include('template.content.post.components.post-meta')

    </div>
</div>
