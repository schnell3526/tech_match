<x-app-layout>

    <div class="container">

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="error_messages">

                            @if($errors->any())
                            @foreach($errors->all() as $message)
                            <script>
                            alert('{{ $message }}')
                            </script>
                            @endforeach

                            @endif
                            @if($error2)
                            {{ $error2 }}
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
                                <button id="searchbutton" type="submit">検索</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if($usersdata)
        <div class="users">
            <section class="text-gray-600 body-font">
                <div class="container px-5 py-24 mx-auto">
                    <div class="flex flex-wrap -m-2">
                        @foreach($usersdata as $userdata)
                        <div class="p-2 lg:w-1/3 md:w-1/2 w-full">
                            <a href="{{ $userdata['user_id'] }}/view">
                                <div class="h-full flex items-center border-gray-200 border p-4 rounded-lg">
                                    <img src="{{ asset('image' . $userdata['icon_img']) }}" width="40px" height="40px">
                                    <div class="flex">
                                        <h2 class="text-gray-900 title-font font-medium">{{ $userdata['nickname'] }}
                                        </h2>
                                    </div>
                                    <span>&nbsp;&nbsp;</span>
                                    <div style="font-size:12px;display:inline-block;_display:inline;">
                                        {{ $userdata['age'] }}歳<br>
                                        @if($userdata['gender'] == 0)
                                        男性<br>
                                        @endif
                                        @if($userdata['gender'] == 1)
                                        女性<br>
                                        @endif
                                    </div>
                                    <span>&nbsp;&nbsp;</span>
                                    <div class="jobs">
                                        @foreach($userdata['jobs'] as $job)
                                        <div class="flex">
                                            <p class="text-gray-500" style="font-size:12px;">{{ $job }}</p><br>
                                        </div>
                                        @endforeach
                                    </div>
                                    <span>&nbsp;&nbsp;</span>
                                    <div class="tags">
                                        @foreach($userdata['tags'] as $tag)
                                        <div style="background-color: {{ $tag['color'] }};color:white;font-size:10px">
                                            {{ $tag['tag_name'] }}</div><br>
                                        @endforeach
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </section>
        </div>
        @endif

    </div>
</x-app-layout>