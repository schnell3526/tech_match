<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>tech_match</title>
    @yield('styles')
    <link rel="stylesheet" href="/css/styles.css">
</head>
<body>
    <header>
        <nav class="my-navbar">
            <a class="my-navbar-brand" href="/index">tech_match</a>
            @if( !Auth::check())
                <nav class="my-navbar-signin-signup">
                    <a class="my-navbar-signin" href="/login">Log in</a>
                    <span>/</span>
                    <span class="my-navbar-signup">Sign up
                        <div class="balloon">
                            <a class="signin-menu" href="/user/register">エンジニアの方</a><br>
                            <a class="signin-menu" href="/company/register">企業の方</a>
                        </div>
                    </span>
                </nav>
            @endif

            @if( Auth::check())
                <nav class="login-user">
                    <span class="login-user-data"><img src="{{ $loginuser->icon_img }}">: {{ $loginuser->nickname }}
                        <div class="balloon2">
                            <a class="mypage" href="/{{ $loginuser->id }}/view">マイページ</a>
                            <a class="logout" href="/logout">ログアウト</a>
                        </div>
                    </span>
                </nav>
            @endif
            
        </nav>

        <nav class="menu-bar">
            <div class="menu-bar-items">
                @if( Auth::check())
                <a class="like" href="#" style="color:#ffffff">お気に入り</a>
                @endif
            </div> 
        </nav>
    </header>

    <main>
        @yield('content')
    </main>
</body>
</html>