@inject('render', \App\Helpers\TextRenderer::class)

@if($reply->repliesWithChildren)
    <ul>
        @foreach($reply->repliesWithChildren as $reply)

            @include('template.content.reply-body')
            @include('template.content.reply-container')

        @endforeach
    </ul>
@endif
