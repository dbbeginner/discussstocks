@extends('template.template')

@section('title')
    <p class="h1">
        <a href="{{ $category->url() }}">Latest Posts in {{ $category->title }}</a>
    </p>
    <p>
        Channel created by <strong><a href="/u/{{ $category->user->id }}">{{ $category->user->name }}</a></strong>
    </p>
@stop

@section('content')

    <div class="category-top">
        <p class="h2">

        </p>
        <div class="service-1 click1">
            <div class="row">
                <div class="medium-12 small-12 columns smalldesc">
                    <p class="font16">
                        {!! $category->formattedContent() !!}
                    </p>
                    <a id="expand" href="#">Read More</a>
                </div>
            </div>
        </div>
    </div>


    @foreach($posts as $post)
        <div class="post-top">
            <p>

            <span class="h2"><a href="{{ $post->slug }}">{{ $post->title }}</a></span>
            <span class="small">{{ ucfirst($post->type) }} by <strong><a href="/u/{{ $post->user->id }}">{{ $post->user->name }}</a></strong></span>
            </p>
            <p class="small">
                {{ $post->content }}
            </p>
            <p>
                <a href="/{{ $post->slug }}">
                    {{ count($post->replies) }} Replies
                </a>
            </p>
        </div>

    @endforeach

@stop

@section('sidebar')

@stop
