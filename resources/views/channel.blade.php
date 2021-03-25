@extends('template')

@inject('renderer', \App\Helpers\TextRenderer::class)

@section('title')
    {{ $title ?? ""}}
@stop

@section('content')

    <ul>
        @if(!Auth::guest())
            <li><a style="color: #fff;" href="/subscribed">Based on your preference</a></li>

            <li><a style="color: #fff;" href="/all">All posts</a></li>
        @endif
        @if(!Auth::guest())
            @if(Auth::user()->id == $channel->user_id ?? Auth::user()->role == "admin" ?? Auth::user()->role == "superadmin")
            <li>
                <a href="{{ $channel->url() }}/settings">Channel Settings</a>
            </li>
            @endif
        @endif
        <li><strong style="color: #fff;">Found {{ $count || 0}} posts total.</strong></li>
    </ul>

    @foreach($posts as $post)

        @include('template.content.post-no-content')

    @endforeach

    <div class="d-flex justify-content-center" style="margin-top: 15pt; margin-bottom: 15pt;">
        {!! $posts->links() !!}
    </div>
@stop
