<x-app-layout>
<section class="text-gray-600 body-font">
  <div class="container px-5 py-24 mx-auto">
    <div class="flex flex-col text-center w-full mb-20">
      <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">{{ $product->title }}</h1>
      <p class="lg:w-2/3 mx-auto leading-relaxed text-base">{{ $product->description }}</p>
      <div>製作者: <a href="{{ route('userpage.index', ['id' => $user->id]) }}">{{ $user->nickname }}</a></div>
    </div>
    <div style="text-align:center;">
      <a href="{{ $product->product_url }}" style="color:red;">製作物のページはこちら</a>
      <div><br></div>
      <a href="{{ $product->src_url }}" style="color:red;">製作物のソースコードはこちら</a>
      <div><br></div>
    </div>
    @if($images)
    <div class="flex flex-wrap -m-4">
      @foreach($images as $image)
      <div class="lg:w-1/2 sm:w-1/2 p-4">
        
          <img alt="gallery" src="{{ asset('image' . $image->image_path) }}">
          
        
      </div>
      @endforeach
    </div>
    @endif
  </div>
</section>
</x-app-layout>