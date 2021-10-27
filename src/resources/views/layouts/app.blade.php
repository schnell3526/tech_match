<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<!-- 非ログインユーザ・ログインユーザ共通レイアウト -->

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- タブに表示される名前 -->
  <title>Tech Match</title>

  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

  <!-- Styles -->
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
   
  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>
</head>

<body class="font-sans antialiased">
  <div class="min-h-screen bg-gray-100">
    <!-- ヘッダー -->
    <header class="bg-white shadow">
      <div class="max-w-7xl mx-auto py-0 px-0 sm:px-6 lg:px-8">
        @include('user-navigation')
      </div>
    </header>
    <!-- Page Content -->
    <main>
      {{ $slot }}
    </main>
  </div>


</body>

</html>