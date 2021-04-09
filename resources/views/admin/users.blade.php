@extends('template')

@section('title')
    Users
@stop

@section('content')
    <div class="content">
    @foreach($users as $user)
        <div class="row">
            <div class="col-sm-3">
                <a href="/admin/users/{{ $user->hashId() }}">{{ $user->name }}</a>
            </div>
            <div class="col-sm-3">
                {{ $user->email }}
            </div>
            <div class="col-sm-3">
                {{ $user->role }}
            </div>
            <div class="col-sm-3">
                <a href="/admin/users/{{ $user->hashId() }}">View</a>
                |
                <a href="/admin/users/{{ $user->hashId() }}/edit">View</a>
                |
                <a href="/admin/users/{{ $user->hashId() }}/delete">Delete</a>
            </div>

        </div>
    @endforeach
    </div>


@stop