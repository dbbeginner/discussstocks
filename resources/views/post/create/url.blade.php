@extends('template')

@section('title')
Share a URL
@stop

@section('content')

    <div class="content">
        <form id="post-create" method="post" action="/post/url/verify">
            <div class="form-group">
                <label for="description">URL</label>
                <textarea class="form-control" name="url" id="url" placeholder="http://example.com/">{{ old('url') }}</textarea>
                <small id="titleHelp" class="form-text text-muted">2048 characters max.</small>
                @error('url')
                <div class="validation-feedback alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="title">Title</label>
                <div class="input-group mb-3">
                    <input id="title" name="title" type="text" class="form-control" placeholder="Example" aria-label="page-title" value="{{ old('title') }}">
                    <div class="input-group-append">
                        <button id="get-title" class="btn btn-outline-secondary" type="button" onclick="getTitle()">Get</button>
                    </div>
                </div>

                <small id="titleHelp" class="form-text text-muted">Required.</small>
                @error('title')
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
            <button id="channel-submit" class="btn btn-success" onclick="getTitle()">Create</button>
        </form>
    </div>

@stop