<!DOCTYPE html>
<html>

<head>
    <title>Pending Payment</title>
</head>

<body>
    <h1>Hello student, {{ $user->firstname }} {{ $user->middlename }} {{ $user->lastname }}!</h1>
    <h2>Your payment of {{ $amount }} for {{ $fee_type }} is on pending approval.</h2>
    <h3>Best regards,<br>RedHat Team</h3>
</body>

</html>
