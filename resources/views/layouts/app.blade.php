<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Favicons -->
    <link rel="icon" href="{{ yxx_path_static('logo.ico') }}">

    <!-- Scripts -->
    <script src="{{ asset('static/js/app.js') }}"></script>

    <!-- Styles -->
    <link href="{{ asset('static/css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    @include('layouts._header')

    <main class="py-4">
        @yield('content')
    </main>
    @include('layouts._footer')
</div>
@yield('script')
</body>
</html>
