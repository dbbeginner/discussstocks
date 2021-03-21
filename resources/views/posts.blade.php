@extends('template.template')

@section('title')
    @if($title)
        {{ $title }}
    @endif
@stop

@section('content')

    <ul>
    @if(!Auth::guest())
        <li><a style="color: #fff;" href="/subscribed">Based on your preference</a></li>

        <li><a style="color: #fff;" href="/all">All posts</a></li>
    @endif
        <li><strong style="color: #fff;">Found {{ $count }} posts total.</strong></li>
    </ul>

    @foreach($posts as $post)

        @include('template.content.post-no-content')

    @endforeach

    <div class="d-flex justify-content-center" style="margin-top: 15pt; margin-bottom: 15pt;">
        {!! $posts->links() !!}
    </div>
@stop
