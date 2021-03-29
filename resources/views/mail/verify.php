<!DOCTYPE html>
<html>
<head>
    <title>Welcome Email</title>
</head>

<body>
<h2>Your account at {{ config('app.name') }}</h2>
<br/>
Please follow this <a href="{{ config('app.url') }}/verify?token={{ $user->token }}">link</a> to activate your account on {{ config('app.name') }}. <br>
If the link doesn't work, please visit {{ config('app.url') }} and paste the following confirmation code:<br>
<br>
<strong>{{ $user->token }}</strong><br>
<br>
Sincerely,<br>
<br>
<br>
The developers at {{ config('app.name') }}
</body>

</html>