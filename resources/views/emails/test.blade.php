<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Exclusive Trial Subscription Key Awaits!</title>
    <style>
        /* Add your CSS styles here */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo img {
            max-width: 200px;
        }

        .content {
            text-align: justify;
        }

        .cta-button {
            display: inline-block;
            background-color: #007bff;
            color: #ffffff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="logo">
            <img src="your-logo.png" alt="Your Website Name">
        </div>
        <div class="content">
            <p>Welcome aboard to {{ $mailData['name'] }}! 🎉</p>
            <p>We're thrilled to have you as part of our community and are excited to offer you an exclusive trial subscription key to unlock all the premium features our platform has to offer.</p>
            <p>Your trial subscription key: <strong>[Insert Trial Key Here]</strong></p>
            <p>With this key, you'll gain access to:</p>
            <ul>
                <li>Name: {{ $mailData['name'] }}</li>
                <li>Username:&nbsp;{{ $mailData['username'] }}</li>
                <li>Password: {{ $mailData['password'] }}</li>
                <li>URL : {{ $mailData['url'] }}</li>
            </ul>
            <p>To activate your trial subscription, simply follow these steps:</p>
            <ol>
                <li>Log in to your [Your Website Name] account.</li>
                <li>Navigate to the subscription section.</li>
                <li>Enter the provided trial key when prompted.</li>
                <li>Voila! You're all set to explore and enjoy the full potential of [Your Website Name].</li>
            </ol>
            <p>But hurry, this trial subscription key is only valid for a limited time, so make sure to redeem it soon to make the most of your experience.</p>
            <p>If you have any questions or need assistance, our support team is here to help. Just shoot us an email at <a href="mailto:support@example.com">support@example.com</a>.</p>
            <p>Thank you for choosing [Your Website Name]! We can't wait to see what you create.</p>
        </div>
        <div class="cta-button">
            <a href="#" style="color: #ffffff; text-decoration: none;">Activate Your Trial Now</a>
        </div>
    </div>
</body>

</html>