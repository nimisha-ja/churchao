<!DOCTYPE html>

<html>
<head>
    <meta charset="UTF-8">
    <title>Happy Birthday</title>
</head>
<body style="font-family: Arial, sans-serif; background:#f4f6f8; padding:20px;">
    <div style="max-width:600px; margin:auto; background:#ffffff; padding:25px; border-radius:8px;">
        <h2 style="color:#405189;">🎂 Happy Birthday!</h2>


    <p>Dear <strong><?= esc($name) ?></strong>,</p>

    <p>
        Wishing you a very <strong>Happy Birthday</strong> filled with joy,
        good health, and wonderful moments. 🎉
    </p>

    <p>
        May the year ahead bring you success, happiness,
        and everything you’ve been hoping for.
    </p>

    <br>

    <p>
        Warm wishes,<br>
        <strong><?= esc($appName) ?></strong>
    </p>
</div>


</body>
</html>
