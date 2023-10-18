<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="email-content">
        <h1>Microblog Project</h1>

        <p>Hello {{ $user->information->first_name }},</p>

        <p>Click the button below to verify your email address:</p>

        <a class="button" href="{{ route('verify-email', ['verification_code' => $user->email_verification_code]) }}">
            Verify Email
        </a>

        <p>Or copy and paste the following link in your web browser to verify your email address:</p>

        <p>{{ route('verify-email', ['verification_code' => $user->email_verification_code]) }}</p>

        <p>Thanks,<br>Adrean and Mikco</p>
    </div>
</body>
</html>
