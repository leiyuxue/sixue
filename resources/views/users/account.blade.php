<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Laravel Shop') - {{$type==='security'?'账号安全':''}}{{$type=='profile'?'个人中心':''}}{{$type=='sns'?'绑定授权':''}}
        {{$type=='services'?'小米服务':''}}{{$type=='device'?'设备管理':''}}</title>
    <!-- 样式 -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app" class="{{ route_class() }}-page">
    <div class="account" style="background: #f9f9f9;color:#666;">
        <div class="container" style="width:960px;margin:0 auto;padding:0;">
            <div class="account-hd" style="position:relative;z-index:4">
                <div class="logo-area" style="padding:50px 0;">
                    <div class="fl" style="height:31px; line-height: 31px;float:left;">
                        <img src="/images/account-logo.png" class="account-logo" alt="" style="vertical-align: middle"><span class="title" style="color:#ff6700;font-size: 18px;font-weight: bold;padding-left: 10px;">小米账号</span>
                    </div>
                    <a class="fr logout-btn" style="float:right;">退出</a>
                    <div style="clear: both"></div>
                </div>
                <div class="account-name-avatar" style="position:absolute;top:114px;right:36px;z-index:4">
                    <div class="account-name fl" style="width:120px;text-align: right;padding-top:16px;margin-right: 10px;">
                        <p class="name" style="color:#999;font-weight:normal;font-size: 14px;line-height: 1.5">请设置名字</p>
                        <p class="num" style="position: relative;font-size: 14px;color:#666;line-height: 1.2;z-index:10">2455448484</p>
                    </div>
                    <div class="account-avatar fl" style="width: 80px;height: 80px;border: 2px solid #e3e3e3; border-radius: 50%; padding: 4px;background: #fff; position: relative; z-index: 4;">
                        <div class="avatar-img" style="width: 100%;height: 100%; border-radius: 50%;overflow: hidden;background:url('/images/account-avatar-bg.png')"></div>
                    </div>
                </div>
            </div>
            <div class="main">
                <account-component type="{{$type}}"></account-component>
            </div>
        </div>
    </div>
</div>
<!-- JS 脚本 -->
<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
