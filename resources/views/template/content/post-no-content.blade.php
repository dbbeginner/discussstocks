<div class="post-container">
@if( $post->subtype == 'article')
    @include('template.content.post.article-no-content')
@elseif( $post->subtype == 'url')
    @include('template.content.post.url')
@endif
</div>
