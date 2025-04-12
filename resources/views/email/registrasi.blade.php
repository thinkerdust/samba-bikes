<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Registration Confirmed</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6;">
    <h2>Hi {{ $participant['nama'] }},</h2>

    <p>🎉 Thank you for registering for the <strong>Samba Bikes Event</strong>!</p>

    <p>Here are your registration details:</p>
    <ul>
        <li><strong>Name:</strong> {{ $participant['nama'] }}</li>
        <li><strong>Email:</strong> {{ $participant['email'] }}</li>
        <li><strong>Phone:</strong> {{ $participant['phone'] }}</li>
        <li><strong>Event:</strong> {{ $participant['event'] }}</li>
    </ul>

    <p>We look forward to riding with you! 🚴‍♂️</p>

    <p>If you have any questions, feel free to reply to this email.</p>

    <br>
    <p>Cheers,</p>
    <p><strong>Samba Bikes Team</strong></p>
</body>
</html>
