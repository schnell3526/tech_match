@extends('layout')

@section('content')
    <div class="container">
        <div class="search" style="display:inline-flex;">
            <form id="wordsearch" action="{{ route('wordsearch') }}" method="get">
                <div>キーワードで検索: </div>
                <input id="searchbox" name="searchword" type="text" placeholder="キーワードを入力" />
                <input id="searchbutton1" type="submit" value="検索" />
            </form>
            &nbsp;&nbsp;&nbsp;
        
            <form id="jobsearch" action="{{ route('jobsearch') }}" method="get">
                <div>職種で検索: </div>
                <select name="job1">
                    @foreach($jobs as $job)
                        <option value="{{ $job->id }}">{{ $job->job_name }}</option>
                    @endforeach
                </select>
                <select name="andor">
                    <option>and</option>
                    <option>or</option>
                </select>
                <select name="job2">
                    @foreach($jobs as $job)
                        <option value="{{ $job->id }}">{{ $job->job_name }}</option>
                    @endforeach
                </select>
                <input id="searchbutton2" type="submit" value="検索"　/>
            </form>
            &nbsp;&nbsp;&nbsp;
            
            <form id="tagsearch" action="{{ route('tagsearch') }}" method="get">
                <div>スキルで検索: </div>
                <select name="tag1">
                    @foreach($tags as $tag)
                        <option value="{{ $tag->id }}">{{ $tag->tag_name }}</option>
                    @endforeach
                </select>
                <select name="andor">
                    <option>and</option>
                    <option>or</option>
                </select>
                <select name="tag2">
                    @foreach($tags as $tag)
                        <option value="{{ $tag->id }}">{{ $tag->tag_name }}</option>
                    @endforeach
                </select>
                <input id="searchbutton3" type="submit" value="検索"　/>
            </form> 
                
        </div>

        <div class="users">
            @foreach($usersdata as $userdata)
            <table>
                <tr>
                    <a href = "/{{ $userdata['user_id'] }}/view">
                        <td><img src="{{ $userdata['icon_img'] }}"></td>
                        <td>{{ $userdata['nickname'] }}</td>
                        <td>{{ $userdata['age'] }}<td>
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
                
            </div>
        </div>
    </div>
@endsection