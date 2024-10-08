<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ココロDiary</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('assets/css/mainLayout.css') }}" rel="stylesheet">
    <style>

    </style>

</head>

<body>
    <header>
        <div class="d-flex align-items-center justify-content-between"
            style="height: 100px; background-color: #ff8484;">
            <div class="fs-2 fw-bold text-light ps-3 ms-3">ココロ Diary . . .</div>
            <ul class="nav me-4">
                <li class="nav-item">
                    <a class="nav-link active text-white" href="{{ route('top.init') }}" aria-current="page">Top</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('top.chart') }}">Chart</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" id="mypageDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name }}のマイページ
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="mypageDropdown">
                        <li><a class="dropdown-item" href="{{ route('account.edit') }}">アカウント変更</a></li>
                        <li><a class="dropdown-item" href="{{ route('invite.send') }}">招待コード送信</a></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="dropdown-item">ログアウト</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </header>
    <main>
        {{ $slot }}
    </main>
    <footer>
        <div class="text-center pt-3 text-white" style="height: 50px; background-color: #ff8484;">
            <div>&copy ココロDiary</div>
        </div>
    </footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.7/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"
        integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    @stack('scripts')
</body>

</html>
