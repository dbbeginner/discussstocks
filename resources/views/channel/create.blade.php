@extends('template.template')

@section('content')

<form id="channel-create" method="post" action="/channel/create">
    <div style="width: 100%; display: inline-block; margin-bottom: 20pt;">
            <div class="col-md-6 offset-md-3 bg-tertiary" >
                <div class="form-group">
                    <label for="title">Give your channel a title</label>
                    <input class="form-control" type="text" name="title" id="title" placeholder="Title">
                    <small id="titleHelp" class="form-text text-muted">Required. 60 characters max. Letters, numbers, spaces only.</small>
                    @error('title')
                        <div class="validation-feedback alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description">And lets get a description for your channel</label>
                    <textarea class="form-control" name="description" id="description" placeholder="Write about your channel here"></textarea>
                    <small id="titleHelp" class="form-text text-muted">1000 characters max. <a href="/markdown">Markdown</a> formatting allowed.</small>
                    @error('description')
                        <div class="validation-feedback alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                <button id="channel-submit" class="btn btn-success">Create</button>
            </div>
        </div>
    </form>

@stop
