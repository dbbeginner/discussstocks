@extends('template')

@section('title')
    Previewing Post
@stop

@section('content')


<div class="content">
    <div class="row" style="margin-bottom: 3pt;">
        <div class="post-type-container">
            <span class="post-type post-link">URL</span>
        </div>
        <div class="post-content-container">
            <h1 class="content-title">
                <a href="#" target="_blank">{{ $title }}</a>
            </h1>
            <p class="content-byline">
                Created now by <a href="#">{{ Auth::user()->name }}</a>
                in <a href="#">{{ $channel_title }}</a>
            </p>
            <p>
                <img src="/tmp/{{ $image }}" style="width: 100%;">
            </p>
        </div>
    </div>
</div>

<div style="margin-bottom: 20pt;">
    <form method="post" action="/post/image/store">
        @csrf
        <input type="hidden" name="channel_id" value="{{ $channel_id }}">
        <input type="hidden" name="title" value="{{ $title }}">
        <input type="hidden" name="content" value="{{ $image }}">
        <p class="text-center" style="color: #fff;">
            Ok to post?
        </p>
        <p class="text-center">
            <a href="javascript:history.back()" class="btn btn-light">Edit</a>
            <input type="submit" class="btn btn-light" value="Submit">
        </p>
    </form>
</div>
@stop