<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ココロDiary</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net" rel="preconnect">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <!-- Custom Styles -->
    <style>
        body {
            font-family: 'Figtree', sans-serif;
            color: #ff8484;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .header {
            text-align: center;
            padding: 20px;
        }

        .header img {
            width: 50px;
            height: 50px;
        }

        .header h1 {
            margin: 10px 0;
            font-size: 2.5rem;
        }

        .btn-custom {
            background-color: #ffffff;
            color: #ff8484;
            border: 1px solid #ff8484;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 1.2rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-custom:hover {
            background-color: #ffe5e5;
        }
    </style>
</head>

<body>
    <div class="header">
        <img src="{{ asset('assets/images/kokoro.png') }}" alt="ココロDiary ロゴ">
        <h1>ココロDiary</h1>
    </div>

    @if (Route::has('login'))
        <div class="d-flex gap-3">
            @auth
                <a class="btn btn-custom" href="{{ url('/top') }}">dashboard</a>
            @else
                <a class="btn btn-custom" href="{{ route('login') }}">ログイン</a>
                @if (Route::has('register'))
                    <a class="btn btn-custom" href="{{ route('register') }}">新規登録</a>
                @endif
            @endauth
        </div>
    @endif

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+YIB1DPP5yLZ9ggPCg8hxaFQ00CMF" crossorigin="anonymous">
    </script>
</body>

</html>
