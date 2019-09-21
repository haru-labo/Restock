<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
</head>
<body>
    <header>
        <div class="container">
            <!-- flash message -->
            @if (session('flash_message'))
            <div class="flash_message bg-success text-center text-white py-2 my-0">
                {{ session('flash_message') }}
            </div>
            @endif
            <h1><a href="/">@yield('title')</a></h1>
        </div>
    </header>
    @yield('content')
</body>
</html>
