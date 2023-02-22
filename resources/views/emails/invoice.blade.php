<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('invoice' . config('app.name'))</title>
</head>

<body>
    <h1>Dear {{ $name }}</h1>

    <br>

    <p>Thank you for shooping on our website</p>
    <p>PFA to the invoice </p>
    <br>
    <br>
    <p>Best Regards</p>
</body>

</html>
