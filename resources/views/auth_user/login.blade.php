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

    <!-- Styles -->
    <link href="{{ mix('static/css/app.css') }}" rel="stylesheet">
</head>
<body style="background-color: #f5f5f5">
<div class="p-3" style="min-height:500px;max-width: 450px;margin: 130px auto;background-color: #ffffff">
    <div class="row justify-content-center">
        <form method="POST" action="{{ route('auth_user.store') }}">
            @csrf
            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label">账号：</label>
                <div class="col-sm-10">
                    <input type="text" name="username" class="form-control">
                    @error('username')
                    <div class="alert alert-danger m-0 p-0"><i class="bi bi-exclamation-circle me-1" style="font-size: .875em;"></i><small>{{ $message }}</small></div>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputPassword3" class="col-sm-2 col-form-label">密码：</label>
                <div class="col-sm-10">
                    <input type="password" name="password" class="form-control">
                    @error('password')
                    <div class="alert alert-danger m-0 p-0"><i class="bi bi-exclamation-circle me-1" style="font-size: .875em;"></i><small>{{ $message }}</small></div>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-12">
                    <button type="submit" class="btn btn-primary text-white w-100">登录</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Scripts -->
<script src="{{ mix('static/js/app.js') }}"></script>
</body>
</html>

