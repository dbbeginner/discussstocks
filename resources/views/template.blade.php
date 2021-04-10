<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>{{  config('app.name') }} - @yield('title')</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="site" content="{{ config('app.url') }}">
    @include('template.master.analytics')

    @include('template.master.css')
    @include('template.master.javascript')

    <script>
        @if(Auth::guest())
            var $userId = "{{ \Vinkla\Hashids\Facades\Hashids::encode(1) }}";
        @else
            var $userId = "{{ Auth::user()->hashId() }}";
        @endif
    </script>

</head>

<body>
<div class="container">

    @include('template.master.navigation')

<div class="row" style="margin-left: 0pt;  margin-right: 0;">

    <div class="col-lg-9 col-md-8">
        <h1 style="margin-top: 24pt; margin-bottom: 6pt; color: #fff;">
            @yield('title')
        </h1>

        @include('template.master.messages')

        @yield('content')

    </div>

    <div class="col-lg-3 col-md-4 side-col " style="margin-top: 6pt; float:right;">
        @yield('sidebar-before')

    @if (Auth::guest())
            @include('template.sidebar.guest')
        @endif
        @if (Auth::check())
            @include('template.sidebar.user')
            @include('template.sidebar.content')
            @include('template.sidebar.stats')
        @endif

        @if(Auth::check() && Auth::user()->role == 'admin' || Auth::check() && Auth::user()->role == 'superadmin')
            @include('template.sidebar.admin')
        @endif

        @yield('sidebar-after')
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
