<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Time-card</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')
</head>
<body>
    <header class="header_time-card">
                <div class="header__inner">
            <a href="/">
                <img src="{{ asset('storage/products/COACHTECHヘッダーロゴ.png') }}">
            </a>
        </div>
        <div>
        @auth
            <a class="header__logout" href="/logout"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            ログアウト
            </a>
            <form class="logout_form" id="logout-form" action="/logout" method="post">
                @csrf
            </form>
            <a class="header__mypage" href="/mypage">マイページ</a>
            <a class="header__sell" href="/sell">出品</a>
        @else
            <a class="header__login" href="/login">ログイン</a>
        @endauth
        </div>
    </header>
    <main>
        @yield('content')
    </main>
</body>
</html>