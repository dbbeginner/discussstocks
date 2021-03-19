@extends('template.template')

@section('title')
    @if($title)
        {{ $title }}
    @endif
@stop

@section('content')
    @foreach($posts as $post)

        @include('template.content.post-no-content')

    @endforeach

    <div class="d-flex justify-content-center" style="margin-top: 15pt; margin-bottom: 15pt;">
        {!! $posts->links() !!}
    </div>
@stop
