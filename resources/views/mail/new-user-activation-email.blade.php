<!DOCTYPE html>
<html>
<head>
    <title>Welcome Email</title>

    <style>
        body {
            background: #428df5;
            font-family: Arial, Helvetica, sans-serif;
            line-height: 16pt;
            color: #fff;
            font-size: 10pt;
        }
        a {
            color: #fff;
            font-weight: bold;
        }

        .content {
            margin: 12pt auto 12pt auto;
            width: 100%;
            max-width: 800pt;
            color: #6e6e6e;
            background: #fff;
            padding: 12pt;
            border-radius: 5pt;
        }

        .content > a {
            color: #999999;
        }
    </style>
</head>

<body>

<div class="content">

    <h2>Your account at {{ config('app.name') }}</h2>
    <br/>
    Please follow this <a href="{{ config('app.url') }}/activate?token={{ $user->token }}">link</a> to activate your account on {{ config('app.name') }}. <br>
    If the link doesn't work, please visit {{ config('app.url') }} and paste the following confirmation code:<br>
    <br>
    <strong>{{ $user->token }}</strong><br>
    <br>
    Sincerely,<br>
    <br>
    <br>
    The developers at {{ config('app.name') }}
</div>
</body>

</html>
