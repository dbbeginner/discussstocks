@inject('renderer', \App\Helpers\TextRenderer::class)

@extends('user.user')

@section('title')
    Stocks mentioned by {{ $user->name }}
@stop

@section('userdata')

    <div class="post-container">

        <table class="table">
            <tr>
                <th>Date</th>
                <th>Symbol</th>
                <th>Name</th>
                <th>Sentiment</th>
                <th>Price<br>When Mentioned</th>
                <th>Price<br>Current</th>
            </tr>
            @foreach($mentions as $mention)
                <tr>
                    <td>{{ $mention->created_at }}</td>
                    <td>{{ $mention->ticker }}</td>
                    <td>{{ $mention->ticker->name ??  "not available yet"}}</td>
                    <td>{{ $mention->sentiment ??  "not available yet" }}</td>
                    <td>{{ $mention->price ??  "not available yet" }}</td>
                    <td>{{ $mention->symbol ??  "not available yet"}}</td>
                </tr>
            @endforeach
        </table>

    </div>
@stop