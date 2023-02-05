<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'no_access' . config('app.name'))</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .main {
            text-align: center;
        }

        .main img {
            width: 70%;
            margin: 0 0 10px 0;
        }

        .main a {
            display: inline-block;
            background: #e94444;
            color: #fff;
            padding: 10px 10px;
            border-radius: 5px;
            text-decoration: none;
            margin-top: 15px;
            transition: all .3s ease;
        }

        .main a:hover {
            background-color: #e64;
        }
    </style>
</head>

<body>
    <div class="main">
        <img src="{{ asset('adminassets/img/forbidden.png') }}" alt="">
        <h2>You Don't have access to this page</h2>
        <a href="{{ url('/') }}">Go To Home</a>
    </div>
</body>

</html>
