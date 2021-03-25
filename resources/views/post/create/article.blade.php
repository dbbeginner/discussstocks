@extends('template')

@section('title')
    Create new text post
@stop

@section('content')
        <div class="content">
            <form id="post-create" method="post" action="/post/article/verify">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input class="form-control" type="text" name="title" id="title" placeholder="Title">
                    <small id="titleHelp" class="form-text text-muted">Required.</small>
                    @error('title')
                    <div class="validation-feedback alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description">Add text (optional)</label>
                    <textarea class="form-control" name="content" id="content" placeholder="Write about your channel here"></textarea>
                    <small id="titleHelp" class="form-text text-muted">1000 characters max. <a href="/markdown">Markdown</a> formatting allowed.</small>
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
                    @error('channel')
                    <div class="validation-feedback alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <input type="hidden" name="user_id" value="{{ Auth::user()->hashId() }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <button id="channel-submit" class="btn btn-success">Create</button>
            </form>

        </div>
@stop