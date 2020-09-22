<div class="header">
    <div class="site-topbar">
        <div class="container">
           <el-row >
              <el-col :span="16">
                  <a href="/">小米商城</a>
                  <el-divider direction="vertical"></el-divider>
                  <a href="#">MIUI</a>
                  <el-divider direction="vertical"></el-divider>
                  <a href="#">loT</a>
                  <el-divider direction="vertical"></el-divider>
                  <a href="#">云服务</a>
                  <el-divider direction="vertical"></el-divider>
                  <a href="#">金融</a>
                  <el-divider direction="vertical"></el-divider>
                  <a href="#">有品</a>
                  <el-divider direction="vertical"></el-divider>
                  <a href="#">小米开放平台</a>
                  <el-divider direction="vertical"></el-divider>
                  <a href="#">企业团购</a>
                  <el-divider direction="vertical"></el-divider>
                  <a href="#">资质证照</a>
                  <el-divider direction="vertical"></el-divider>
                  <a href="#">协议规则</a>
                  <el-divider direction="vertical"></el-divider>
                  <a href="#">下载App</a>
                  <el-divider direction="vertical"></el-divider>
                  <a href="#">Select Location</a>
              </el-col>
              <el-col :span="5">
                  @if($is_login)
                      <span class="user fl">
                        <a href="" class="user-name">2420557925 <i class="el-icon-arrow-down"></i></a>
                        <div class="user-dropdown">
                            <ul class="user-menu">
                                <li><a href="/users/{{$user->id}}/personal/address">个人中心</a></li>
                                <li><a href="#">晒单评价</a></li>
                                <li><a href="#">我的喜欢</a></li>
                                <li><a href="#">小米帐户</a></li>
                                <li>
                                    <form action="/logout" method="post" id="logout">
                                        @csrf
                                        <a href="javascript:;" onclick="document:logout.submit();">退出登录</a>
                                    </form>

                                </li>
                            </ul>
                        </div>
                      </span>
                      <span class="step fl">|</span>
                      <a href="#" class="message fl">消息通知</a>
                      <span class="step fl">|</span>
                      <a href="/users/{{$user->id}}/personal/orderList" class="order fl">我的订单</a>
                  @else
                      <a href="/register" class="fr register">注册</a>
                      <span class="step fr">|</span>
                      <a href="/login" class="fr login">登录</a>
                  @endif
                  <div style="clear: both"></div>
              </el-col>
              <el-col :span="3">
                 <header-cart-component carts="{{$carts}}" is_login="{{$is_login}}"></header-cart-component>
              </el-col>
           </el-row>
        </div>
    </div>
    <div class="site-header">
        <div class="container">
            <div class="header-logo fl">
                <a class="logo-img" href="/">
                    <img src="/images/logo1.png" alt="">
                </a>
            </div>
            <div class="header-nav fl">
                <ul class="nav-list" style="width:800px;">
                    <categories-component route_class="{{$route_class}}" categories="{{$categories}}"></categories-component>
                    <li class="nav-item"><a class="link" href="#"><span>小米手机</span></a></li>
                    <li class="nav-item"><a class="link" href="#"><span>Redmi 红米</span></a></li>
                    <li class="nav-item"><a class="link" href="#"><span>电视</span></a></li>
                    <li class="nav-item"><a class="link" href="#"><span>笔记本</span></a></li>
                    <li class="nav-item"><a class="link" href="#"><span>家电</span></a></li>
                    <li class="nav-item"><a class="link" href="#"><span>路由器</span></a></li>
                    <li class="nav-item"><a class="link" href="#"><span>智能硬件</span></a></li>
                    <li class="nav-item"><a class="link" href="#"><span>服务</span></a></li>
                    <li class="nav-item"><a class="link" href="#"><span>社区</span></a></li>
                </ul>
            </div>
            <div class="header-search">
                   <header-search-component></header-search-component>
            </div>
            <div style="clear: both"></div>
        </div>
    </div>
</div>
