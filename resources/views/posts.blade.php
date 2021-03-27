@extends('template')

@inject('renderer', \App\Helpers\TextRenderer::class)

@section('title')
    {{ $title ?? ""}}
@stop

@section('content')

    <div style="margin-top: 16pt; margin-bottom: 6pt;">
    @if(!Auth::guest())
        <a class="btn btn-sm btn-light" href="/subscribed">
            Based on your preference
        </a>
        <a class="btn btn-sm btn-light" href="/all">
            All posts
        </a>
    @endif
        <strong style="display: inline-block; float: right;  color: #fff;">Found {{ $count || 0}} posts total.</strong>
    </div>

    @foreach($posts as $post)

        @include('template.content.post-no-content')

    @endforeach

    <div class="d-flex justify-content-center" style="margin-top: 15pt; margin-bottom: 15pt;">
        {!! $posts->links() !!}
    </div>
@stop
