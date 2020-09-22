<style lang="scss" scoped>
    .search{
         background:#f5f5f5;
        .bread{
            height:40px;

            .el-breadcrumb{
                line-height:40px;
                color:#757575;
                font-size:12px;
            }
        }
        .search-filter{
            background:#fff;
            .item{
                position: relative;
                overflow: hidden;
                border-top: 1px solid #ededed;
                padding: 0 60px 0 124px;
                margin: 0;
                list-style: none;
                font-size: 0;
                .item-main{
                    .label{
                        top:0;
                        left:0;
                        color:#b0b0b0;
                        position: absolute;
                        height: 20px;
                        line-height: 20px;
                        padding: 14px 0;
                        font-size: 14px;
                    }
                    li{
                        display: inline-block;
                        text-overflow: ellipsis;
                        overflow: hidden;
                        color: #424242;
                        font-size: 14px;
                        width: 148px;
                        padding: 14px 0;
                        height: 20px;
                        line-height: 20px;
                    }
                }
            }
        }
        .products{
            .product-order{
                height:30px;
                margin:30px 0px 20px;
                ul{
                    list-style: none;
                    display:block;
                    margin:0;
                    padding:0;
                    li{
                        float:left;
                        padding:0 30px;
                        height:30px;
                        line-height:30px;
                        a{

                        }
                    }
                    .br{
                        border-right:1px solid #e0e0e0;
                    }
                }
            }
            .products-box{
                margin:30px 0px 20px;
                ul{
                    list-style: none;
                    display:block;
                    margin:0;
                    padding:0;
                    li{
                        float:left;
                        height:383px;
                        width:296px;
                        background:#fff;
                        margin:47px 14px 14px 0px;
                        .img{
                            width: 200px;
                            height: 200px;
                            margin: 0 auto 16px;
                        }
                        .title{
                            text-align: center;
                        }
                        .price{
                            text-align: center;
                            margin-top:10px;
                        }
                    }
                    li:hover{
                        z-index: 2;
                        -webkit-box-shadow: 0 15px 30px rgba(0, 0, 0, .1);
                        box-shadow: 0 15px 30px rgba(0, 0, 0, .1);
                        -webkit-transform: translate3d(0, -2px, 0);
                        transform: translate3d(0, -2px, 0);
                    }
                }
            }
        }
    }
</style>
<template>
    <div class="search">
        {{paginationData}}
        <div class="bread">
            <div class="container">
                <el-breadcrumb separator-class="el-icon-arrow-right">
                    <el-breadcrumb-item :to="{ path: '/' }">首页</el-breadcrumb-item>
                    <el-breadcrumb-item></el-breadcrumb-item>
                </el-breadcrumb>
            </div>
        </div>
        <div class="search-filter">
            <div class="container">
<!--                <ul class="properties-list" v-for="(propty,p) in propties" :key="p">-->
<!--                    <div class="item-main" >-->
<!--                            <span class="label">-->
<!--                                {{propty.key}}：-->
<!--                            </span>-->
<!--                        <li class="property-item" v-for="(v,k) in propty.values" :key="k">-->
<!--                            <a href="">{{v}}</a>-->
<!--                        </li>-->
<!--                    </div>-->
<!--                </ul>-->
            </div>
        </div>
        <div class="products">
            <div class="product-order">
                <div class="container">
                    <ul class="order-list">
                        <li class="order-item br" >
                            <a href="">综合</a>
                        </li>
                        <li class="order-item br">
                            <a href="">新品</a>
                        </li>
                        <li class="order-item br">
                            <a href="">销量</a>
                        </li>
                        <li class="order-item br" >
                            <a href="">价格</a>
                        </li>
                        <div style="clear: both"></div>
                    </ul>
                </div>
            </div>
            <div class="products-box">
                <div class="container" style="width:1240px;">
                    <ul class="products-list">
                        <li class="products-item" v-for="(v,key) in productsData" :key="key">
                            <div class="img">
                                <a href="">
                                    <img :src="v.img_url" alt="" width="200" height="200">
                                </a>
                            </div>
                            <div class="title">
                                <a href="">{{v.title}}</a>
                            </div>
                            <div class="price">{{v.price}}元 起 </div>
                        </li>
                        <div style="clear: both"></div>
                    </ul>
                    <div class="float-right" >
                        <pagination-component :pagination="paginationData" @getData="getData"></pagination-component>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                productsData:JSON.parse(this.products),
                paginationData:JSON.parse(this.pagination),
            }
        },
        props:{
            products:null,
            propties:{},
            pagination:{},
        },
        mounted() {
        },
        methods:{
            // 分页请求
            getData(v){
                axios.get('/search',{page:v}).then(function(res){
                    console.log(res.data);
                },function(err){
                    console.log(err.response);
                });
            },
        },
    }
</script>
