<div class="post-container">

    @if( $post->subtype == 'post')
        @include('template.content.post.article')
    @elseif( $post->subtype == 'url')
        @include('template.content.post.url')
    @elseif( $post->subtype == 'image')
        @include('template.content.post.image')
    @endif

</div>
