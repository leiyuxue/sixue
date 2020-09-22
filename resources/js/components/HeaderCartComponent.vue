<style lang="scss" scoped>
    .cart:hover{
        background-color: #fff;
        .active-title{
            background: #fff;
            color:#ff6700;
        }
        .cart-dropdown{
            height:auto;
            .cart-box{
                .none-shop{
                    line-height: 100px;
                    height:100px;
                }
            }
        }
    }
    .cart{
        position: relative;
        width: 120px;
        padding: 0;
        white-space: nowrap;
        display: block;
        float:right;
        color: #b0b0b0;
        background: #424242;
        .cart-title{
            position:relative;
            display: block;
            text-align: center;
            width:120px;
            height:40px;
            z-index:5;
        }
        .active-title{
            background:#ff6700;color:#fff;
        }
        .cart-title:hover{
            color:#ff6700;
            z-index:5;
        }
        .cart-dropdown{
            transition:height .3s;
            position:absolute;
            width:300px;
            height:0;
            top:40px;
            right:0;
            z-index:32;
            box-shadow:0 2px 5px rgba(0,0,0,.15);
            overflow: hidden;
            background-color: #fff;

            .cart-box{
                .none-shop{
                    text-align: center;
                    height:0px;
                }
                .cart_list{
                    ul{
                        padding:10px 20px 0px;z-index: 999;
                        list-style: none;
                        display:block;
                        .item{
                            .bt{
                                border-bottom: 1px solid #ccc;
                            }

                            .title{
                                height:40px;line-height: 20px;margin:10px 0;overflow: hidden;
                            }
                        }
                    }
                    .bottom{
                        background: #fafafa;
                        .bottom-box{
                            padding:10px 20px;
                            .left{
                                float:left;
                                p{
                                    height:18px;
                                    line-height: 18px;
                                }
                                .price{
                                    color:#ff6700;
                                    .price-num{
                                        font-size: 16px;
                                    }
                                }
                            }
                            .right{
                                float:right;
                                .el-button{
                                    float: right;
                                    margin-top:8px;
                                }
                            }
                        }

                    }
                }

            }
        }
        i{
            font-size: 16px;font-weight: 700
        }
    }
</style>

<template>
    <span class="cart">
      <a href="/cart_list" class="cart-title" :class="is_login && cartsData.length>0?'active-title':''">
          <i class="el-icon-shopping-cart-2"></i> 购物车 ({{is_login && cartsData.length>0?cartsData.length:0}})
      </a>
      <div class="cart-dropdown">
            <div class="cart-box">
                <div class="none-shop" v-if="!is_login || cartsData.length<=0">没有任何物品，前去挑选</div>
                <div class="cart_list" v-if="is_login || cartsData.length>0">
                    <div>
                        <ul>
                            <li class="item" v-for="(v,k) in cartsData" :key="k" :class="cartsData.length!=k+1?'bt':''">
                                <el-row>
                                    <el-col :span="7">
                                        <div class="img">
                                            <a :href="'/products/'+v.product_sku.product.id"><el-image :src="v.product_sku.imgs_url" alt="" style="width:60px;height:60px;"></el-image></a>
                                        </div>
                                    </el-col>
                                    <el-col :span="10">
                                        <div class="title">
                                            <a :href="'/products/'+v.product_sku.product.id">{{v.product_sku.product.title}} {{v.product_sku.title}}</a>
                                        </div>
                                    </el-col>
                                    <el-col :span="7">
                                        <div class="price">
                                            {{v.product_sku.price}}元x{{v.amount}}
                                        </div>
                                    </el-col>
                                </el-row>
                            </li>
                        </ul>
                        <div class="bottom">
                            <div class="bottom-box">
                                <div class="left">
                                    <div class="num_price">
                                        <p class="num">共{{cartsData.length}}件商品</p>
                                        <p class="price"><span class="price-num">{{total_price}}</span> 元</p>
                                    </div>
                                </div>
                                <div class="right">
                                    <el-button size="mini" type="warning" @click="goBuy">去购物车结算</el-button>
                                </div>
                                <div style="clear: both"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
      </div>
    </span>
</template>

<script>
    export default {
        data(){
            return {
                cartsData:JSON.parse(this.carts),
            }
        },
        props:{
            carts:{},
            is_login:false,
        },
        computed:{
            total_price(){
                let total=0;
                this.cartsData.forEach((cart)=>{
                    total+=cart.amount*cart.product_sku.price;
                });
                return total;
            }
        },
        mounted() {

        },
        methods:{
            goBuy(){
                location.href='/cart_list';
            },
        },
    }
</script>
