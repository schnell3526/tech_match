<x-app-layout>


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
                    placeholder="キーワードを入力(複数語の場合は全角スペースで区切ってください．)" />
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
                        <table>
                            <tr>
                                <a href="#">
                                    <td><img src="{{ asset('image/' . $userdata['icon_img']) }}"></td>
                                    <td>{{ $userdata['nickname'] }}</td>
                                    <td>{{ $userdata['age'] }}</td>
                                    <td>
                                        @foreach($userdata['jobs'] as $job)
                                            <div style="font-size:10px">{{ $job }}</div><br>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach($userdata['tags'] as $tag)
                                            <img src="{{ $tag['color'] }}"><div style="font-size: 10px">{{ $tag['tag_name'] }}</div><br>
                                        @endforeach
                                    </td>
                                </a>
                            </tr>
                        </table>
                    @endforeach
                @endif
                    
                </div>
            </div>
        
        
</x-app-layout>