@extends('layout')
@section('content')
    <div class="container">


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
                    <input id="searchbutton" type="submit" value="検索" />
                </form>
                
                    
            </div>
    
            <div class="users">
                @if($usersdata)
                    @foreach($usersdata as $userdata)
                    <table width="400px">
                        <tbody>
                            <tr>
                            
                                    <td><a href="{{ $userdata['user_id'] }}/view">
                                        <img src="{{ asset('image' . $userdata['icon_img']) }}" width="20px" height="20px">
                                    </a></td>
                                    <td><a href="{{ $userdata['user_id'] }}/view">{{ $userdata['nickname'] }}</a></td>
                                    <td>{{ $userdata['age'] }}歳</td>
                                    <td>@if($userdata['gender'] == 0)
                                        男性
                                        @endif
                                        @if($userdata['gender'] == 1)
                                        女性
                                        @endif
                                    <td>
                                        @foreach($userdata['jobs'] as $job)
                                            <div style="font-size:10px">{{ $job }}</div><br>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach($userdata['tags'] as $tag)
                                            <div style="background-color: {{ $tag['color'] }};color:white;font-size:10px">{{ $tag['tag_name'] }}</div><br>
                                        @endforeach
                                    </td>
            
                            </tr>
                        </tbody>

                    </table><br>
                    
                    @endforeach
                @endif
                    
                </div>
            </div>
    </div>
@endsection
        
        
