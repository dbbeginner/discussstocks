@extends('template')

@section('title')
    {{ $title }}
@stop

@section('styles')
<style>
    table {
        padding: 2pt;
        width: 100%;
        display: table;
        border: 1pt #000 solid;
        margin: 6pt 0pt 12pt 0pt;
    }
    thead {
        background: #000;
        color: #fff;
    }
    thead > tr > th {
        padding: 3pt;
        border: 1pt #fff solid;
    }

    thead > td {
        border: 1pt #fff solid;
    }

    td {
        padding: 3pt;
        border: 1pt #000 solid;
    }
</style>
@stop

@section('content')
    <div class="content">
        {{ Markdown::parse($content) }}
    </div>
@stop

