@extends('template')

@section('title')
    Edit Settings
@stop


@section('page-title')
    <h1 class="page-title">Edit Settings</h1>
@stop


@section('content')
<div class="content">
    <form method="post" action="/user/settings">
        <div class="form-group row">
            <label for="pagination" class="col-sm-6 col-form-label">Maximum Posts Per Page</label>
            <div class="col-sm-6">
                <input type="number" name="pagination" class="form-control" id="pagination" value="{!! setting('pagination') !!}">
                @error('pagination')
                <div class="validation-feedback alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="userTimezone" class="col-sm-6 col-form-label">Timezone</label>
            <div class="col-sm-6">
                <select name="timezone" class="custom-select">
                    @foreach($timezones as $timezone)
                        @if($timezone['symbol'] == setting('timezone'))
                        <option value="{{ $timezone['symbol'] }}" selected> {{ $timezone['title'] }} UTC{{ $timezone['offset'] }}</option>
                        @else
                        <option value="{{ $timezone['symbol'] }}"> {{ $timezone['title'] }} UTC{{ $timezone['offset'] }}</option>
                        @endif
                    @endforeach
                </select>
                @error('timezone')
                <div class="validation-feedback alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">Save Settings</button>
            </div>
        </div>
        @csrf
    </form>
</div>
@stop