@extends('template.template')

@inject('render', \App\Helpers\TextRenderer::class)

@section('content')

    @include('template.content.post')

    @if(Auth::Guest())
        <div class="reply-container" style="margin-left: 17pt; width: calc(100% - 34pt); max-width: 700px; margin-bottom: 20pt; padding: 3pt; padding-right: 30pt; text-align: justify;">
            <h4 style="margin-left: 30pt;">
                You must be logged in to view or make replies to this
            </h4>
        </div>
    @else
        <div class="reply-container ">
            <div class="reply-content-container">
                <ul class="replies">
                    @foreach ($replies as $reply)
                    <li>
                        <div style="display: inline-block; width: calc(100% - 30pt); margin-right: 3px; padding: 0px; ">
                            <p> <strong>{{ $reply->user->name }}</strong> said at {{ $reply->created_at->format('h:i a') }} on {{ $reply->created_at->format('m/d/Y') }} </p>
                            {!! $render->markdownToHtml( $reply->content ) ?? "" !!}

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
            </div>
        </div>
    @endif
@stop
