@inject('render', \App\Helpers\TextRenderer::class)

<div class="row" style="margin-bottom: 3pt;">

    <div class="post-type-container">
        <span class="post-type">{{ $post->subtype }}</span>
    </div>
    <div class="post-content-container">
        <h1 class="post-title">
            <a id="{{ $post->hashId() }}" href="{{ $post->url() }}">{{ $post->title }}</a>
        </h1>

        @include('template.content.post.components.by-line')

        <p>
            {!! $render->markdownToHtml( $post->content ) ?? "" !!}
        </p>

        @include('template.content.post-meta')

    </div>

</div>
