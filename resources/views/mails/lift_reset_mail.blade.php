<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset Code | Lift</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            background: #f4f6f8;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 6px 18px rgba(0,0,0,0.1);
            padding: 30px;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #f0f0f0;
            padding-bottom: 20px;
        }
        .header img {
            height: 60px;
        }
        .title {
            font-size: 24px;
            color: #151546;
            margin: 20px 0 10px;
            text-align: center;
        }
        .message {
            font-size: 16px;
            line-height: 1.6;
            text-align: center;
            margin-bottom: 30px;
        }
        .code-box {
            background: linear-gradient(90deg, #4CC0E8, #E62947);
            color: white;
            font-size: 28px;
            font-weight: bold;
            padding: 15px;
            border-radius: 10px;
            text-align: center;
            letter-spacing: 4px;
            margin: 0 auto 30px;
            width: fit-content;
            box-shadow: 0 4px 10px rgba(0,0,0,0.15);
        }
        .footer {
            text-align: center;
            font-size: 14px;
            color: #777;
            border-top: 1px solid #f0f0f0;
            padding-top: 20px;
        }
        .footer a {
            color: #4CC0E8;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <img src="https://vicsystems.us/lift_me_logo.png" alt="Lift Logo">
        </div>

        <!-- Title -->
        <div class="title">Password Reset Request</div>

        <!-- Message -->
        <div class="message">
            We received a request to reset your password.
            Use the reset code below to proceed:
        </div>

        <!-- Reset Code -->
        <div class="code-box">
            {{ $resetCode }}
        </div>

        <!-- Footer -->
        <div class="footer">
            If you didn’t request this, you can safely ignore this email.
            <br><br>
            &copy; {{ date('Y') }} <a href="https://vicsystems.us">Lift</a>. All rights reserved.
        </div>
    </div>
</body>
</html>
