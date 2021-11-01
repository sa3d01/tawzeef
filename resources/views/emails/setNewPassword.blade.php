<!DOCTYPE html>
<html>
<head>
    <title>Welcome Email</title>
</head>
<body>
<h2>Welcome to bebaan </h2>
<br/>
Your registered email-id is {{$user['email']}} , Please click on the below link to set new password to your account
<br/>
<?php
$passwordResetObject = \App\Models\PasswordReset::where([
    'email' => $user['email']
])->latest()->first();
?>
<a href="https://bebaan.net/auth/reset-password/'.{{$passwordResetObject->token}}.'">Set New Password</a>
</body>
</html>
