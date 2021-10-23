<x-app-layout>
    <section class="text-gray-600 body-font">
    <div class="container px-5 py-24 mx-auto flex flex-col">
        <div class="lg:w-4/6 mx-auto">
        <div class="flex flex-col sm:flex-row mt-10">
            <div class="sm:w-1/3 text-center sm:pr-8 sm:py-8">
            <div class="inline-flex items-center justify-center bg-gray-200 text-gray-400">
            <img src="{{ asset('storage/icon/' . $user->icon_image) }}" width="40px" height="40px">
            </div>
            
            <div class="flex flex-col items-center text-center justify-center">
                <h2 class="font-medium title-font mt-4 text-gray-900 text-lg">{{ $user->nickname }}</h2>
                <div class="w-12 h-1 bg-indigo-500 rounded mt-2 mb-4"></div>
                <div style="text-align:center">{{ $engineer->age }}歳</div>
                @if($engineer->gender == 0)
                <div style="text-align:center">男性</div>
                @else
                <div style="text-align:center">女性</div>
                @endif
                @foreach($jobs as $job)
                <div style="text-align:center">{{$job->name}}</div>
                @endforeach
                
                <div style="text-align:center">{{ $user->email }}</div>
                
                @if($engineer->github_url)
                <a href="{{ $engineer->github_url }}" style="display:inline"><img src="{{ asset('image/icon/github.png') }}" width="60px" height="60px"></a>
                @endif
                @if($engineer->facebook_url)
                <a href="{{ $engineer->facebook_url }}" style="display:inline"><img src="{{ asset('image/icon/facebook.png') }}" width="60px" height="60px"></a>
                @endif
                @if($engineer->qiita_url)
                <a href="{{ $engineer->qiita_url }}" style="display:inline"><img src="{{ asset('image/icon/qiita.png') }}" width="60px" height="60px"></a>
                @endif
                

            </div>
            </div>
            
            
            <div class="sm:w-2/3 sm:pl-8 sm:py-8 sm:border-l border-gray-200 sm:border-t-0 border-t mt-4 pt-4 sm:mt-0 text-center sm:text-left">
                @if($mypage)
                    <div>
                        <span class="beforeballoon-left">
                            マイページを編集
                            <div class="balloon-left">
                                <a href="{{ route('mypage.edit', ['id' => Auth::id()]) }}">基本情報を編集</a>
                                <a href="{{ route('portfolio.edit', ['id' => Auth::id()]) }}">製作物を編集</a>
                            </div>
                        </span>
                    </div>
                @endif
                <div class="tab-wrap">
                    <input id="TAB-01" type="radio" name="TAB" class="tab-switch" checked="checked" /><label class="tab-label" for="TAB-01">基本情報</label>
                    <div class="tab-content">
                        <div class="skills" style="font-size:20px">
                            スキルセット
                                @foreach($tags as $tag)
                                <div class="skill" style="font-size:15px">
                                    <li><img src="{{ asset('image' . $tag->icon_path) }}" width="30px" height="30px" style="display:inline;"> {{ $tag->name }}</li>
                                </div>
                                @endforeach
                        </div>
                        <span><br></span>
                        @if($engineer->introduction)
                        <div class="introduction" style="font-size:20px">
                            自己紹介
                            <p style="font-size:15px">{{ $engineer->introduction }}</p>
                        </div>
                        @endif
                    </div>
                    <input id="TAB-02" type="radio" name="TAB" class="tab-switch" /><label class="tab-label" for="TAB-02">製作物</label>
                    <div class="tab-content">
                        @if($products)
                            @foreach($products as $product)
                            <a href="{{ route('portfolioview', ['id' => $product->id]) }}">
                                <li>{{ $product->title }}<br>
                                    <img src="{{ asset('storage/portfolio/' . $products_image["'" . $product->id . "'"]) }}" width="400px" height="225px">
                                    <span><br></span>
                                </li>
                            </a>
                            <span><br></span>
                            @endforeach
                        @endif
                    </div>
                    @if($mypage)
                    <input id="TAB-03" type="radio" name="TAB" class="tab-switch" /><label class="tab-label" for="TAB-03">メッセージ</label>
                    <div class="tab-content">
                        @foreach($chat_users as $chat_user)
                            <a href="{{ route('chat.index', ['id' => $chat_user->id]) }}">
                                <img src="{{ asset('storage/icon/' . $chat_user->icon_image) }}" width="30px" height="30px" style="display:inline;">
                                {{ $chat_user->nickname }}
                            </a>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
  
            
        </div>
        </div>
    </div>
    </section>

</x-app-layout>