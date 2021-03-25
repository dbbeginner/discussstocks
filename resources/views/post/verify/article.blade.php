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
            <h1 class="post-title">
                <a id="#" href="#">{{ Session::get('title') }}</a>
            </h1>

            <p class="post-byline">
                Created now by <a href="#">{{ Session::get('username') }}</a>
                in <a href="#">{{ Session::get('channel_title') }}</a>
            </p>

            <p>
                {!! $render->markdownToHtml( Session::get('content')) !!}
            </p>
        </div>
    </div>


    <form method="post" action="/post/article/store">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <p class="text-center" style="color: #fff;">
            Ok to post?
        </p>
        <p class="text-center">
            <a href="javascript:history.back()" class="btn btn-light">Edit</a>
            <button class="btn btn-light"><strong>Save</strong></button>
        </p>
    </form>

@stop