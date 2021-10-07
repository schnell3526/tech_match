@extends('layout')

@section('content')
    <div class="container">
        
                
        
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
                        検索結果が0件です．検索キーワードにスペースなどが入っていないか確かめてください．
                    </div>
                @endif

            
                @foreach($results as $result)
                    <table>
                        <tr>
                            <a href = "/{{ $result['user_id'] }}/view">
                                <td><img src="{{ $result['icon_img'] }}"></td>
                                <td>{{ $result['nickname'] }}</td>
                                <td>{{ $result['age'] }}<td>
                                <td>
                                    @foreach($result['jobs'] as $job)
                                        <div style="font-size:10px">{{ $job }}</div><br>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($result['tags'] as $tag)
                                        <img src="{{ $tag['color'] }}"><div style="font-size: 10px">{{ $tag['tag_name'] }}</div><br>
                                    @endforeach
                                </td>
                            </a>
                        </tr>
                    </table>
                @endforeach
            </div>          
                
            </div>
        </div>
    </div>
@endsection