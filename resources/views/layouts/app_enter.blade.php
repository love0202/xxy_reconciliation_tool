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
<div class="yxx_admin d-flex align-items-stretch">
    <div class="yxx_nav">
        <div class="logo mb-5">
            <img src="{{ yxx_path_static('logo.png') }}" alt="logo" style="max-width: 44px;">
        </div>
        <ul class="nav flex-column nav-pills">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{ route('project.enter') }}">
                    <span><i class="bi bi-laptop fs-3"></i></span><br>
                    <span>统计看板</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('project.enter') }}">
                    <span><i class="bi bi-laptop fs-3"></i></span><br>
                    <span>快递对账单</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('project.enter') }}">
                    <span><i class="bi bi-laptop fs-3"></i></span><br>
                    <span>商户数据源</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('project.enter') }}">
                    <span><i class="bi bi-laptop fs-3"></i></span><br>
                    <span>重量数据源</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="yxx_sub_nav">
        <h2 class="title fs-3 ps-5 pt-5">对账</h2>
    </div>
    <div class="yxx_math">
        <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #E6EFFF">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarScroll">
                    <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll"
                        style="--bs-scroll-height: 100px;">
                    </ul>
                    @auth
                        <div class="d-flex">
                            <div class="btn-group">
                                <button type="button" class="btn btn-secondary dropdown-toggle"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-person-circle me-1"></i>{{ Auth::user()->name }}
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <button class="dropdown-item" type="button">管理中心</button>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('auth_user.logout') }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            退出登录
                                        </a>
                                        <form id="logout-form" action="{{ route('auth_user.logout') }}"
                                              method="POST" class="d-none">
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
        <div class="mt-3 p-3" style="min-height: 400px;background-color: #ffffff;">
            @yield('content')
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="{{ mix('static/js/app.js') }}"></script>
@yield('script')
</body>
</html>
