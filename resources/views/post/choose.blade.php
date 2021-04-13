@extends('template')

@section('title')
What type of post are you making?
@stop

@section('content')
<div class="content">
    <h4 class="text-center" style="margin-top: 20pt; margin-bottom: 20pt;">
        <a style="margin-right: 60pt;" href="/post/article/create">Text Post</a>
        <a style="margin-right: 60pt;"href="/post/url/create">Website Link</a>
        <a href="/post/image/create">Image</a>
    </h4>
</div>

@stop