<div class="header" style="">
    <div class="container">
        <el-row>
            <el-col :span="20">
                <div class="logo" style="">
                    <a class="logo-img" href="/" style="">
                        <img src="/images/logo1.png" alt="">
                    </a>
                </div>
                <span class="title" style=""><h2>我的购物车</h2></span>
                <p class="description" style="">温馨提示：产品是否购买成功，以最终下单为准哦，请尽快结算</p>
            </el-col>
            <el-col :span="4">
                <el-dropdown>
                    <span> <a href="" style="color:#757575">25401514515</a><i class="el-icon-arrow-down el-icon--right"></i></span>
                    <el-dropdown-menu slot="dropdown">
                        <el-dropdown-item>个人中心</el-dropdown-item>
                        <el-dropdown-item>晒单评价</el-dropdown-item>
                        <el-dropdown-item>我的喜欢</el-dropdown-item>
                        <el-dropdown-item>小米账户</el-dropdown-item>
                        <el-dropdown-item>退出登录</el-dropdown-item>
                    </el-dropdown-menu>
                </el-dropdown>
                <el-divider direction="vertical"></el-divider>
                <el-link type="info"  :underline="false" style="color:#757575" href="/users/{{auth()->id()}}/personal/orderList">我的订单</el-link>
            </el-col>
        </el-row>
    </div>
</div>
