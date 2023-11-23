<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset - {{config("app.name")}}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
        }

        p {
            color: #555;
        }

        .otp {
            font-size: 24px;
            font-weight: bold;
            color: #4285f4;
        }

        .cta-button {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            background-color: #4285f4;
            color: #fff;
            text-decoration: none;
            border-radius: 3px;
        }

        .footer {
            margin-top: 20px;
            color: #888;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Password Reset</h2>
        <p>Hi {{config("app.name")}},</p>
        <p>We received a request to reset your password. Here is your One-Time Password (OTP):</p>
        <h3 class="otp">{{$user->getRememberToken()}}</h3>
        <p>This OTP is valid for a short duration. Please use it to reset your password.</p>
        <p>If you didn't request a password reset, please ignore this email.</p>
        <p> Thank you, <br>
            The {{config("app.name")}} Team
        </p>
    </div>
</body>

</html>