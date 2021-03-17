<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="site" content="{{ config('app.url') }}">

    <title>{{  config('app.name') }} - @yield('title')</title>

    @include('template.master.css')
    @include('template.master.javascript')

</head>

<body>
<div class="container">

    @include('template.master.navigation')

    <div class="col-sm-12 bg-tertiary" style="padding-top: 3pt; height: 24pt;">
    @if(Auth::guest())
        <form method="post" action="/login">
            @csrf
            <div class="form-row align-items-center justify-content-center">
                <input name="current" type="hidden" value="{{ url()->full() }}">
                <div class="col-auto input-group-sm">
                    <label class="sr-only" for="inlineFormInput">Name</label>
                    <input type="text" class="form-control input-group-sm mb-2" id="inlineFormInput" name="username" placeholder="Username or email">
                </div>
                <div class="col-auto">
                    <label class="sr-only" for="inlineFormInputGroup">Username</label>
                    <div class="input-group input-group-sm mb-2">
                        <input type="password" class="form-control input-group-sm " id="inlineFormInputGroup" name="password" placeholder="Password">
                    </div>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary btn-sm mb-2">Submit</button>
                </div>
                <div class="col-auto">
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" id="autoSizingCheck">
                        <label class="form-check-label" for="autoSizingCheck">
                            Remember me
                        </label>
                    </div>
                </div>
            </div>
        </form>
        @else
        Text here
        @endif
    </div>

<div class="row" style="margin-left: 0pt;  margin-right: 0;">
    <div class="col-sm" style="margin-top: 6pt;">
        @include('template.master.messages')

        @yield('content')
    </div>

    <div class="col-3 side-col d-none d-sm-block" style="margin-top: 6pt;">
        @if (Auth::guest())
            @include('template.sidebar.guest')
        @endif
        @if (Auth::check())
            @include('template.sidebar.content')
            @include('template.sidebar.user')
            @include('template.sidebar.stats')
        @endif
        @if(isset( $type ))
            @if($type == 'post' or $type == 'reply')
            <div class="form-group">
                <label for="exampleInputEmail1">Link this page</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1" id="currentShortUrl" value="{{ $category->url() }}">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" onclick="copyHashId()" type="button" style="background: #fff;">Copy</button>
                    </div>
                </div>
            </div>
            @endif
        @endif
        @yield('sidebar')
         </div>
    </div>
    @include('template.master.footer')

</div>
</body>

</html>
