<style lang="scss" scoped>
    .personal-com{
        padding-top:10px;
        padding-bottom: 10px;
        .menu {
            padding: 20px;
            background: #fff;
            .menu-list {
                padding-left:40px;
                margin:20px 0;
                .title {
                    font-size: 16px;
                    color: #333;
                    margin: 10px 0;
                }
                .menu-item {
                    margin: 10px 0;
                    .item-link{
                        color: #757575;
                        margin: 5px 0;
                        font-size: 14px;
                    }
                    .item-link:hover{
                        color:#333;
                    }
                }
            }

        }
    }
    .active{
        color:#ff6700!important;
    }
    ::v-deep .el-breadcrumb{
        padding:10px 0 20px 0;
    }


</style>
<template>
    <div class="personal-com container">
<!--       面包屑-->
        <el-breadcrumb separator-class="el-icon-arrow-right">
            <el-breadcrumb-item :to="{ path: '/' }">首页</el-breadcrumb-item>
            <el-breadcrumb-item>个人中心</el-breadcrumb-item>
        </el-breadcrumb>
        <el-row :gutter="10">
            <el-col :span="5">
                <div class="menu" >
                    <dl class="menu-list order-person">
                        <dt class="title">订单中心</dt>
                        <dd class="menu-item order"><a :href="'/users/'+id+'/personal/orderList'" class="item-link" :class="[type==='orderList'?'active':'']">我的订单</a></dd>
                        <dd class="menu-item comment"><a href="javascript:;" class="item-link" :class="[type==='sns'?'active':'']">晒单评价</a></dd>
                        <dd class="menu-item cost"><a href="javascript:;" class="item-link" :class="[type==='sns'?'active':'']">话费充值订单</a></dd>
                        <dd class="menu-item"><a href="javascript:;" class="item-link" :class="[type==='sns'?'active':'']">以旧换新订单</a></dd>
                    </dl>
                    <dl class="menu-list profile-person">
                        <dt class="title">个人中心</dt>
                        <dd class="menu-item person"><a :href="'/users/'+id+'/personal/portal'" class="item-link" :class="[type==='portal'?'active':'']">我的个人中心</a></dd>
                        <dd class="menu-item message"><a href="javascript:;" class="item-link" :class="[type==='sns'?'active':'']">消息通知</a></dd>
                        <dd class="menu-item post"><a href="javascript:;" class="item-link" :class="[type==='sns'?'active':'']">购买资格</a></dd>
                        <dd class="menu-item account"><a href="javascript:;" class="item-link" :class="[type==='sns'?'active':'']">现金帐户</a></dd>
                        <dd class="menu-item gift-card"><a href="javascript:;" class="item-link" :class="[type==='sns'?'active':'']">小米礼品卡</a></dd>
                        <dd class="menu-item ncoupon"><a href="javascript:;" class="item-link" :class="[type==='sns'?'active':'']">现金卷</a></dd>
                        <dd class="menu-item favorite"><a :href="'/users/'+id+'/personal/favorite'" class="item-link" :class="[type==='favorite'?'active':'']">我的喜欢</a></dd>
                        <dd class="menu-item address"><a :href="'/users/'+id+'/personal/address'" class="item-link" :class="[type==='address'?'active':'']">收货地址</a></dd>
                        <dd class="menu-item money"><a href="javascript:;" class="item-link" :class="[type==='sns'?'active':'']">红包</a></dd>
                    </dl>
                    <dl class="menu-list post-service">
                        <dt class="title">售后服务</dt>
                        <dd class="menu-item service-mark"><a href="javascript:;" class="item-link" :class="[type==='sns'?'active':'']">服务记录</a></dd>
                        <dd class="menu-item ask-service"><a href="javascript:;" class="item-link" :class="[type==='sns'?'active':'']">申请服务</a></dd>
                    </dl>
                    <dl class="menu-list account-person">
                        <dt class="title">帐户管理</dt>
                        <dd class="menu-item user-info"><a href="javascript:;" class="item-link" :class="[type==='sns'?'active':'']">个人信息</a></dd>
                        <dd class="menu-item eidt-password"><a href="javascript:;" class="item-link" :class="[type==='sns'?'active':'']">修改密码</a></dd>
                    </dl>
                </div>
            </el-col>
            <el-col :span="19">
                <div class="body" >
                    <user-order-list-component @funreceived="confirmReceived" v-if="type==='orderList'" :type="type" :user="user"></user-order-list-component>
                    <user-portal-component  v-if="type==='portal'" :type="type" :user="user"></user-portal-component>
                    <user-address-component v-if="type==='address'" :type="type" :user="user"></user-address-component>
                    <user-favorite-component v-if="type==='favorite'" :type="type" :user="user"></user-favorite-component>
                    <user-order-detail-component @funreceived="confirmReceived" v-if="type==='orderDetail'" :type="type" :user="user"></user-order-detail-component>
                </div>
            </el-col>
        </el-row>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                id:JSON.parse(this.user).id,
            }
        },
        props:['type','user'],
        methods:{
            // 确认收货
            confirmReceived(id){
                axios.post('/orders/'+id+'/confirmReceived');
            },
            // 评论
            review(id){
                axios.post('/orders/'+id+'/review').then(function(res){
                    console.log(res);
                },function(err){
                    console.log(err.response);
                });
            },
            // 申请退款
            refund(id){
                axios.post('/orders/'+id+'/refund').then(function(res){
                    console.log(res);
                },function(err){
                    console.log(err.response);
                });
            },
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
