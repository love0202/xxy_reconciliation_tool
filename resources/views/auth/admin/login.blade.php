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
<div class="shadow p-3"
     style="min-height:500px;max-width: 450px;margin: 130px auto;background-color: #ffffff;border-radius: 8px;">
    <div class="text-center p-3" style="height: 150px;">
        <img src="{{ yxx_path_static('logo.png') }}" alt="logo" style="max-width: 80px;">
    </div>
    <div class="row justify-content-center">
        <form method="POST" action="{{ route('auth.admin.store') }}">
            @csrf
            <div class="row">
                <div class="col-12 mb-3">
                    <input type="text" name="username" class="form-control" placeholder="用户名" maxlength="20">
                    @error('username')
                    <div class="alert alert-danger m-0 p-0"><i class="bi bi-exclamation-circle me-1"
                                                               style="font-size: .875em;"></i>
                        <small>{{ $message }}</small>
                    </div>
                    @enderror
                </div>
                <div class="col-12 mb-3">
                    <input type="password" name="password" class="form-control" placeholder="密码" maxlength="20">
                    @error('password')
                    <div class="alert alert-danger m-0 p-0"><i class="bi bi-exclamation-circle me-1"
                                                               style="font-size: .875em;"></i>
                        <small>{{ $message }}</small>
                    </div>
                    @enderror
                </div>
                <div class="col-12 mb-3">
                    <div class="input-group">
                        <input type="text" name="captcha" class="form-control" placeholder="请输入验证码" maxlength="5">
                        <img class="input-group-text p-0 ms-2" id="yxx-captcha" src="{{captcha_src()}}" alt="换一个"
                             style="height: 37px;width: 120px;" onclick="this.src='/captcha/default?'+Math.random()">
                    </div>
                    @error('captcha')
                    <div class="alert alert-danger m-0 p-0"><i class="bi bi-exclamation-circle me-1"
                                                               style="font-size: .875em;"></i>
                        <small>{{ $message }}</small>
                    </div>
                    @enderror
                </div>
                <div class="col-sm-12 mb-3">
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

