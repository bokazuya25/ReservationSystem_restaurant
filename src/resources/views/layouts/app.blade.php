<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @yield('css')
</head>

<body>
    <header>
        <!-- ハンバーガーメニュー部分 -->
        <div class="header__icon">
            <!-- ハンバーガーメニューの表示・非表示を切り替えるチェックボックス -->
            <input id="drawer__input" class="drawer__hidden" type="checkbox">

            <!-- ハンバーガーアイコン -->
            <label for="drawer__input" class="drawer__open"><span></span></label>

            <!-- メニュー -->
            <nav class="nav__content">
                <ul class="nav__list">
                    <li class="nav__item"><a class="nav__item-link" href="">Home</a></li>
                    <li class="nav__item"><a class="nav__item-link" href="register">Registration</a></li>
                    <li class="nav__item"><a class="nav__item-link" href="login">Login</a></li>
                </ul>
            </nav>
        </div>

        <!-- ヘッダーロゴ -->
        <div class="header__logo">Rese</div>

        @yield('header')

    </header>
    <main>
        @yield('content')
    </main>
</body>

</html>
