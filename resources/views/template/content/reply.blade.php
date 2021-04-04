@inject('render', \App\Helpers\TextRenderer::class)

@if($reply->repliesWithChildren)
    <ul>
        @foreach($reply->repliesWithChildren as $reply)
            <li>
                <div id="container-{{ $reply->hashId() }}" style="display: inline-block; width: calc(100% - 30pt); margin-right: 3px; padding: 0px;">

                    <p> <strong>{{ $reply->user->name }}</strong> said
                        at {{ $reply->created_at->format( 'h:i a' ) }}
                        on {{ $reply->created_at->format( 'm/d/Y' ) }} </p>

                    {!! $render->markdownToHtml( $reply->content ) ?? "" !!}

                    @include('template.content.reply-footer')
                </div>
            </li>
            @include('template.content.reply')

        @endforeach
    </ul>
@endif
