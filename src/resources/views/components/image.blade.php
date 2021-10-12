@php
    if($type ==="portfolio") {
      $path = 'storage/portfolio'/;
    }

    if($type === "icon") {
      $path = "storage/icon/"
    }
@endphp

<div>
  @if(empty($filename) && $type === "portfolio")
      <img src="{{asset('image/no_image_portfolio.jpg')}}" alt="">
  @else
      <img src="{{asset($path.$filename)}}" alt="">
  @endif

  @if(empty($filename) && $type === "icon")
      <img src="{{asset('image/no_image_icon.jpg')}}" alt="">
  @else
      <img src="{{asset($path.$filename)}}" alt="">
  @endif
</div>