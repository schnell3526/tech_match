<x-app-layout>
  <!-- 検索欄コンテナ -->
  <div class="container mx-auto">
    <div class="pt-8 pb-12">
      <div class="error_messages">
        @if($error2)
        {{ $error2 }}<br>
        検索内容：
        @foreach($words as $word)
        "{{ $word }}"
        @endforeach
        ({{ $andor }})
        @endif
      </div>
      <form class="bg-white flex items-center rounded-full shadow-xl" id="search" action="{{ route('search') }}" method="get">
        <input class="rounded-l-full w-full ml-4 py-4 px-6 text-gray-700 leading-tight focus:outline-none" id="searchbox" name="searchword" type="text" placeholder="キーワードを入力(職種またはスキル)">
        <select name="andor" class="ml-4 py-4 text-gray-700 leading-tight">
          <option name="one">1つで検索</option>
          <option name="and">全件一致</option>
          <option name="or">いずれかに一致</option>
        </select>
        <div class="p-4">
          <x-button class="bg-blue-500 text-white rounded-full p-2 hover:bg-blue-400 focus:outline-none w-12 h-12 flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
              <path d="M23.111 20.058l-4.977-4.977c.965-1.52 1.523-3.322 1.523-5.251 0-5.42-4.409-9.83-9.829-9.83-5.42 0-9.828 4.41-9.828 9.83s4.408 9.83 9.829 9.83c1.834 0 3.552-.505 5.022-1.383l5.021 5.021c2.144 2.141 5.384-1.096 3.239-3.24zm-20.064-10.228c0-3.739 3.043-6.782 6.782-6.782s6.782 3.042 6.782 6.782-3.043 6.782-6.782 6.782-6.782-3.043-6.782-6.782zm2.01-1.764c1.984-4.599 8.664-4.066 9.922.749-2.534-2.974-6.993-3.294-9.922-.749z" />
            </svg>
          </x-button>
        </div>
      </form>
    </div>
  </div>
  <div class="users">
    <!--検索機能が使われた時 -->
    @if($words)
    <div class="searchwords">
      検索内容：
      @foreach($words as $word)
      "{{ $word }}"
      @endforeach
      ({{ $andor }})
    </div>
    <div class="result_main">検索結果：</div>
    @endif
    @if(!$usersdata and !$error2)
    <div class="no_result">
      検索結果が0件です．検索キーワードに余分なスペースなどが入っていないか確かめてください．
    </div>
    @endif


    <!-- ユーザー一覧 -->
    @if($usersdata)
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
      @foreach($usersdata as $userdata)
      <div class="w-full bg-white rounded-lg sahdow-lg overflow-hidden flex flex-col md:flex-row">
        <!-- プロフィール画像 -->
        <div class="w-full md:w-2/5 h-80 justify-center items-center rounded-lg sahdow-lg p-12 flex flex-col">
          <div class="mb-8">
            <img class="object-center object-cover rounded-full h-36 w-36" src="{{ asset('storage/icon/' . $userdata['icon_img']) }}" alt="photo">
          </div>
          <div class="text-center">
            <span class="flex justify-start space-x-2">
              <a href="{{ $userdata['facebook_url'] }}" class="text-gray-500 hover:text-gray-600">
                <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24">
                  <path fill-rule="evenodd" d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm3 8h-1.35c-.538 0-.65.221-.65.778v1.222h2l-.209 2h-1.791v7h-3v-7h-2v-2h2v-2.308c0-1.769.931-2.692 3.029-2.692h1.971v3z" clip-rule="evenodd"></path>
                </svg>
              </a>
              <a href="{{ $userdata['github_url'] }}" class="text-gray-500 hover:text-gray-600">
                <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24">
                  <path fill-rule="evenodd" d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z" clip-rule="evenodd"></path>
                </svg>
              </a>
              <a href="{{ $userdata['qiita_url'] }}" class="text-gray-500 hover:text-gray-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24">
                  <path fill-rule="evenodd" d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" clip-rule="evenodd"></path>
                </svg>
              </a>
            </span>
          </div>
        </div>

        <!-- 職種やスキル -->
        <div class="w-full md:w-3/5 text-left p-6 md:p-4 space-y-2">
          <!-- ニックネーム -->
          <div class="container">
            <a href="{{ route('userpage.index', ['id' => $userdata['user_id']]) }}" class="text-3xl text-gray-700 font-bold hover:underline">{{ $userdata['nickname'] }}</a>
          </div>
          <!-- 職種 -->
          <p class="text-base text-gray-400 font-normal">職種</p>
          @foreach($userdata['jobs'] as $job)
          <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded text-red-600 bg-red-200 uppercase last:mr-0 mr-1">
            {{ $job->name }}
          </span>
          @endforeach
          <!-- スキル -->
          <p class="text-base text-gray-400 font-normal">スキル</p>
          @foreach($userdata['tags'] as $tag)
          <span class="text-xs font-semibold inline-block py-1 px-2 rounded-full text-blue-600 bg-blue-200 last:mr-0 mr-1">
            {{ $tag->name }}
          </span>
          @endforeach
          <!-- 自己紹介 -->
          <p class="text-base text-gray-400 font-normal">自己紹介</p>
          <p class="text-base leading-relaxed .text-black font-normal">{{ $userdata['introduction'] }}</p>
        </div>
      </div>
      @endforeach
    </div>
    @endif
  </div>
  </div>
</x-app-layout>