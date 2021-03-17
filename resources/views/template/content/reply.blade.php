@if($reply->repliesWithChildren)
    <ul>
        @foreach($reply->repliesWithChildren as $reply)
            <li>
                <div style="display: inline-block; width: calc(100% - 30pt); margin-right: 3px; padding: 0px;">

                    ID {{ $reply->id }} / Parent {{ $reply->parent_id }}
                    <p> <strong>{{ $reply->user->name }}</strong> said
                        at {{ $reply->created_at->format( 'h:i a' ) }}
                        on {{ $reply->created_at->format( 'm/d/Y' ) }} </p>
                    <p>{!! $reply->formattedContent() !!}</p>
                    <p>
                    <div class="align-top" style="border-width: 0px; border-style: solid; display: inline-block; width: 40pt; margin: 0px; padding: 0px; background: #00459b; text-align: center; !important; color: #fff;">
                        <span style="font-size: 6pt; baseline-shift: 3pt;">
                            {{ ($reply->total_upvotes + $reply->votes_sum_vote) }}
                        </span>
                        <i class="far fa-angle-down" style="position: relative; top: 2pt; float: right; margin-right: 5pt;"></i>
                        <i class="far fa-angle-up" style="position: relative; top: 2pt; float: right; margin-right: 3pt; "></i>
                    </div>
                    </p>
                </div>
            </li>
            @include('template.content.reply')

        @endforeach
    </ul>
@endif
