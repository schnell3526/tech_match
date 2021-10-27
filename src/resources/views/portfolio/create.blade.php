<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Dashboard') }}
      </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:p-6 lg:p-8">
          <div class="flex p-2">
            <button class="portfolio flex-auto m-1 py-2 bg-blue-400 text-white font-semibold rounded bg-blue-500" data-num=1>ポートフォリオ１</button>
            <button class="portfolio flex-auto m-1 py-2 bg-blue-400 text-white font-semibold rounded" data-num=2>ポートフォリオ2</button>
            <button class="portfolio flex-auto m-1 py-2 bg-blue-400 text-white font-semibold rounded" data-num=3>ポートフォリオ3</button>
          </div>
    </div>
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            
              <div class="p-6 bg-white border-b border-gray-200">
                <x-auth-validation-errors class="mb-4" :errors="$errors" /> 
                <form method="post" action="{{ route('portfolio.store')}}" enctype="multipart/form-data" >
                    @csrf

                    {{--・・・・・・・・・・・・・ ポートフォリオ１のボタンクリック時に表示するフォーム・・・・・・・・・・・・・ --}}
                    <div class="nohidden" id="1">
                      <h1>portfolio1</h1>
                      <div class="-m-2">
                        <div class="p-2 w-1/2 mx-auto">
                          <div class="relative">
                            <label for="title" class="leading-7 text-sm text-gray-600">タイトル　<span class="text-red-600">※必須</span></label>
                            <input type="text" id="title" name="item[0][title]" value="{{ old('title') }}" required class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                          </div>
                        </div>
                        <div class="p-2 w-1/2 mx-auto">
                          <div class="relative">
                            <label for="image" class="leading-7 text-sm text-gray-600">ポートフォリオ画像　<span class="text-red-600">※画像は最大３枚までにしてください</span></label>
                            <input type="file" id="image" name="item[0][image][]" value="{{ old('image') }}" multiple required class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                          </div>
                        </div> 
                        <div class="p-2 w-1/2 mx-auto">
                          <div class="relative">
                            {{-- <x-image  type="portfolio"/> --}}
                          </div>
                        </div> 
                        <div class="p-2 w-1/2 mx-auto">
                          <div class="relative">
                            <label for="description" class="leading-7 text-sm text-gray-600">説明　<span class="text-red-600">※必須</span></label>
                            <textarea id="description" name="item[0][description]" rows="10"  required class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">{{ old('description') }}</textarea>
                          </div>
                        </div>
                        <div class="p-2 w-1/2 mx-auto">
                          <div class="relative">
                            <label for="url" class="leading-7 text-sm text-gray-600">URL 　<span class="text-red-600">※必須</span></label>
                            <input type="text" id="url" name="item[0][url]" value="{{ old('url') }}" required class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                          </div>
                        </div>
                        <div class="p-2 w-1/2 mx-auto">
                          <div class="relative">
                            <label for="src_url" class="leading-7 text-sm text-gray-600">src_url 　<span class="text-red-600">※必須</span></label>
                            <input type="text" id="src_url" name="item[0][src_url]" value="{{ old('src_url') }}" required class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                          </div>
                        </div>

                        {{-- <div class="p-2 w-1/2 mx-auto">
                          <div class="relative">
                            <label for="category" class="leading-7 text-sm text-gray-600">カテゴリー</label> --}}
                            {{-- <select name="category" id="category" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                              @foreach($categories as $category)
                                <optgroup label="{{ $category->name }}">
                                @foreach($category->secondary as $secondary)
                                  <option value="{{ $secondary->id}}" >
                                    {{ $secondary->name }}
                                  </option>
                                @endforeach
                              @endforeach
                            </select> --}}
                            
                          {{-- </div>
                        </div> --}}

                        {{-- <div class="p-2 w-1/2 mx-auto">
                          <div class="relative">
                            <label for="category" class="leading-7 text-sm text-gray-600">商品画像</label> --}}
                            {{-- <x-select-image :images="$images" name="image1" />
                            <x-select-image :images="$images" name="image2" />
                            <x-select-image :images="$images" name="image3" />
                            <x-select-image :images="$images" name="image4" />
                            <x-select-image :images="$images" name="image5" /> --}}

                            {{-- <div class="p-2 w-1/2 mx-auto">
                              <div class="relative flex justify-around">
                                <div><input type="radio" name="is_selling" value="1" class="mr-2" checked>販売中</div>
                                <div><input type="radio" name="is_selling" value="0" class="mr-2" >停止中</div>
                              </div>
                            </div> --}}
                            
                            <div class="p-2 w-full flex justify-around mt-4">
                              <button type="button" onclick="location.href='{{ route('mypage.index')}}'" class="bg-gray-200 border-0 py-2 px-8 focus:outline-none hover:bg-gray-400 rounded text-lg">戻る</button>
                              <button type="submit" class="text-white bg-green-500 border-0 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-lg">登録する</button>                        
                            </div>
                          {{-- </div> --}}
                        {{-- </div> --}}
                      </div>
                    </div>

                    {{--・・・・・・・・・・・・・ ポートフォリオ2のボタンクリック時に表示するフォーム・・・・・・・・・・・・・ --}}
                    <div class="hidden" id="2">
                      <h1>portfolio2</h1>
                      <div class="-m-2">
                        <div class="p-2 w-1/2 mx-auto">
                          <div class="relative">
                            <label for="title" class="leading-7 text-sm text-gray-600">タイトル　<span class="text-red-600">※必須</span></label>
                            <input type="text" id="title" name="item[1][title]" value="{{ old('title') }}" required class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                          </div>
                        </div>
                        <div class="p-2 w-1/2 mx-auto">
                          <div class="relative">
                            <label for="image" class="leading-7 text-sm text-gray-600">ポートフォリオ画像　<span class="text-red-600">※画像は最大３枚までにしてください</span></label>
                            <input type="file" id="image" name="item[1][image][]" value="{{ old('image') }}" multiple required class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                          </div>
                        </div> 
                        <div class="p-2 w-1/2 mx-auto">
                          <div class="relative">
                            {{-- <x-image  type="portfolio"/> --}}
                          </div>
                        </div> 
                        <div class="p-2 w-1/2 mx-auto">
                          <div class="relative">
                            <label for="description" class="leading-7 text-sm text-gray-600">説明</label>
                            <textarea id="description" name="item[1][description]" rows="10"   class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">{{ old('description') }}</textarea>
                          </div>
                        </div>
                        <div class="p-2 w-1/2 mx-auto">
                          <div class="relative">
                            <label for="url" class="leading-7 text-sm text-gray-600">URL </label>
                            <input type="text" id="url" name="item[1][url]" value="{{ old('url') }}" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                          </div>
                        </div>
                        <div class="p-2 w-1/2 mx-auto">
                          <div class="relative">
                            <label for="src_url" class="leading-7 text-sm text-gray-600">src_url </label>
                            <input type="text" id="src_url" name="item[1][src_url]" value="{{ old('src_url') }}" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                          </div>
                        </div>

                        {{-- <div class="p-2 w-1/2 mx-auto">
                          <div class="relative">
                            <label for="category" class="leading-7 text-sm text-gray-600">カテゴリー</label> --}}
                            {{-- <select name="category" id="category" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                              @foreach($categories as $category)
                                <optgroup label="{{ $category->name }}">
                                @foreach($category->secondary as $secondary)
                                  <option value="{{ $secondary->id}}" >
                                    {{ $secondary->name }}
                                  </option>
                                @endforeach
                              @endforeach
                            </select> --}}
                            
                          {{-- </div>
                        </div> --}}

                        {{-- <div class="p-2 w-1/2 mx-auto">
                          <div class="relative">
                            <label for="category" class="leading-7 text-sm text-gray-600">商品画像</label> --}}
                            {{-- <x-select-image :images="$images" name="image1" />
                            <x-select-image :images="$images" name="image2" />
                            <x-select-image :images="$images" name="image3" />
                            <x-select-image :images="$images" name="image4" />
                            <x-select-image :images="$images" name="image5" /> --}}

                            {{-- <div class="p-2 w-1/2 mx-auto">
                              <div class="relative flex justify-around">
                                <div><input type="radio" name="is_selling" value="1" class="mr-2" checked>販売中</div>
                                <div><input type="radio" name="is_selling" value="0" class="mr-2" >停止中</div>
                              </div>
                            </div> --}}
                            
                            <div class="p-2 w-full flex justify-around mt-4">
                              <button type="button" onclick="location.href='{{ route('mypage.index')}}'" class="bg-gray-200 border-0 py-2 px-8 focus:outline-none hover:bg-gray-400 rounded text-lg">戻る</button>
                              <button type="submit" class="text-white bg-green-500 border-0 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-lg">登録する</button>                        
                            </div>
                          {{-- </div> --}}
                        {{-- </div> --}}
                      </div>
                    </div>
                    {{--・・・・・・・・・・・・・ ポートフォリオ3のボタンクリック時に表示するフォーム・・・・・・・・・・・・・ --}}
                    <div class="hidden" id="3">
                      <h1>portfolio3</h1>
                      <div class="-m-2 ">
                        <div class="p-2 w-1/2 mx-auto">
                          <div class="relative">
                            <label for="title" class="leading-7 text-sm text-gray-600">タイトル</label>
                            <input type="text" id="title" name="item[2][title]" value="{{ old('title') }}" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                          </div>
                        </div>
                        <div class="p-2 w-1/2 mx-auto">
                          <div class="relative">
                            <label for="image" class="leading-7 text-sm text-gray-600">ポートフォリオ画像　<span class="text-red-600">※画像は最大３枚までにしてください</span></label>
                            <input type="file" id="image" name="item[2][image][]" value="{{ old('image') }}" multiple class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                          </div>
                        </div> 
                        <div class="p-2 w-1/2 mx-auto">
                          <div class="relative">
                            {{-- <x-image  type="portfolio"/> --}}
                          </div>
                        </div> 
                        <div class="p-2 w-1/2 mx-auto">
                          <div class="relative">
                            <label for="description" class="leading-7 text-sm text-gray-600">説明</label>
                            <textarea id="description" name="item[2][description]" rows="10" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">{{ old('description') }}</textarea>
                          </div>
                        </div>
                        <div class="p-2 w-1/2 mx-auto">
                          <div class="relative">
                            <label for="url" class="leading-7 text-sm text-gray-600">URL </span></label>
                            <input type="text" id="url" name="item[2][url]" value="{{ old('url') }}" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                          </div>
                        </div>
                        <div class="p-2 w-1/2 mx-auto">
                          <div class="relative">
                            <label for="src_url" class="leading-7 text-sm text-gray-600">src_url </label>
                            <input type="text" id="src_url" name="item[2][src_url]" value="{{ old('src_url') }}" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                          </div>
                        </div>

                        {{-- <div class="p-2 w-1/2 mx-auto">
                          <div class="relative">
                            <label for="category" class="leading-7 text-sm text-gray-600">カテゴリー</label> --}}
                            {{-- <select name="category" id="category" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                              @foreach($categories as $category)
                                <optgroup label="{{ $category->name }}">
                                @foreach($category->secondary as $secondary)
                                  <option value="{{ $secondary->id}}" >
                                    {{ $secondary->name }}
                                  </option>
                                @endforeach
                              @endforeach
                            </select> --}}
                            
                          {{-- </div>
                        </div> --}}

                        {{-- <div class="p-2 w-1/2 mx-auto">
                          <div class="relative">
                            <label for="category" class="leading-7 text-sm text-gray-600">商品画像</label> --}}
                            {{-- <x-select-image :images="$images" name="image1" />
                            <x-select-image :images="$images" name="image2" />
                            <x-select-image :images="$images" name="image3" />
                            <x-select-image :images="$images" name="image4" />
                            <x-select-image :images="$images" name="image5" /> --}}

                            {{-- <div class="p-2 w-1/2 mx-auto">
                              <div class="relative flex justify-around">
                                <div><input type="radio" name="is_selling" value="1" class="mr-2" checked>販売中</div>
                                <div><input type="radio" name="is_selling" value="0" class="mr-2" >停止中</div>
                              </div>
                            </div> --}}
                            
                            <div class="p-2 w-full flex justify-around mt-4">
                              <button type="button" onclick="location.href='{{ route('mypage.index')}}'" class="bg-gray-200 border-0 py-2 px-8 focus:outline-none hover:bg-gray-400 rounded text-lg">戻る</button>
                              <button type="submit" class="text-white bg-green-500 border-0 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-lg">登録する</button>                        
                            </div>
                          {{-- </div> --}}
                        {{-- </div> --}}
                      </div>
                    </div>
                  </form> 
              </div>
          </div>
      </div>
  </div>

  <script>
    console.log("hello");
    const portfolio = document.getElementsByClassName('portfolio');
    console.log(portfolio);

    Array.prototype.forEach.call(portfolio, function(elem) {
      elem.addEventListener('click', function(e) {
        const number = this.dataset.num;
        this.classList.toggle('bg-blue-500');


        const form1 = document.getElementById('1');
        const form2 = document.getElementById('2');
        const form3 = document.getElementById('3');
        if (number == 1) {
          form1.classList.remove('hidden');
          if(form2.classList.contains('hidden') == false) {
            form2.classList.toggle('hidden');
          }
          if(form3.classList.contains('hidden') == false) {
            form3.classList.toggle('hidden');
          }
        } else if (number == 2) {
          form2.classList.remove('hidden');
          if(form1.classList.contains('hidden') == false) {
            form1.classList.toggle('hidden');
          }
          if(form3.classList.contains('hidden') == false) {
            form3.classList.toggle('hidden');
          }
        } else if (number == 3) {
          form3.classList.remove('hidden');
          if(form2.classList.contains('hidden') == false) {
            form2.classList.toggle('hidden');
          }
          if(form1.classList.contains('hidden') == false) {
            form1.classList.toggle('hidden');
          }
        }
      });
    });
    

  </script>

</x-app-layout>