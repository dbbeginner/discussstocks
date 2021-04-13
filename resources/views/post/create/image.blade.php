@extends('template')

@section('title')
    Create new text post
@stop

@section('content')
        <div class="content">
            <form id="post-create" method="post" action="/post/image/verify" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input class="form-control" type="text" name="title" id="title" placeholder="Title" value="{{ old('title') }}">
                    <small id="titleHelp" class="form-text text-muted">Required.</small>
                    @error('title')
                    <div class="validation-feedback alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description">Upload Image</label>
                    <input type="file" name="content" class="form-control">
                    <small id="titleHelp" class="form-text text-muted">Max size: 10MB. Allowed file types: GIF, JPEG, PNG</small>
                    @error('content')
                    <div class="validation-feedback alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleFormControlSelect1">Select Channel</label>
                    <select name="channel_id" class="form-control" id="exampleFormControlSelect1">
                        <option selected>Select One...</option>
                        @foreach($subscriptions as $sub)
                            <option value="{{ $sub->hashId() }}">{{ $sub->title }}</option>
                        @endforeach
                    </select>
                    @error('channel_id')
                    <div class="validation-feedback alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <input type="hidden" name="user_id" value="{{ Auth::user()->hashId() }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <button id="channel-submit" class="btn btn-success">Create</button>
            </form>

        </div>
@stop