<header class="text-gray-600 body-font">
    <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center">
        <!-- ロゴ部分 -->
        <a class="flex title-font font-medium items-center text-gray-900 mb-4 md:mb-0" href="/">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-linecap="round"
                stroke-linejoin="round" stroke-width="2" class="w-10 h-10 text-white p-2 bg-indigo-500 rounded-full"
                viewBox="0 0 24 24">
                <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
            </svg>
            <span class="ml-3 text-xl">{{ config('app.name') }}</span>
        </a>
        <!-- ヘッダー上のボタン -->
        <nav class="md:ml-auto flex flex-wrap items-center text-base justify-center">
            <a class="mr-5 hover:text-gray-900">お気に入り</a>
            <a class="mr-5 hover:text-gray-900">Second Link</a>
            <a class="mr-5 hover:text-gray-900">Third Link</a>
            <a class="mr-5 hover:text-gray-900">Fourth Link</a>
        </nav>

        @guest
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
        @endguest

        @auth
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button
                class="inline-flex items-center bg-gray-100 border-0 py-1 px-3 focus:outline-none hover:bg-gray-200 rounded text-base mt-4 md:mt-0" type="submit" value="logout">ログアウト
                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    class="w-4 h-4 ml-1" viewBox="0 0 24 24">
                    <path d="M5 12h14M12 5l7 7-7 7"></path>
                </svg>
            </button>
        </form>
        @endauth
    </div>
</header>