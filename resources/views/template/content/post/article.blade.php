@inject('render', \App\Helpers\TextRenderer::class)

<div class="row" style="margin-bottom: 3pt;">

    @include('template.content.post.components.votes')

    <div class="post-content-container">
        <h1 class="content-title">
            <a id="{{ $post->hashId() }}" href="{{ $post->url() }}">{{ $post->title }}</a>
            <span class="post-type">{{ $post->subtype }}</span>

        </h1>

        @include('template.content.post.components.by-line')

        <p>
            {!! $render->markdownToHtml( $post->content ) ?? "" !!}
        </p>

        @include('template.content.post.components.post-meta')

    </div>

</div>
