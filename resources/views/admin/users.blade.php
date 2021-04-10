@extends('template')

@section('title')
    Users
@stop

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-sm-3">
                <strong>Username</strong>
            </div>
            <div class="col-sm-2">
                <strong>Role</strong>
            </div>

            <div class="col-sm-2">
                <strong>Join Date</strong>
            </div>
            <div class="col-sm-3">
                <strong>Functions</strong>
            </div>

        </div>
    @foreach($users as $user)
        <div class="row" style="margin-bottom: 12pt;">
            <div class="col-sm-3">
                <a href="/admin/users/{{ $user->hashId() }}">{{ $user->name }}</a><br>
                {{ $user->email }}
            </div>
            <div class="col-sm-2">
                {{ $user->role }}
            </div>

            <div class="col-sm-2">
                {{ $user->created_at->format('M d Y') }}
            </div>

            <div class="col-sm-3">
                <a href="/admin/users/{{ $user->hashId() }}">View</a>
                |
                <a href="/admin/users/{{ $user->hashId() }}/edit">Edit</a>
                |
                <a href="/admin/users/{{ $user->hashId() }}/delete">Delete</a>
            </div>
        </div>
    @endforeach
    </div>

    <div class="d-flex justify-content-center" style="margin-top: 15pt; margin-bottom: 15pt;">
        {!! $users->links() !!}
    </div>

@stop