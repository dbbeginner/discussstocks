<div class="content">
@if( $post->subtype == 'post')
    @include('template.content.post.article-no-content')
@elseif( $post->subtype == 'url')
    @include('template.content.post.url')
@elseif( $post->subtype == 'image')
    @include('template.content.post.image-no-content')
@endif
</div>
