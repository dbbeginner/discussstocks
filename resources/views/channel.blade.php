@extends('template')

@inject('renderer', \App\Helpers\TextRenderer::class)

@section('title')
    {{ $title ?? ""}}
@stop

@section('content')


    <ul class="nav nav-tabs">
        <li class="nav-item" style="margin-right: 60pt;">Text</li>
    </ul>
    <ul class="nav nav-tabs">
        <li style="margin-right: 60pt;" class="nav-item"><a style="color: #fff;" href="/subscribed">Based on your preference</a></li>
        <li class="nav-item"><a style="color: #fff;" href="/all">All posts</a></li>
    </ul>

    @foreach($posts as $post)

        @include('template.content.post-no-content')

    @endforeach

    <div class="d-flex justify-content-center" style="margin-top: 15pt; margin-bottom: 15pt;">
        {!! $posts->links() !!}
    </div>
@stop

@section('sidebar-before')
<div class="row side-col-panel">
    <h5 class="col-12">
        This Channel
    </h5>
    <ul>
        @if(!Auth::guest())
            <li><a style="color: #fff;" href="/subscribed">Based on your preference</a></li>

            <li><a style="color: #fff;" href="/all">All posts</a></li>

            @if(Auth::user()->id == $channel->user_id ?? Auth::user()->role == "admin" ?? Auth::user()->role == "superadmin")
                <li>
                    <a href="{{ $channel->url() }}/settings">Channel Settings</a>
                </li>
            @endif
        @endif
        <li><strong style="color: #fff;">Found {{ $count || 0}} posts total.</strong></li>
    </ul>
</div>
@stop