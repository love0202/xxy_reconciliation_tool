<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'yxxtool') }}</title>

    <!-- Favicons -->
    <link rel="icon" href="{{ yxx_path_static('logo.ico') }}">

    <!-- Styles -->
    <link href="{{ mix('static/css/app.css') }}" rel="stylesheet">
</head>
<body style="background-color: #f5f5f5">
<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a href="{{ url('/') }}" class="navbar-brand"
               rel="{{ config('app.name', 'Laravel') }}">
                <img src="{{ yxx_path_static('logo.png') }}" alt="mdo" width="32" height="32">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll"
                    aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/">首页</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/">对账方案</a>
                    </li>
                </ul>
                @auth
                    <div class="d-flex">
                        <div class="btn-group">
                            <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person-circle me-1"></i>{{ Auth::user()->name }}
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><button class="dropdown-item" type="button">管理中心</button></li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('auth_user.logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        退出登录
                                    </a>
                                    <form id="logout-form" action="{{ route('auth_user.logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
    </nav>
</header>
<div style="min-height: 100px;background-color: #E6EFFF">
    <div class="container">
        <div class="d-flex justify-content-between">
            <div class="p-2">
            </div>
            <div class="p-2">
                <a href="/" class="btn btn-primary text-light">
                    <i class="bi bi-plus-circle-dotted me-1"></i>创建对账方案
                </a>
            </div>
        </div>
    </div>
</div>
<div class="container mt-3 p-3" style="min-height: 400px;background-color: #ffffff">
    @yield('content')
</div>

<!-- Scripts -->
<script src="{{ mix('static/js/app.js') }}"></script>
@yield('script')
</body>
</html>
