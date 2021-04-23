@extends('template')

@inject('renderer', \App\Helpers\TextRenderer::class)

@section('title')
    {{ $title ?? ""}}
@stop

@section('content')
    <div style="margin-top: 6pt; margin-bottom: 6pt;">
    @if(!Auth::guest())
        <a class="btn btn-sm btn-light" href="/subscribed">
            Based on your preference
        </a>
        <a class="btn btn-sm btn-light" href="/all">
            All posts
        </a>
    @else
        <a class="btn btn-sm btn-light" href="/register">
            Create an account to subscribe to channels.
        </a>
    @endif
        <span style="display: inline-block; position: relative; top: 6px; float: right;  color: #000;">Found {{ $count ?? 0 }} posts total.</span>
    </div>

    @if( $count < preference('pagination', 10) - 1 )
    <div class="alert alert-info alert-dismissible alert-container" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Just FYI...</strong> There aren't many posts here. Perhaps you want to <a href="/user/subscriptions">subscribe to more channels</a>?
    </div>
    @endif


    @foreach($posts as $post)

        @include('template.content.post-no-content')

    @endforeach

    <div class="d-flex justify-content-center" style="margin-top: 15pt; margin-bottom: 15pt;">
        {!! $posts->links() !!}
    </div>
@stop
