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

<div class="row" style="margin-left: 0pt;  margin-right: 0;">

    <div class="col-lg-9 col-md-8" style="margin-top: 6pt; float:left;">
        @yield('page-title')

        @include('template.master.messages')

        @if($notice ?? '')
            <div class="jumbotron">
                {!! $notice !!}
            </div>
        @endif

        @yield('content')


    </div>

    <div class="col-lg-3 col-md-4 side-col " style="margin-top: 6pt; float:right;">
        @if (Auth::guest())
            @include('template.sidebar.guest')
        @endif
        @if (Auth::check())
            @include('template.sidebar.user')
            @include('template.sidebar.content')
            @include('template.sidebar.stats')
        @endif

        @yield('sidebar')
    </div>
</div>

@include('template.master.footer')

</div>

<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>

</html>
