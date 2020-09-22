<style lang="scss" scoped>
    .category-nav{
        margin:0;
        padding:0;
        .category-img{
            height:120px;
            margin:20px 0;
            overflow:hidden;
        }
        .category-box{
            margin-bottom:8px;
            .category-hd{
                position:relative;
                .title{
                    font-weight: 200;
                    color:#333;
                    line-height: 58px;
                    font-size:22px;
                }
                .more{
                    position:absolute;
                    top:0;
                    right:0;
                    .more-link{
                        font-size:16px;
                        line-height: 58px;
                        color:#424242;
                        text-decoration: none;
                    }
                }
            }
            .category-bd{
                .list{
                    display:block;
                    list-style: none;
                    margin:0;
                    padding:0;
                    .item:hover{
                        .item-link {
                            z-index: 2;
                            -webkit-box-shadow: 0 15px 30px rgba(0, 0, 0, .1);
                            box-shadow: 0 15px 30px rgba(0, 0, 0, .1);
                            -webkit-transform: translate3d(0, -2px, 0);
                            transform: translate3d(0, -2px, 0);
                        }
                    }
                    .item{
                        position:relative;
                        width:20%;
                        float:left;
                        .item-link{
                            background:#fff;
                            display:block;
                            text-align: center;
                            text-decoration: none;
                            margin:0 6px 14px 6px;
                            padding:20px 0;
                            img{
                                width:160px;
                                height:160px;
                                overflow: hidden;
                                margin-top:15px;
                            }
                            .title{
                                margin:0 10px 2px;
                                overflow: hidden;
                                white-space:nowrap;
                                text-overflow:ellipsis;
                                font-size:14px;
                                color:#333;
                                font-weight: 400;
                            }
                            .desc{
                                margin:0 10px 10px;
                                overflow: hidden;
                                text-overflow: ellipsis;
                                white-space: nowrap;
                                font-size:12px;
                                color:#b0b0b0;
                                height:18px;
                            }
                            .price{
                                color:#ff6700;
                                font-size:14px;
                                del{
                                    color:#b0b0b0;
                                }
                            }

                        }
                    }
                }
            }
        }
    }

</style>
<template>
<div>
    <div class="category-nav" v-for="(v,k) in category_products_data">
        <div class="category-img">
            <a href="">
            <img :src="v.ximg" alt="">
            </a>
        </div>
        <div class="category-box">
            <div class="category-hd">
                <h2 class="title">{{v.name}}</h2>
                <div class="more">
                    <a :href="'/a/c/'+v.id" class="more-link">查看全部
                        <i class="el-icon-caret-right"></i>
                    </a>
                </div>
            </div>
            <div class="category-bd">
                <ul class="list">
                    <li class="item" v-for="(i,j) in v.products" v-if="j<10">
                        <a :href="'/products/'+i.id" class="item-link">
                            <div class="img">
                                <img :src="i.img_url" alt="" width="160" height="160">
                            </div>
                            <p class="title">
                                {{i.title}}
                            </p>
                            <p class="desc" v-html="i.description"></p>
                            <p class="price">
                                <span>{{i.price}}</span>元起
                                <del>2099元</del>
                            </p>
                        </a>
                    </li>
                </ul>
            </div>
            <div style="clear: both"></div>
        </div>
    </div>
</div>
</template>

<script>
    export default {
        data(){
            return{
                category_products_data:JSON.parse(this.data),
            }
        },
        mounted() {

        },
        props:['data'],

    }
</script>
