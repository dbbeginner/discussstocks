@extends('template')

@section('title')
    {{ $title }}
@stop

@section('content')

    {{ Markdown::parse($content) }}

@stop

