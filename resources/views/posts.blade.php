@extends('template.template')

@section('title')
    @if($title)
        {{ $title }}
    @endif
@stop

@section('content')
    <strong style="color: #fff;">Found {{ $count }} posts total.</strong>

    @foreach($posts as $post)

        @include('template.content.post-no-content')

    @endforeach

    <div class="d-flex justify-content-center" style="margin-top: 15pt; margin-bottom: 15pt;">
        {!! $posts->links() !!}
    </div>
@stop
