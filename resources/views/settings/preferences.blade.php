@extends('template')

@section('title')
    Edit Settings
@stop


@section('page-title')
    <h1 class="page-title">Edit Preferences</h1>
@stop


@section('content')
<div class="content">
    <form method="post" action="/user/settings">
        <div class="form-group row">
            <label for="pagination" class="col-sm-6 col-form-label">Maximum Posts Per Page</label>
            <div class="col-sm-6">
                <input type="number" name="pagination" class="form-control" id="pagination" value="{!! preference('pagination', 10) !!}">
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
                        @if($timezone['symbol'] == preference('timezone', 'UTC'))
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
            <label for="userAssets" class="col-sm-6 col-form-label">
                Asset Locations<br>
                <small>Paid users can choose to use locally hosted JS and CSS libraries for greater privacy</small>
            </label>
            <div class="col-sm-6">
                <select name="assets" class="custom-select">
                    @foreach($assets as $asset)
                        @if($asset == preference('assets', 'local'))
                            <option value="{{ $asset }}" selected>{{ $asset }}</option>
                        @else
                            <option value="{{ $asset }}">{{ $asset }}</option>
                        @endif
                    @endforeach
                </select>
                @error('assets')
                <div class="validation-feedback alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>


        <div class="form-group row">
            <label for="userAssets" class="col-sm-6 col-form-label">
                Analytics Engine<br>
                <small>Paid users can preserve their privacy by opting out of being tracked by Google Analytics.</small>
            </label>
            <div class="col-sm-6">
                <select name="analytics" class="custom-select">
                    @foreach($analytics as $analytic)
                        @if($analytic == preference('analytics', 'local'))
                            <option value="{{ $analytic }}" selected>{{ $analytic }}</option>
                        @else
                            <option value="{{ $analytic }}">{{ $analytic }}</option>
                        @endif
                    @endforeach
                </select>
                @error('analytics')
                <div class="validation-feedback alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>


        <div class="form-group row">
            <label for="userAssets" class="col-sm-6 col-form-label">
                Display Advertising<br>
                <small>Paid users can turn off advertising altogether</small>
            </label>
            <div class="col-sm-6">
                <select name="advertising" class="custom-select">
                    @foreach($advertising as $ads)
                        @if($ads == preference('advertising', 'yes'))
                            <option value="{{ $ads }}" selected>{{ $ads }}</option>
                        @else
                            <option value="{{ $ads}}">{{ $ads }}</option>
                        @endif
                    @endforeach
                </select>
                @error('advertising')
                <div class="validation-feedback alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>


        <div class="form-group row">
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">Save Preferences</button>
            </div>
        </div>
        @csrf
    </form>
</div>
@stop