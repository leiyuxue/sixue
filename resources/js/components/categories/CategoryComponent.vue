<style lang="scss" scoped>
.categories-product{
    background:#f5f5f5;
    .hd{
        font-size:24px;
        line-height:64px;
        background: #fff;
        text-align: center;
        margin:10px 0;
    }
    .product-item:hover{
        z-index: 2;
        -webkit-box-shadow: 0 15px 30px rgba(0, 0, 0, .1);
        box-shadow: 0 15px 30px rgba(0, 0, 0, .1);
        -webkit-transform: translate3d(0, -2px, 0);
        transform: translate3d(0, -2px, 0);
    }
    .product-item{
        height:100%;
        background:#fff;
        margin:15px 0;
        .img-link{
        }
        .bt{
            padding:50px;
            .title{
                font-size:24px;
                color:#333;
                margin-top:20px;
            }
            .desc{
                fon-size:14px;
                color:#b0b0b0;
            }
            .price{
                color:#ff6700;
                font-size: 24px;
                line-height:48px;
                margin-top:50px;
                span{
                    font-size: 14px;
                }
            }
        }

    }
}
</style>
<template>
<div class="categories-product">
    <div class="list">
            <div class="hd">
                <div class="container">
                    {{categoriesData.name}}
                </div>
            </div>
            <div class="bd">
                <div class="container">
                    <div class="products">
                        <div class="product-item" v-for="(i,j) in categoriesData.products">
                            <el-row>
                                <el-col :span="16">
                                    <a :href="'/products/'+i.id" class="img-link"><img :src="i.img_url" alt="" height="358" width="100%"></a>
                                </el-col>
                                <el-col :span="8">
                                    <el-row class="bt">
                                            <div class="title-desc">
                                                <p class="title"><a :href="'/products/'+i.id">{{i.title}}</a></p>
                                                <p class="desc" v-html="i.description"></p>
                                            </div>
                                            <div class="price">
                                                {{i.price}} <span>元</span>
                                            </div>
                                    </el-row>
                                </el-col>
                            </el-row>
                        </div>
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
                categoriesData:JSON.parse(this.categories),
            }
        },
        props:[
            'categories'
        ],
    }
</script>
