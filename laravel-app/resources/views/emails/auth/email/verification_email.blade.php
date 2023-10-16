<!DOCTYPE html>
<html>
<head>
    <style>
        .email-content {
            background-color: #f4f4f4;
            padding: 20px;
            font-family: Arial, sans-serif;
        }
        
        .button {
            background-color: #007BFF;
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            display: inline-block;
        }

    </style>
</head>
<body>
    <div class="email-content">
        <h1>Microblog Project</h1>

        <p>Hello {{ $user->information->first_name }},</p>

        <p>Click the button below to verify your email address:</p>

        <a class="button" href="{{ route('verify_email', ['verification_code' => $user->email_verification_code]) }}">
            Verify Email
        </a>

        <p>Or copy and paste the following link in your web browser to verify your email address:</p>

        <p>{{ route('verify_email', ['verification_code' => $user->email_verification_code]) }}</p>

        <p>Thanks,<br>Adrean and Mikco</p>
    </div>
</body>
</html>
