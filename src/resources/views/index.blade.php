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

                                <x-button class="ml-3">
                                    {{ __('検索') }}
                                </x-button>
                            </form>            
                        </div>
                    </div>
                </div> 
            </div> 
        </div>      
        
        @if($usersdata)
            @extends('users-layout')
                @foreach($usersdata as $userdata)
                    @section('users')

                    @section('link') {{ $userdata['user_id'] }}/view @endsection
                    
                    @section('icon') <img src="{{ asset('image' . $userdata['icon_img']) }}" width="40px" height="40px"> @endsection
                    
                    @section('nickname') {{ $userdata['nickname'] }} @endsection
                    
                    @section('age') {{ $userdata['age'] }}歳 @endsection
                    
                    @section('gender')
                        @if($userdata['gender'] == 0)
                            男性
                        @endif
                        @if($userdata['gender'] == 1)
                            女性
                        @endif
                    @endsection
                    
                    @section('jobs')
                        @foreach($userdata['jobs'] as $job)
                            {{ $job }}
                        @endforeach 
                    @endsection
                    
                    @section('tags')
                        @foreach($userdata['tags'] as $tag)
                            <div style="background-color: {{ $tag['color'] }};color:white;font-size:px">{{ $tag['tag_name'] }}</div><br>
                        @endforeach
                    @endsection
                    @endsection
                                           
                @endforeach
        @endif

    </div>
</x-app-layout>