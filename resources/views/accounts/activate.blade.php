@extends('template')

@section('content')
    <form method="post" action="/activate">
        @csrf
        <div class="form-group">
            <label for="token">Paste your activation token here:</label>
            <input type="text" class="form-control form-control-lg" id="token" name="token">
            @error('token')
            <div class="validation-feedback  alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <button class="btn btn-success">Activate</button>
        </div>
    </form>
@stop

@section('sidebar')

@stop

