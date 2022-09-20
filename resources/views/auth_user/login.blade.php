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
    <div style="width: 500px;margin: 130px auto">
        <div class="row justify-content-center">
            <form method="POST" action="{{ route('auth_user.login_store') }}">
                @csrf
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">账号：</label>
                    <div class="col-sm-10">
                        <input type="text" name="username" class="form-control">
                        @error('username')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">密码：</label>
                    <div class="col-sm-10">
                        <input type="text" name="password" class="form-control">
                        @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-primary w-100">登录</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
@yield('script')
</body>
</html>

