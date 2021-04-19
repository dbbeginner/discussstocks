@extends('template')

@inject('render', \App\Helpers\TextRenderer::class)

@section('title')
    Verify your post
@stop

@section('content')
    <div class="content">
        <div class="post-type-container">
            <span class="post-type">Post</span>
        </div>
        <div class="post-content-container">
            <h1 class="content-title">
                <a id="#" href="#">{{ $title }}</a>
            </h1>

            <p class="content-byline">
                Created now by <a href="#">{{ Auth::user()->name }}</a>
                in <a href="#">{{ $channel_title }}</a>
            </p>

            <p>
                {!! $render->markdownToHtml( $content ) !!}
            </p>
        </div>
    </div>


    <form method="post" action="/post/article/store">
        @csrf
        <input type="hidden" name="channel_id" value="{{ $channel_id }}" />
        <input type="hidden" name="title" value="{{ $title }}" />
        <input type="hidden" name="content" value="{{ $content }}" />
        <p class="text-center" style="color: #fff;">
            Ok to post?
        </p>
        <p class="text-center">
            <a href="javascript:history.back()" class="btn btn-light">Edit</a>
            <button type="submit" class="btn btn-light"><strong>Save</strong></button>
        </p>
    </form>

@stop