<x-app-layout>
    <div class="container">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
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
                        <div class="search" style="display:inline-flex;">
                            <form id="search" action="{{ route('search') }}" method="get">
                                <div>キーワードで検索: </div>
                                <input id="searchbox" name="searchword" type="text" style="width:800px; height:40px;" placeholder="キーワードを入力(複数語の場合はスペースで区切ってください．)" />
                                <select name="andor">
                                    <option name="one">1つで検索</option>
                                    <option name="and">and</option>
                                    <option name="or">or</option>
                                </select>
                                <x-button class="ml-3">
                                    {{ __('検索') }}
                                </x-button>
                            </form>
                        </div>
                    </div>
                </div>
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
            @if(!$usersdata and !$error2)
            <div class="no_result">
                検索結果が0件です．検索キーワードに余分なスペースなどが入っていないか確かめてください．
            </div>
            @endif
            @endif
            <!--検索機能，index共通 -->
            @if($usersdata)

            <!-- ユーザー一覧 -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                <!--  ユーザー -->
                @foreach($usersdata as $userdata)
                <div class="w-full bg-white rounded-lg sahdow-lg overflow-hidden flex flex-col md:flex-row">

                    <!-- アイコン -->
                    <div class="w-full md:w-2/5 h-80">
                        <img class="object-center object-cover w-full h-full" src="{{ asset('storage/icon/' . $userdata['icon_img']) }}" alt="photo">
                    </div>

                    <!-- 職種やスキル -->
                    <div class="w-full md:w-3/5 text-left p-6 md:p-4 space-y-2">

                        <!-- ニックネーム -->
                        <p class="text-xl text-gray-700 font-bold">{{ $userdata['nickname'] }}</p>

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
                        <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-blue-600 bg-blue-200 uppercase last:mr-0 mr-1">
                            {{ $tag->name }}
                        </span>
                        @endforeach

                        <div class="flex justify-start space-x-2">
                            <!-- facebook -->
                            <a href="#" class="text-gray-500 hover:text-gray-600">
                                <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd"></path>
                                </svg>
                            </a>
                            <!-- github -->
                            <a href="#" class="text-gray-500 hover:text-gray-600">
                                <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd"></path>
                                </svg>
                            </a>
                        </div>
                    </div>

                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</x-app-layout>