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
                                <input id="searchbox" name="searchword" type="text" style="width:800px; height:40px;"
                                    placeholder="キーワードを入力(複数語の場合はスペースで区切ってください．)" />
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
                <section class="text-gray-600 body-font">
                    <div class="container px-5 py-24 mx-auto">
                        <div class="flex flex-wrap -m-2">
                            @foreach($usersdata as $userdata)
                                <div class="p-2 lg:w-1/1 md:w-1/1 w-full" style="background-color:white;">
                                    <a href="{{ route('userpage.index', ['id' => $userdata['user_id']]) }}">
                                        <div class="h-full flex items-center border-gray-200 border p-4 rounded-lg">
                                            <img src="{{ asset('storage/icon/' . $userdata['icon_img']) }}" width="40px" height="40px">
                                            <div class="flex">
                                                <h2 class="text-gray-900 title-font font-medium" style="font-size:20px">{{ $userdata['nickname'] }}</h2>   
                                            </div>
                                            <span>&nbsp;&nbsp;&nbsp;</span>
                                            <div class="attributes1" style="font-size:20px">
                                                {{ $userdata['age'] }}歳<br>
                                                @if($userdata['gender'] == 0)
                                                    男性<br>
                                                @endif
                                                @if($userdata['gender'] == 1)
                                                    女性<br>
                                                @endif
                                            </div>
                                            <span>&nbsp;&nbsp;&nbsp;</span>
                                            <div class="jobs">
                                                @foreach($userdata['jobs'] as $job)
                                                <div class="flex">
                                                    <p class="text-gray-500" style="font-size:20px">{{ $job->name }}</p><br>
                                                </div>
                                                @endforeach 
                                            </div>
                                            <span>&nbsp;&nbsp;&nbsp;</span>
                                            <div class="tags">
                                                @foreach($userdata['tags'] as $tag)
                                                    <div style="background-color: {{ $tag->color }};color:white;font-size:15px;">{{ $tag->name }}</div><br>
                                                @endforeach
                                            </div>
                                            <span>&nbsp;&nbsp;&nbsp;</span>
                                            
                                            @if($userdata['images'])
                                            @foreach($userdata['images'] as $image)
                                            <div class="portfolio">
                                                <img src="{{ asset('image' . $image) }}" style="display:inline" width="256px" height="144px">
                                            </div>
                                            @endforeach
                                            @endif
                                            
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>
            @endif
            
        </div>


    </div>
</x-app-layout>