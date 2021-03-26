@extends('template')

@inject('render', \App\Helpers\TextRenderer::class)

@section('title')
    {{ $name }} profile
@stop

@section('content')
    <div class="content">
        <h5>Display Name</h5>
        <p>{{ $name }}</p>

        <h5>Email</h5>
        <p>{{ $email }}</p>

        <h5>Show email?</h5>
        <p>
            @if($show == 'true')
                Yes
            @else
                No
            @endif
        </p>

        <h5>Bio</h5>
        @if($bio)
            {!! $render->markdownToHtml( $bio ) ?? "<p></p>" !!}
        @else
            <p>None yet</p>
        @endif

        <h5>Image</h5>
        <p>Image</p>

        <form method="post" action="/user/profile">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <input type="hidden" name="email" value="{{ $email }}" />
            <input type="hidden" name="bio" value="{{ $bio }}" />
            <input type="hidden" name="show" value="{{ $show }}" />
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <input type="submit" class="btn btn-success" href="/user/profile/edit" value="Save">
        </form>
    </div>
@stop
