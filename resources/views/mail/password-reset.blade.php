<!DOCTYPE html>
<html>
<head>
    <title>Password Reset</title>
</head>

<body>
<h2>{{ config('app.name') }}: Password Reset Request</h2>
<br/>
Someone submitted a password reset request for your account at {{ config('app.name') }}. If this wasn't you, you may ignore
this email. If this request was from you, please follow this link and follow the instructions to set a new password on
your account.

Link: <a href="{{ config('app.url') }}/reset-password/{{ $user->password_reset()->token }}"> {{ config('app.url') }}/reset-password/{{ $user->password_reset()->token }}
</a><br>
Thank you!<br>
<br>
<br>
The Developer(s) at {{ config('app.name') }}
</body>

</html>