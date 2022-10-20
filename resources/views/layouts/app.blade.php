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

    <title>{{ get_yxx_title() }}【{{ config('app.name', 'yxxtool') }}】</title>

    <!-- Favicons -->
    <link rel="icon" href="{{ yxx_path_static('logo.ico') }}">

    <!-- Styles -->
    <link href="{{ mix('static/css/app.css') }}" rel="stylesheet">
</head>
<body style="background-color: #dfdfdf">
@include('layouts._header')
<div class="d-flex mt-3">
    <div class="flex-shrink-0 bg-white">
        <ul class="list-unstyled">
            @foreach(get_yxx_left_menu() as $menu)
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
    <div class="flex-grow-1 bg-white ms-3 p-3 table-responsive" style="min-height: 400px;">
            @yield('content')
    </div>
</div>

<!-- Scripts -->
<script src="{{ mix('static/js/app.js') }}"></script>
@yield('script')
</body>
</html>
