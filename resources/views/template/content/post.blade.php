<div class="post-container">

    @if( $post->subtype == 'article')
        @include('template.content.post.article')
    @elseif( $post->subtype == 'url')
        @include('template.content.post.url')
    @endif

</div>
