<style lang="scss" scoped>
    .product-show-nav{
        height:63px;
        width:100%;
        line-height:63px;
        font-size:14px;
        border-top:1px solid #e0e0e0;
        border-bottom:1px solid #e0e0e0;
        box-shadow:0 5px 5px rgba(0,0,0,.07);
        background:#fff;
        .el-breadcrumb{
            height:63px;
            line-height:63px;
        }
    }
    .product-show-nav-hidden
    {
        position:fixed;
        top:-10px;
        margin-top:-60px;
        z-index:99;
        height:63px;
        width:100%;
        line-height:63px;
        font-size:14px;
        border-top:1px solid #e0e0e0;
        border-bottom:1px solid #e0e0e0;
        box-shadow:0 5px 5px rgba(0,0,0,.07);
        background:#fff;
        .el-breadcrumb{
            height:63px;
            line-height:63px;
        }
    }
    .nav-fix{
        top:0;
        margin-top:0;
    }
    .islogin{
        height:48px;
        line-height:48px;
        background:#f7f7f7;
        .islogin-box{
            text-align: center;
            font-size: 14px;
            .login-link{
                text-decoration: none;
                color:#ff6700;

            }
        }
    }
</style>
<template>
    <div class="product-show">
        <div class="product-show-nav">
            <div class="container">
                <el-row>
                    <el-col :span="16">
                        <el-breadcrumb separator="/">
                            <el-breadcrumb-item><a href="/">首页</a></el-breadcrumb-item>
                            <el-breadcrumb-item v-for="(v,k) in productData.category.parent_data" :key="k"><a :href="'/a/c/'+v.id">{{v.name}}</a></el-breadcrumb-item>
                            <el-breadcrumb-item><a :href="'/a/c/'+productData.category.id">{{productData.category.name}}</a></el-breadcrumb-item>
                            <el-breadcrumb-item>{{productData.title}}</el-breadcrumb-item>
                        </el-breadcrumb>
                    </el-col>
                    <el-col :span="8">
                        <a :href="'/products/summaries/'+productData.id" v-if="productData.summaries">概述</a>
                        <el-divider direction="vertical" v-if="productData.summaries"></el-divider>
                        <a :href="'/products/propties/'+productData.id" v-if="productData.propties.length>0">参数</a>
                        <el-divider direction="vertical" v-if="productData.propties.length>0"></el-divider>
                        <a href="">F码通道</a>
                        <el-divider direction="vertical"></el-divider>
                        <a href="">咨询客服</a>
                        <el-divider direction="vertical"></el-divider>

                        <a :href="'/comment/'+productData.id" >用户评价</a>
                        <el-button type="warning" size="mini" v-if="route_class!='products-show'"  @click="goBuy">立即购买</el-button>
                    </el-col>
                </el-row>
            </div>
        </div>
        <div class="product-show-nav-hidden" :class="scroll>140?'nav-fix':''" >
            <div class="container">
                <el-row>
                    <el-col :span="16">
                        <el-breadcrumb separator="/">
                            <el-breadcrumb-item><a href="/">首页</a></el-breadcrumb-item>
                            <el-breadcrumb-item v-for="(v,k) in productData.category.parent_data" :key="k"><a >{{v.name}}</a></el-breadcrumb-item>
                            <el-breadcrumb-item><a :href="'/a/c/'">{{productData.category.name}}</a></el-breadcrumb-item>
                            <el-breadcrumb-item>{{productData.title}}</el-breadcrumb-item>
                        </el-breadcrumb>
                    </el-col>
                    <el-col :span="8">
                        <a :href="'/products/summaries/'+productData.id" v-if="productData.summaries">概述</a>
                        <el-divider direction="vertical" v-if="productData.summaries"></el-divider>
                        <a :href="'/products/propties/'+productData.id" v-if="productData.propties.length>0">参数</a>
                        <el-divider direction="vertical" v-if="productData.propties.length>0"></el-divider>
                        <a href="">F码通道</a>
                        <el-divider direction="vertical"></el-divider>
                        <a href="">咨询客服</a>
                        <el-divider direction="vertical"></el-divider>

                        <a :href="'/comment/'+productData.id" >用户评价</a>
                        <el-button type="warning" size="mini" v-if="route_class!='products-show'" @click="goBuy">立即购买</el-button>
                    </el-col>
                </el-row>
            </div>
        </div>
        <div class="islogin" v-if="!user">
            <div class="container">
                <div class="islogin-box">
                    为了您方便购买，请提前登录 <a href="/login" class="login-link">立即登陆</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
               scroll:null,
               productData:JSON.parse(this.product),
            }
        },
        props:['product','user','route_class'],
        mounted() {
            window.addEventListener('scroll',this.handlerScroll)

        },
        computed:{

        },
        methods:{
            handlerScroll(){
                this.scroll=document.documentElement.scrollTop;
            },
            goBuy(){
                location.href='/products/'+this.productData.id;
            },
        },
    }
</script>
