<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Laravel Shop') - 注册</title>
    <!-- 样式 -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app" class="{{ route_class() }}-page">
    <div class="warpper" style="width:100%;min-height: 100%;height:auto;">
        <div class="warp">
            <div class="layout">
                <div class="container" >
                    <div class="logo-area">
                        <img src="/images/register.png" alt="">
                    </div>
                    <div class="title">
                        <h1 style="text-align: center;">注册账号</h1>
                    </div>
                    <register-form-component></register-form-component>
                    <div class="agreement">
                        <a href="">已阅读并同意：小米 用户协议和 隐私政策</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- JS 脚本 -->
<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
