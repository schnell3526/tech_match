<header class="text-gray-600 body-font">
  <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center">
    <a class="flex title-font font-medium items-center text-gray-900 mb-4 md:mb-0" href="/">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-10 h-10 text-white p-2 bg-indigo-500 rounded-full" viewBox="0 0 24 24">
        <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
      </svg>
      <span class="ml-3 text-xl">Tech Match</span>
    </a>
    
    @if(!Auth::check())
    <nav class="md:ml-auto flex flex-wrap items-center text-base justify-center">
      <a class="mr-5 hover:text-gray-900">Second Link</a>
      <a class="mr-5 hover:text-gray-900">Third Link</a>
      <a class="mr-5 hover:text-gray-900">Fourth Link</a>
    </nav>
    
      <nav class="my-navbar-signin-signup">
        <a class="my-navbar-signin" href="/login" style="color:black">Log in</a>
          <span>/</span>
            <span class="my-navbar-signup" style="color:black;">Sign up
              <div class="balloon">
                <a class="signin-menu" href="/user/register">エンジニアの方</a><br>
                <a class="signin-menu" href="/company/register">企業の方</a>
              </div>
            </span>
      </nav>
    @endif

    @if( Auth::check())

    <nav class="md:ml-auto flex flex-wrap items-center text-base justify-center">
      <a class="mr-5 hover:text-gray-900">お気に入り</a>
      <a class="mr-5 hover:text-gray-900">Second Link</a>
      <a class="mr-5 hover:text-gray-900">Third Link</a>
      
    </nav>
      <nav class="login-user">
        <span class="beforeballoon">
          <img src="{{ asset('storage/icon/' . Auth::user()->icon_image) }}" width="30px" height="30px" style="display:inline">: {{ Auth::user()->nickname }}
            <div class="balloon2">
              <a class="mypage" href="/mypage">マイページ</a><br>
              <a class="logout" href="/logout">ログアウト</a>
            </div>
        </span>
      </nav>
          
    @endif
  </div>
</header>