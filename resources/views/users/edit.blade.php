<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Laravel Shop') - 账号安全</title>
    <!-- 样式 -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app" class="{{ route_class() }}-page">
    <div class="login-header">
        <div class="container">
            <div class="login-logo">
                <a href="" class="logo-link">
                    <img src="/images/login-logo.png" alt="">
                </a>
            </div>
        </div>
    </div>
    <div class="login-bg">
        <div class="bg-box">
            <login-form-component></login-form-component>
        </div>
    </div>
</div>
<!-- JS 脚本 -->
<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
