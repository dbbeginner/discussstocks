@extends('user.user')

@section('title')
Recently Posted By {{ $user->name }}
@stop

@section('userdata')
    @foreach($posts as $post)

        @include('template.content.post')

    @endforeach
@stop