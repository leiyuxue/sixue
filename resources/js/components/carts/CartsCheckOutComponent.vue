<style lang="scss" scoped>
.carts-checkout{
    background:#fff;
    padding:30px 24px;
    .addresses{
        .ad-hd{

        }
        .ad-bd{
            margin-top:20px;
            .ad-list{
                list-style: none;
                display: block;
                .active{
                    border:1px solid #ff6700!important;
                    .actions{
                        display:block!important;
                    }
                }
                .ad-item{
                    float:left;
                    width:220px;
                    height:163px;
                    border:1px solid #e0e0e0;
                    position:relative;
                    padding:15px 24px 0;
                    margin:0 17px 20px 0;
                    cursor:pointer;
                    .name{
                        font-size:18px;
                        line-height:22px;
                        color:#333;
                        margin-bottom:10px;
                        .tag{
                            float:right;
                            font-size: 14px;
                            color:#757575;
                        }
                    }
                    .phone,.full-address,.address{
                        color:#757575;
                        font-size:14px;
                        margin-bottom:8px;
                    }
                    .actions{
                        position:absolute;
                        right:24px;
                        bottom:17px;
                        display:none;
                        color:#ff6700;
                        font-size:14px;
                    }
                }
                .ad-item:hover{
                    border:1px solid #b0b0b0;
                    .actions{
                        display:block;
                    }
                }
            }
            .more-address{
                text-align: center;
                height:50px;
                line-height: 50px;
                background:#eee;
                margin-top:30px;
                cursor:pointer;
            }
        }
    }
    .buy-check{
        margin-top:30px;
        .ck-hd{
            font-size:18px;
            color:#333;
            line-height:40px;
        }
        .ck-bd{
            margin-top:30px;
            border-bottom:1px solid #e0e0e0;
            .buy-list{
                list-style: none;
                .buy-item{
                    padding:10px 0;
                    font-size:14px;
                    color:#333;
                    line-height: 30px;
                    .total{
                        color:#ff6700;
                    }
                }
            }
        }
        .coupon{
            margin-top:30px;
        }
        .ck-total{
            margin-top:30px;
            .ck-total-hd{
                font-size:18px;
            }
            .ck-total-bd{
                margin-top:30px;
                p{
                    font-size:14px;
                    color:#757575;
                    line-height:2;
                    span{
                        width:50%;
                        text-align:right;
                        display:block;
                        color:#ff6700;
                        float:left;
                    }
                    .i-title{
                        color:#333;
                    }
                    .total-count{
                        font-size:18px;
                    }
                }
            }
        }
    }
    .check-btn{
        border-top:2px solid #e0e0e0;margin-top:30px;padding-top:20px;
        .ck-address{
            font-size: 14px;
            color:#333;
            p{
                line-height:20px;
            }
            .el-link{
                color:#ff6700;
            }
        }
    }
}
</style>
<template>
    <div class="bd" style="background: #f5f5f5;padding:30px 0">
        <div class="container">
            <div class="carts-checkout">
                <div class="addresses">
                    <div class="ad-hd">
                        <h3>收货地址</h3>
                    </div>
                    <div class="ad-bd">
                        <ul class="ad-list">
                            <li class="ad-item" v-for="(v,k) in addressesData" @click="checkAddress(v.id)" :style="k>3 && !is_show_more_address?'display:none':'display:block'" :class="v.id===checkAddressId?'active':''">
                                <div class="name">{{v.contact_name}} <span class="tag">{{v.tag}}</span></div>
                                <p class="phone">{{v.contact_phone}}</p>
                                <p class="full-address">{{v.full_address}}</p>
                                <span class="actions">修改</span>
                            </li>
                            <li style="clear:both;"></li>
                        </ul>
                        <div class="more-address" @click="toggleMore">{{is_show_more_address?'收起更多收货地址':'显示更多收货地址'}} <i :class="is_show_more_address?'el-icon-arrow-up':'el-icon-arrow-down'"></i></div>
                    </div>
                </div>
                <div class="buy-check">
                    <div class="ck-hd">商品</div>
                    <div class="ck-bd">
                        <ul class="buy-list">
                            <li class="buy-item" v-for="(v,k) in checkData">
                                <el-row>
                                    <el-col :span="1">
                                        <div class="img">
                                            <img :src="v.product_sku.product.img_url" alt="" width="30" height="30">
                                        </div>
                                    </el-col>
                                    <el-col :span="12">
                                        <div class="title"><a :href="'/products/'+v.product_sku.product.id">{{v.product_sku.product.title}}{{v.product_sku.title}}</a></div>
                                    </el-col>
                                    <el-col :span="6">

                                    </el-col>
                                    <el-col :span="3"><div class="price">{{v.product_sku.price}}元 x {{v.amount}}</div></el-col>
                                    <el-col :span="2"><div class="total">{{v.product_sku.price*v.amount}}元</div></el-col>
                                </el-row>
                            </li>
                        </ul>
                    </div>
                    <div class="coupon">
                        优惠卷：
                        <el-select v-model="cid" @change="computerCoupon" placeholder="店铺优惠">
                            <el-option
                                v-for="item in couponCodesData"
                                :key="item.id"
                                :label="item.description"
                                :value="item.id">
                            </el-option>
                        </el-select>
                    </div>
                    <div class="ck-total">
                        <div class="ck-total-hd">
                            合计:
                        </div>
                        <div class="ck-total-bd">
                            <el-row>
                                <el-col :span="20">&nbsp;</el-col>
                                <el-col :span="4">
                                    <p><span class="i-title">商品件数：</span><span class="value">{{numCount}}件</span></p>
                                    <p><span class="i-title">商品总价：</span><span class="value">{{totalCount}}元</span></p>
                                    <p><span class="i-title">活动优惠：</span><span class="value">-0元</span></p>
                                    <p><span class="i-title">优惠卷抵扣：</span><span class="value">-{{checkCouponCode.value?checkCouponCode.value:0}}元</span></p>
                                    <p><span class="i-title">运费：</span><span class="value">0元</span></p>
                                    <p><span class="i-title">应付总额：</span><span class="value total-count">{{totalPrice}}元</span></p>
                                </el-col>
                            </el-row>
                        </div>
                    </div>
                </div>
                <div class="check-btn" >
                    <el-row>
                        <el-col :span="9">
                            <div class="ck-address" v-if="checkAddressId">
                                <p>{{checkAddressItem.contact_name}}{{checkAddressItem.contact_phone}}</p>
                                <p>{{checkAddressItem.full_address}} <el-link>修改</el-link></p>
                            </div>
                            <div v-else>&nbsp;</div>
                        </el-col>
                        <el-col :span="9">
                            &nbsp;
                        </el-col>
                        <el-col :span="3">
                            <el-button style="width:120px;" type="info" @click="goCart">返回购物车</el-button>
                        </el-col>
                        <el-col :span="3">
                            <el-button style="width:120px;" type="warning" @click="addOrder" >立即下单</el-button>
                        </el-col>
                    </el-row>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
          return{
              addressesData:JSON.parse(this.addresses),
              checkData:JSON.parse(this.check_data),
              couponCodesData:{},
              numCount:0,
              totalCount:0,
              totalPrice:0,
              // 选中的地址
              checkAddressId:null,
              checkAddressItem:{},
              is_show_more_address:false,
              // 选择优惠卷
              checkCouponCode:{},
              cid:null,
          }
        },
        props:['check_data','addresses','coupon_codes'],
        mounted() {
            this.checkData.forEach((v)=>{
                this.numCount+=v.amount;
                this.totalCount+=v.product_sku.price*v.amount;
            });
            this.totalPrice=this.totalCount;
            let couponCodesAll=JSON.parse(this.coupon_codes);
            this.couponCodesData=couponCodesAll.filter((i)=>{
                if(i.min_price<=this.totalCount){
                    return i;
                }
            });

        },
        methods:{
            computerCoupon(value){
                if(value){
                    this.couponCodesData.filter((i)=>{
                        if(i.id===value){
                            this.checkCouponCode= i;
                        }
                    });
                    this.totalPrice=this.totalCount-this.checkCouponCode.value;
                }
            },
            addOrder(){
                let _this=this;
                if(!this.checkAddressId){
                    this.$message({
                        type:'error',
                        message:'请选择收货地址'
                    });
                }else{
                    axios.post('/orders',{address_id:this.checkAddressId,cart_items:this.checkData,couponId:this.cid}).then(function(res){
                        location.href='/users/'+res.data.user_id+'/personal/orderList';
                    },function(err){

                    });
                }

            },
            goCart(){
                location.href='/cart_list';
            },
            toggleMore(){
                this.is_show_more_address=!this.is_show_more_address;

            },
            checkAddress(id){
                this.checkAddressId=id;
                this.addressesData.forEach((v)=>{
                    if(v.id==id){
                        this.checkAddressItem=v;
                    }

                });
            },
        }
    }
</script>
