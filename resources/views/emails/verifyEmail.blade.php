<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
</head>
<body>
    <p>Dear {{ $username }},</p>
    <p>Thank you for signing up. Please verify your account:</p>
    <a href="{{ route('verification.verify') }}">Verify your account</a>
    <p>Best Regards,</p>
    <p>Restaurant Team</p>
</body>
</html>
