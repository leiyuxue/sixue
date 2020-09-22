<style lang="scss" scoped>
.categories-product{
    background:#f5f5f5;
    .hd{
        font-size:24px;
        line-height:64px;
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
        .img-link{
        }
        .bt{
            padding:30px;
            .title{
                font-size:24px;
                color:#333;
            }
            .desc{
                fon-size:14px;
                color:#b0b0b0;
            }
            .price{
                color:#ff6700;
                font-size: 24px;
                line-height:48px;
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
        <div class="item" v-for="(v,k) in categoriesData" :key="k">
            <div class="hd">
                <div class="container">
                    {{v.name}}
                </div>
            </div>
            <div class="bd">
                <div class="container">
                    <div class="products">
                        <el-row :gutter="10" v-for="(i,j) in v.products" v-if="j%2==0" style="margin:15px 0" :key="j">
                            <el-col :span="12">
                                <div class="product-item" >
                                    <a :href="'/products/'+i.id" class="img-link"><img :src="i.img_url" alt="" height="358" width="100%"></a>
                                    <el-row class="bt">
                                        <el-col :span="18">
                                            <div class="title-desc">
                                                <p class="title"><a :href="'/products/'+i.id">{{i.title}}</a></p>
                                                <p class="desc" v-html="i.description"></p>
                                            </div>
                                        </el-col>
                                        <el-col :span="6">
                                            <div class="price">
                                                {{i.price}} <span>元</span>
                                            </div>
                                        </el-col>
                                    </el-row>
                                </div>
                            </el-col>
                            <el-col :span="12" v-if="j+1<v.products.length">
                                <div class="product-item">
                                    <a :href="'/products/'+v.products[j+1].id" class="img-link"><img :src="v.products[j+1].img_url" alt="" height="358" width="100%"></a>
                                    <el-row class="bt">
                                        <el-col :span="18">
                                            <div class="title-desc">
                                                <p class="title"><a :href="'/products/'+v.products[j+1].id">{{v.products[j+1].title}}</a></p>
                                                <p class="desc" v-html="v.products[j+1].description"></p>
                                            </div>
                                        </el-col>
                                        <el-col :span="6">
                                            <div class="price">
                                                {{v.products[j+1].price}} <span>元</span>
                                            </div>
                                        </el-col>
                                    </el-row>
                                </div>
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
