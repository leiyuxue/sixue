<style lang="scss" scoped>
    .hide{
        display:none;
    }
    .show{
        display:block;
    }
    .nav-category:hover{
        .category-box{
            display: block;
        }
    }


    .nav-category{
        position: relative;
        float: left;
        width: 127px;
        padding-right: 15px;
        .link-category{
            display: block;
            padding: 26px 0 38px;
            text-align: right;
            color: #333;
        }
        .category-box{
            position:absolute;
            width: 234px;
            height:460px;
            top:85px;
            left:-86px;
            z-index: 21;
            font-size: 14px;
            .category-list{
                margin: 0;
                padding:20px 0;
                list-style: none;
                height: 420px;
                border: 0;
                color: #fff;
                background: rgba(105,101,101,.6);
                .category-item{
                    list-style: none;
                    .title{
                        display: block;
                        color:#fff;
                        height:42px;
                        line-height: 42px;
                        position:relative;
                        padding-left:30px;
                        .el-icon-arrow-right{
                            position: absolute;
                            top:14px;
                            right:14px;
                        }
                    }
                    .children{
                        width:992px;
                        height:458px;
                        background-color: #fff;
                        border:1px solid #e0e0e0;
                        border-left:0;
                        position:absolute;
                        left:234px;
                        top:0;
                        z-index:22;
                        display: none;
                        .children-category-list{
                            margin:0;
                            padding:0;
                            list-style: none;
                            .children-category-item{
                                position:relative;
                                float:left;
                                width:248px;
                                height:76px;
                                .link{
                                    display: block;
                                    padding: 18px 10px;
                                    line-height: 40px;
                                    color: #333;
                                    -webkit-transition: color .2s;
                                    transition: color .2s;
                                    img{
                                        float: left;
                                        margin-right: 12px;
                                        vertical-align: middle;
                                    }
                                    .text{
                                        float: left;
                                        width: 172px;
                                        line-height: 40px;
                                        white-space: nowrap;
                                        text-overflow: ellipsis;
                                        overflow: hidden;
                                    }
                                }
                            }
                        }
                    }
                }
                .category-item:hover{
                    background-color: #ff6700;
                    .children{
                        display:block;
                    }

                }
            }
        }

    }

</style>
<template>
    <li class="nav-category">
        <span class="link-category" :class="route_class=='root'?'visibility':''"><span>全部商品分类</span></span>
        <div class="category-box" :class="route_class=='root'?'show':'hide'">
            <ul class="category-list">
                <li class="category-item" v-for="(v,k) in categoriesData" :key="k">
                    <a :href="'/a/c/'+v.id" class="title">{{v.name}}<el-icon class="el-icon-arrow-right"></el-icon></a>
                    <div class="children">
                        <ul class="children-category-list">
                            <li class="children-category-item" v-for="(i,j) in v.products">
                                <a class="link" :href="'/products/'+i.id">
                                    <img :src="i.img_url" alt="" width="40" height="40">
                                    <span class="text">{{i.title}}</span>
                                </a>
                            </li>
                            <li style="clear: both"></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </li>
</template>

<script>
    export default {
        data(){
            return{
                categoriesData:{},
            }
        },
        mounted() {
            this.categoriesData=JSON.parse(this.categories);
        },
        props:['route_class','categories'],

    }
</script>
