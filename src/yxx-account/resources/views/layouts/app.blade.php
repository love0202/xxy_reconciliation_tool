<?php

use App\Common\WebProject;

$webProject = WebProject::getProject();

?>
        <!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ yxx_get_title() }}【{{ config('app.name', 'yxxtool') }}】</title>

    <!-- Favicons -->
    <link rel="icon" href="{{ yxx_path_static('logo.ico') }}">

    <!-- Styles -->
    <link href="{{ mix('static/css/app.css') }}" rel="stylesheet">
</head>
<style>
    #yxx-left-menu .list-unstyled .active {
        color: #ffffff;
        background-color: #8ca7e0;
    }
</style>
<body style="background-color: #dfdfdf">
{{-- 主菜单 --}}
@include('layouts._header')
<div class="d-flex mt-1">
    {{-- 左侧菜单 --}}
    <div id="yxx-left-menu" class="flex-shrink-0" style="background-color: #dbe5fa;">
        <ul class="list-unstyled">
            @foreach(yxx_get_left_menu() as $menu)
                <li class="text-center" style="width: 100px;border:1px solid #8d8484">
                    <a class="nav-link @if(isset($menu['active'])) active @endif "
                       href="{{ route($menu['routeName']) }}">
                        <div class="d-flex flex-column">
                            <i class="{{ $menu['class'] }} fs-3"></i>
                            <span>{{ $menu['name'] }}</span>
                        </div>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="flex-grow-1 table-responsive">
        {{-- 面包屑 --}}
        @if(yxx_get_breadcrumb())
        <div class="d-flex justify-content-between ms-2 pl-2 px-2" style="background-color: #dbe5fa">
            <nav aria-label="breadcrumb" class="p-2">
                <ol class="breadcrumb" style="--bs-breadcrumb-margin-bottom: 0rem;">
                    @foreach(yxx_get_breadcrumb() as $menu)
                        <li class="breadcrumb-item">
                            <a href="{{ route($menu['routeName']) }}">{{ $menu['name'] }}</a>
                        </li>
                    @endforeach
                </ol>
            </nav>
            <div class="p-2">
                @if(yxx_back_url())
                    <a href="{{ yxx_back_url() }}" class="btn btn-outline-primary btn-sm">返回</a>
                @endif
            </div>
        </div>
        @endif
        {{-- 内容区 --}}
        <div class="bg-white ms-2 p-2" style="min-height: 400px;">
            @yield('content')
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="{{ mix('static/js/app.js') }}"></script>
@yield('script')
</body>
</html>
