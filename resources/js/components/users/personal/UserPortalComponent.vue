<style lang="scss" scoped>
    .portal{
        padding:20px 48px;
        background:#fff;

        .top{
            padding-bottom:30px;
            border-bottom:1px solid #ccc;
            .avatar{
                .el-image{
                    width:150px;
                    height:150px;
                    padding:4px;
                    border:1px solid #e0e0e0;
                    border-radius:150px;
                }
            }
            .account{
                padding-top:40px;
            }
            .phone{
                padding-top:40px;
                p{
                    margin-bottom: 10px;
                }
            }
        }
        .bottom{
            margin:0px 30px;
            ul{
                list-style: none;
                display:block;
                li{
                    float:left;
                    width:50%;
                    margin: 50px 0px;
                    .title{
                        margin-top:30px;
                        span{
                            color:#ff6700;
                        }
                    }
                }
            }
        }
    }
</style>
<template>
    <div class="portal">
        <div class="top">
            <el-row>
                <el-col :span="5">
                    <div class="avatar">
                        <el-image :src="userData.avatar"></el-image>
                    </div>
                </el-col>
                <el-col :span="7">
                    <div class="account">
                        <div class="id">
                            {{userData.name}}
                        </div>
                        <div class="edit">
                            <el-link :href="'/user/'+userData.id+'/account'">修改个人信息 ></el-link>
                        </div>
                    </div>
                </el-col>
                <el-col :span="12">
                    <div class="phone">
                        <p>帐户安全：普通</p>
                        <p>绑定手机：{{userData.phone}}</p>
                        <p>绑定邮箱：{{userData.email?userData.email:'未绑定'}}</p>
                    </div>
                </el-col>
            </el-row>
        </div>
        <div class="bottom">
            <ul>
                <li>
                    <el-row>
                        <el-col :span="7">
                            <div class="img">
                                <el-image src="/images/portal-icon-1.png"></el-image>
                            </div>
                        </el-col>
                        <el-col :span="17">
                            <div class="title">
                                <p>待支付订单：<span>{{unpayOrder.length}}</span></p>
                                <p><el-link :href="'/users/'+userData.id+'/personal/orderList'">查看待支付订单 》</el-link></p>
                            </div>
                        </el-col>
                    </el-row>
                </li>
                <li>
                    <el-row>
                        <el-col :span="7">
                            <div class="img">
                                <el-image src="/images/portal-icon-2.png"></el-image>
                            </div>
                        </el-col>
                        <el-col :span="17">
                            <div class="title">
                                <p>待收货订单：<span>{{unreceivedOrder.length}}</span></p>
                                <p><el-link :href="'/users/'+userData.id+'/personal/orderList'">查看待收货订单 》</el-link></p>
                            </div>
                        </el-col>
                    </el-row>
                </li>
                <li>
                    <el-row>
                        <el-col :span="7">
                            <div class="img">
                                <el-image src="/images/portal-icon-3.png"></el-image>
                            </div>
                        </el-col>
                        <el-col :span="17">
                            <div class="title">
                                <p>待评价订单：<span>{{unreviewedOrder.length}}</span></p>
                                <p><el-link :href="'/users/'+userData.id+'/personal/orderList'">查看待评价订单 》</el-link></p>
                            </div>
                        </el-col>
                    </el-row>
                </li>
                <li>
                    <el-row>
                        <el-col :span="7">
                            <div class="img">
                                <el-image src="/images/portal-icon-4.png"></el-image>
                            </div>
                        </el-col>
                        <el-col :span="17">
                            <div class="title">
                                <p>喜欢的商品：<span>{{favoriteProducts.length}}</span></p>
                                <p><el-link :href="'/users/'+userData.id+'/personal/favorite'">查看喜欢的商品 》</el-link></p>
                            </div>
                        </el-col>
                    </el-row>
                </li>
                <div style="clear: both"></div>
            </ul>
        </div>
    </div>
</template>

<script>

    export default {
        data(){
            return {
                userData:JSON.parse(this.user),
            }
        },
        props:{
            type:String,
            user:String,
        },
        computed:{
            unpayOrder(){
                return this.userData.orders.filter((i)=>{
                    if(!i.pait_at){
                        return i;
                    }
                });
            },
            unreceivedOrder(){
                return this.userData.orders.filter((i)=>{
                    if(i.ship_status==='delivered'){
                        return i;
                    }
                });
            },
            unreviewedOrder(){
                return this.userData.orders.filter((i)=>{
                    if(!i.reviewed){
                        return i;
                    }
                });
            },
            favoriteProducts(){
                return this.userData.favorite_products;
            }
        },
        methods:{

        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
