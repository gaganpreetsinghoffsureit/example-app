<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Activation - {{config("app.name")}}</title>
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
        <h1>Welcome to {{config("app.name")}}!</h1>
        <p>Thank you for signing up. To complete your registration, please use the following One-Time Password (OTP):</p>

        <div class="otp">{{$user->getRememberToken()}}</div>

        <p>Please enter this OTP on the sign-up page to activate your account. The OTP is valid for a limited time, so make sure to use it promptly.</p>

        <a href="[Your Sign-Up Page URL]" class="cta-button">Activate My Account</a>

        <p class="footer">
            If you did not sign up for {{config("app.name")}}, please ignore this email.
            <br>
            Thank you, <br>
            The {{config("app.name")}} Team
        </p>
    </div>
</body>

</html>