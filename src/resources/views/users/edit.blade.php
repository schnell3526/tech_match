<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Dashboard') }}
      </h2>
  </x-slot>

  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            
              <div class="p-6 bg-white border-b border-gray-200">
                <x-auth-validation-errors class="mb-4" :errors="$errors" /> 
                <form method="post" action="{{ route('mypage.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="-m-2">
                      <div class="p-2 w-1/2 mx-auto">
                        <div class="relative">
                          <label for="nickname" class="leading-7 text-sm text-gray-600">ニックネーム　<span class="text-red-600">※必須</span></label>
                          <input type="text" id="nickname" name="nickname" value="{{ $mypage->nickname }}" required class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        </div>
                      </div>
                      <div class="p-2 w-1/2 mx-auto">
                        <div class="relative">
                          <label for="icon_image" class="leading-7 text-sm text-gray-600">アイコン画像<span class="text-red-600">※必須</span></label>
                          <input type="file" id="icon_image" name="icon_image" value="{{ $mypage->icon_image }}" required class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        </div>
                      </div>

                      <div class="w-1/2 mx-auto rounded">
                        <img class="img_round object-cover" src="{{ asset('storage/icon/'.$mypage->icon_image)}}" alt=""></div>


                      <div class="p-2 w-1/2 mx-auto">
                        <div class="relative">
                          <label for="age" class="leading-7 text-sm text-gray-600">年齢　<span class="text-red-600">※必須</span></label>
                          <input type="number" id="age" name="age" value="{{ $mypage->engineer->age }}" required class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                          <span class="text-sm">0〜99の範囲で入力してください</span>
                        </div>
                      </div>
                      <div class="p-2 w-1/2 mx-auto">
                        <label for="gender" class="leading-7 text-sm text-gray-600">性別</label>
                        <div class="relative flex justify-around">
                          <div><input type="radio" name="gender" value="1" class="mr-2" checked>男性</div>
                          <div><input type="radio" name="gender" value="2" class="mr-2" >女性</div>
                        </div>
                      </div>  
                      <div class="p-2 w-1/2 mx-auto">
                        <div class="relative">
                          <label for="introduction" class="leading-7 text-sm text-gray-600">自己紹介　<span class="text-red-600">※必須</span></label>
                          <textarea id="introduction" name="introduction" rows="10" required class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">{{ $mypage->engineer->introduction }}</textarea>
                        </div>
                      </div>
                      <div class="p-2 w-1/2 mx-auto">
                        <div class="relative">
                          <label for="github_url" class="leading-7 text-sm text-gray-600">Github_URL 　<span class="text-red-600">※必須</span></label>
                          <input type="text" id="github_url" name="github_url" value="{{ $mypage->engineer->github_url }}" required class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        </div>
                      </div>
                      <div class="p-2 w-1/2 mx-auto">
                        <div class="relative">
                          <label for="facebook_url" class="leading-7 text-sm text-gray-600">Facebook_URL 　<span class="text-red-600">※必須</span></label>
                          <input type="text" id="facebook_url" name="facebook_url" value="{{ $mypage->engineer->facebook_url }}" required class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        </div>
                      </div>
                      <div class="p-2 w-1/2 mx-auto">
                        <div class="relative">
                          <label for="qita_url" class="leading-7 text-sm text-gray-600">Qita_URL 　<span class="text-red-600">※必須</span></label>
                          <input type="text" id="qita_url" name="qita_url" value="{{ $mypage->engineer->qiita_url }}" required class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        </div>
                      </div>
                      <div class="p-2 w-1/2 mx-auto">
                        <div class="relative">
                          <label for="job" class="leading-7 text-sm text-gray-600">職業　<span class="text-red-600">※必須</span></label>
                          <select name="job" id="job" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                            <option value="enginer">エンジニア</option>
                            {{-- @foreach ($shops as $shop )
                              <option value="{{ $shop->id}}" >
                                {{ $shop->name }}
                              </option>
                            @endforeach --}}
                          </select>
                        </div>
                      </div> 

                      <div class="p-2 w-1/2 mx-auto">
                        <div class="relative">
                          <label for="skill" class="leading-7 text-sm text-gray-600">スキル　<span class="text-red-600">※必須</span></label>
                          <select name="skill" id="skill" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                            <option value="php">PHP</option>
                            {{-- @foreach ($shops as $shop )
                              <option value="{{ $shop->id}}" >
                                {{ $shop->name }}
                              </option>
                            @endforeach --}}
                          </select>
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
                  </form> 
              </div>
          </div>
      </div>
  </div>
  {{-- <script>
    'use strict'
    const images = document.querySelectorAll('.image')
    
    images.forEach( image =>  {
      image.addEventListener('click', function(e){
        const imageName = e.target.dataset.id.substr(0, 6)
        const imageId = e.target.dataset.id.replace(imageName + '_', '')
        const imageFile = e.target.dataset.file
        const imagePath = e.target.dataset.path
        const modal = e.target.dataset.modal
        document.getElementById(imageName + '_thumbnail').src = imagePath + '/' + imageFile
        document.getElementById(imageName + '_hidden').value = imageId
        MicroModal.close(modal);
    }, )
    })  
  </script> --}}

</x-app-layout>

