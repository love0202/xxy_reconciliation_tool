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
<style>
    #yxx-left-menu .list-unstyled .active {
        color: #ffffff;
        background-color: #8ca7e0;
    }
</style>
<body style="background-color: #dfdfdf">
<div class="d-flex mt-3">
    @yield('content')
</div>

<!-- Scripts -->
<script src="{{ mix('static/js/app.js') }}"></script>
@yield('script')
</body>
</html>
