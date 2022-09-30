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
            <span href="" class="navbar-brand"
               rel="{{ config('app.name', 'Laravel') }}">
                <img src="{{ yxx_path_static('logo.png') }}" alt="logo" width="30" height="30">
            </span>
            @auth
                <div class="d-flex">
                    <div class="btn-group">
                        <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown"
                                aria-expanded="false">
                            <i class="bi bi-person-circle me-1"></i>{{ Auth::user()->name }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="{{ route('auth.admin.logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    退出登录
                                </a>
                                <form id="logout-form" action="{{ route('auth.admin.logout') }}" method="POST"
                                      class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
        @endauth
    </nav>
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color:#3f59ba">
        <div class="container-fluid">
            <button class="navbar-toggler m-auto" type="button" data-bs-toggle="collapse" data-bs-target="#yxx-navbar-scroll"
                    aria-controls="yxx-navbar-scroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="yxx-navbar-scroll">
                <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('dashboard.index') }}">首页</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('project.index') }}">对账方案</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('project.index') }}">商户数据源</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('project.index') }}">快递数据源</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('project.index') }}">重量数据源</a>
                    </li>
                </ul>
                <div class="d-flex">
                    <div class="btn-group">
                        <button type="button" class="btn btn-warning">
                            <span class="me-2">切换对账方案</span><i class="bi bi-arrow-left-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>
<div class="container mt-3 p-3" style="min-height: 400px;background-color: #ffffff">
    @yield('content')
</div>

<!-- Scripts -->
<script src="{{ mix('static/js/app.js') }}"></script>
@yield('script')
</body>
</html>
