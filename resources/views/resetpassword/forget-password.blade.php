<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
</head>
<body style="font-family: 'Arial', sans-serif;">

    <h1 style="color: #333;">Password Reset</h1>

    <p>We received a request to reset your password. To proceed, please click the link below:</p>

    <a href="{{ route('reset.password', $token) }}" style="display: inline-block; margin-top: 15px; padding: 10px 20px; background-color: #17a2b8; color: #fff; text-decoration: none; border-radius: 5px;">Reset Password</a>

    <p>If you did not request this password reset, please ignore this email. Your account security is important to us.</p>

    <p>Thank you for choosing our service.</p>

</body>
</html>


