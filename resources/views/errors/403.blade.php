@extends('template')

@section('title')
403 - UNAUTHORIZED
@stop

@section('content')
<div class="content">
    <h1>Unauthorized</h1>
    <p>{{ $exception->getMessage() }}</p>
</div>
@stop