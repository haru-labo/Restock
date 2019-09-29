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
    <link href="{{ asset('css/font.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
</head>
<body>
    <header>
        <div id="app" class="container mb-2">
            <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #F77F00;">
                <a class="navbar-brand mb-0 h1" href={{ route('item.index') }}>@yield('title')</a>
                @if (Auth::check())
                {{-- <ul class="navbar-nav mr-auto">
                    <li class="navbar-item">
                        <span class="navbar-text">{{ $user->name }}さんのRestockList</span>
                    </li>
                </ul> --}}
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="btn btn-outline-light" href="#">ログアウト</a>
                    </li>
                </ul>
                @endif
            </nav>
            {{-- error message --}}
            @if (count($errors) > 0)
            <div>
                <ul class="list-group">
                @foreach ($errors->all() as $error)
                    <li class="list-group-item list-group-item-warning font-weight-bold">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <!-- flash message -->
            @if (session('flash_message'))
            <div class="flash_message bg-success text-center text-white py-2 my-0">
                {{ session('flash_message') }}
            </div>
            @endif
        </div>
    </header>
    @yield('content')
</body>
</html>
