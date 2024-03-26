<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Link Reset Password</title>
</head>
<body>
    <div style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px;">
        <h2>UINSA FOOD</h2>
        <p>Klik link di bawah ini untuk mereset password Anda:</p>
        <p><a href="{{route('reset.password', ['token' => $token])}}">Reset Password</a></p>
        <p>Jika Anda tidak meminta reset password, abaikan email ini.</p>
        <p>Terima kasih,<br>Official UINSA FOOD</p>
    </div>
</body>
</html>