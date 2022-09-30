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
<div class="container mt-3 p-3" style="min-height: 30px;background-color: #ffffff">
    <x-forms.input type="error"/>
</div>

<!-- Scripts -->
<script src="{{ mix('static/js/app.js') }}"></script>
</body>
</html>
