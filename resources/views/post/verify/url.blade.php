@extends('template')

@section('title')
    Previewing Post
@stop

@section('content')


<div class="post-container">
    <div class="row" style="margin-bottom: 3pt;">
        <div class="post-type-container">
            <span class="post-type post-link">URL</span>
        </div>
        <div class="post-content-container">
            <h1 class="post-title">
                <a href="{{ Session::get('content') }}" target="_blank">{{ Session::get('title') }}</a> <span class="url-parsed">({{ parse_url( Session::get('content'), PHP_URL_HOST) }} )</span>
    {{--            @include('template.content.post.votes-badge')--}}
            </h1>
            <p class="post-byline">
                Created now by <a href="#">{{ Session::get('username') }}</a>
                in <a href="#">{{ Session::get('channel_title') }}</a>
            </p>
        </div>
    </div>
</div>
<form method="post" action="/post/url/store">
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