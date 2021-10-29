<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Dashboard') }}
      </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:p-6 lg:p-8">
          <div class="flex p-2">
            @for($i = 0; $i < $num; $i++) 
            <button class="portfolio flex-auto m-1 py-2 bg-blue-400 text-white font-semibold rounded bg-blue-500" data-num={{$i+1}}>ポートフォリオ<?php echo $i+1;?></button>
            @endfor

          </div>
    </div>
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            
              <div class="p-6 bg-white border-b border-gray-200">
                <x-auth-validation-errors class="mb-4" :errors="$errors" /> 
                <form method="post" action="{{ route('portfolio.update', $user_id)}}" enctype="multipart/form-data" >
                    @csrf
                    {{--・・・・・・・・・・・・・ ポートフォリオ１のボタンクリック時に表示するフォーム・・・・・・・・・・・・・ --}}


                    {{--・・・・・・・・・・・・・ ポートフォリオ2のボタンクリック時に表示するフォーム・・・・・・・・・・・・・ --}}
                    @for($i = 0; $i < $num; $i++) 
                                          <div class="nohidden" id="{{$i}}">
                      <h1>portfolio<?php echo $i+1;?></h1>
                      <div class="-m-2">
                        <div class="p-2 w-1/2 mx-auto">
                          <div class="relative">

                            <label for="title" class="leading-7 text-sm text-gray-600">タイトル　<span class="text-red-600">※必須</span></label>
                            <input type="text" id="title" name="item[{{$i}}][title]" value="{{$portfolio[$i]->title}}" required class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">

                          </div>
                        </div>
                        <div class="p-2 w-1/2 mx-auto">
                          <div class="relative">
                            <label for="image" class="leading-7 text-sm text-gray-600">ポートフォリオ画像　<span class="text-red-600">※画像は最大３枚までにしてください</span></label>

                            <input type="file" id="image" name="item[{{$i}}][image][]" value="{{ old('image') }}" multiple class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                          </div>
                        </div> 
                        @foreach ($portfolio[$i]->product_images as $product_images)

                          <div class="p-2 w-1/2 mx-auto">
                            <div class="relative">
                              <img class=" object-cover"
                              src="{{ asset('storage/portfolio/'.$product_images->image_path)}}" alt="">

                            </div>
                          </div>

                        @endforeach
                        <div class="p-2 w-1/2 mx-auto">
                          <div class="relative">
                            {{-- <x-image  type="portfolio"/> --}}
                          </div>
                        </div> 
                        <div class="p-2 w-1/2 mx-auto">
                          <div class="relative">

                            <label for="description" class="leading-7 text-sm text-gray-600">説明　<span class="text-red-600">※必須</span></label>
                            <textarea id="description" name="item[{{$i}}][description]" rows="10"  required class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">{{$portfolio[$i]->description}}</textarea>

                          </div>
                        </div>
                        <div class="p-2 w-1/2 mx-auto">
                          <div class="relative">
                            <label for="url" class="leading-7 text-sm text-gray-600">URL 　<span class="text-red-600">※必須</span></label>
                            <input type="text" id="url" name="item[{{$i}}][url]" value="{{$portfolio[$i]->product_url}}" required class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                          </div>
                        </div>
                        <div class="p-2 w-1/2 mx-auto">
                          <div class="relative">
                            <label for="src_url" class="leading-7 text-sm text-gray-600">src_url 　<span class="text-red-600">※必須</span></label>
                            <input type="text" id="src_url" name="item[{{$i}}][src_url]" value="{{$portfolio[$i]->src_url}}" required class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
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
                              <button type="submit" class="text-white bg-green-500 border-0 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-lg">更新する</button>                        
                            </div>
                          {{-- </div> --}}
                        {{-- </div> --}}
                      </div>
                    </div>
                    @endfor

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