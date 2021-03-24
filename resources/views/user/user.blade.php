@extends('template.template')

@section('title')
    {{ $user->name }}'s profile
@stop

@section('content')
    <ul class="nav nav-tabs">
        <li class="tab">
            <a style="color:#fff;" href="/u/{{ $user->name }}/posts">Posts</a>
        </li>
        <li>
            <a style="color:#fff;" href="/u/{{ $user->name }}/replies">Replies</a>
        </li>
        <li>
            <a style="color:#fff;" href="/u/{{ $user->name }}/mentions">Mentions</a>
        </li>
    </ul>


    @yield('userdata')

@stop