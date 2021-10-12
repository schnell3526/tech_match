<x-app-layout>
    <div class="container">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="search" style="display:inline-flex;">
                            <form id="search" action="{{ route('search') }}" method="get">
                                
                                <div>キーワードで検索: </div>
                                <input id="searchbox" name="searchword" type="text" style="width:800px; height:40px;" 
                                placeholder="キーワードを入力(複数語の場合は全角スペースで区切ってください．)" />
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

        <div class="results">
            <div class="searchwords">
                検索内容：
                @foreach($words as $word)
                    "{{ $word }}"
                @endforeach
                ({{ $andor }})
            </div>
            <div class="result_main">検索結果：
                @if(count($results) == 0)
                    <div class="no_result">
                        検索結果が0件です．検索キーワードに余分なスペースなどが入っていないか確かめてください．
                    </div>
                            
                @else
                    <section class="text-gray-600 body-font">
                        <div class="container px-5 py-24 mx-auto">
                            <div class="flex flex-wrap -m-2">
                                @foreach($results as $result)
                                    <div class="p-2 lg:w-1/3 md:w-1/2 w-full">
                                        <a href="{{ $result['user_id'] }}/view">
                                            <div class="h-full flex items-center border-gray-200 border p-4 rounded-lg">
                                                <img src="{{ asset('image' . $result['icon_img']) }}" width="40px" height="40px">
                                                <div class="flex">
                                                    <h2 class="text-gray-900 title-font font-medium">{{ $result['nickname'] }}</h2>   
                                                </div>
                                                <span>&nbsp;&nbsp;&nbsp;</span>
                                                <div class="attributes1">
                                                    {{ $result['age'] }}歳<br>
                                                    @if($result['gender'] == 0)
                                                    男性<br>
                                                    @endif
                                                    @if($result['gender'] == 1)
                                                    女性<br>
                                                    @endif
                                                </div>
                                                <span>&nbsp;&nbsp;&nbsp;</span>
                                                <div class="jobs">
                                                    @foreach($result['jobs'] as $job)
                                                    <div class="flex">
                                                        <p class="text-gray-500">{{ $job }}</p><br>
                                                    </div>
                                                    @endforeach 
                                                </div>
                                                <span>&nbsp;&nbsp;&nbsp;</span>
                                                <div class="tags">
                                                    @foreach($result['tags'] as $tag)
                                                        <div style="background-color: {{ $tag['color'] }};color:white;font-size:10px">{{ $tag['tag_name'] }}</div><br>
                                                    @endforeach
                                                </div>
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
    </div>           
</x-app-layout>