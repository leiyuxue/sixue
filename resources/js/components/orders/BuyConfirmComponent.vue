<style lang="scss" scoped>
    .buy-confirm{
        background:#f5f5f5;
        padding:38px 0;
        .order-info{
            background:#fff;padding:30px 30px;
            .base-info{
                padding-bottom: 20px;
                .base-info-l{
                    text-align:center;
                    i{
                        font-size: 84px;color:#83c44e
                    }
                }
                .base-info-c{
                    .success-title{
                        font-size:24px;color:#333;
                    }
                    .last-time{
                        font-size:14px;color:#757575;margin-top:20px;
                        .time{
                            color:#ff6700
                        }
                    }
                    .address{
                        font-size: 14px;color:#757575;margin-top:10px;
                    }
                }
                .base-info-r{
                    .total-price{
                        font-size:14px;
                        span{
                            font-size: 22px;color:#ff6700
                        }
                    }
                    .order-info-btn{
                        margin-top:20px;
                    }
                }
            }
            .hide-info{
                padding-top:20px;
                .hide-info-l{

                }
                .hide-info-r{
                    border-top: 1px solid #b0b0b0;font-size: 14px;
                    padding:10px 0;
                    color:#333;
                    .item{
                        margin-top:10px;
                        .no{
                            color:#ff6700
                        }
                        .order-item{
                            margin-bottom:5px;
                        }
                    }
                }
            }
        }
        .pay-btn{
            padding:10px 30px;margin-top:30px;background:#fff;
            .hd{
                line-height: 2;border-bottom: 1px solid #b0b0b0;font-size: 16px;color:#333;padding-bottom:20px;
            }
            .bd{
                margin-top:30px;
                .title{
                    font-size: 16px;font-weight: 400
                }
                .btns{
                    margin:20px 0;
                }
            }
        }
    }
</style>
<template>
    <div class="buy-confirm">
        <div class="container">
            <div class="order-info">
                <el-row class="base-info">
                    <el-col class="base-info-l" :span="4">
                        <i class="el-icon-circle-check"></i>
                    </el-col>
                    <el-col :span="16" class="base-info-c">
                        <p class="success-title">订单提交成功！去付款咯～</p>
                        <p class="last-time">请在<span class="time">{{closeTime}}</span>之前完成支付, 超时后将取消订单</p>
                        <p class="address"  v-if="!isShowInfo">收货信息：{{orderData.address.contact_name}} {{orderData.address.contact_phone}} {{orderData.address.address}}</p>
                    </el-col>
                    <el-col :span="4" class="base-info-r">
                        <p class="total-price">应付总额：<span>{{orderData.coupon_code_id?orderData.total_amount-orderData.coupon_code.value:orderData.total_amount}}</span>元</p>
                        <p class="order-info-btn"><el-link  :underline="false" @click="showInfoToggle" icon="el-icon-arrow-down">订单详情 </el-link></p>
                    </el-col>
                </el-row>
                <el-row class="hide-info"  v-if="isShowInfo">
                    <el-col :span="4" class="hide-info-l">&nbsp;</el-col>
                    <el-col :span="20" class="hide-info-r">
                        <el-row class="item">
                            <el-col :span="2">
                                <div class="key">订单号：</div>
                            </el-col>
                            <el-col :span="22">
                                <div class="value"> <span class="no">{{orderData.no}}</span></div>
                            </el-col>
                        </el-row>
                        <el-row class="item">
                            <el-col :span="2">
                                <div class="key">收货信息：</div>
                            </el-col>
                            <el-col :span="22">
                                <div class="value"> <span >{{orderData.address.contact_name}} {{orderData.address.contact_phone}} {{orderData.address.address}}</span></div>
                            </el-col>
                        </el-row>
                        <el-row class="item">
                            <el-col :span="2">
                                <div class="key">商品名称：</div>
                            </el-col>
                            <el-col :span="22">
                                <div class="value order-item" v-for="(v,k) in orderData.order_items">{{v.product_sku.product.title}} {{v.product_sku.title}} x {{v.amount}}</div>
                            </el-col>
                        </el-row>
                    </el-col>
                </el-row>
            </div>
            <div class="pay-btn">
                <div class="hd">
                    选择以下支付方式付款
                </div>
                <div class="bd">
                    <div class="title">支付平台</div>
                    <div class="btns">
                        <el-button @click="payment(orderData.id,orderData.user_id)">微信支付</el-button>
                        <el-button><a :href="'/payment/'+orderData.id+'/alipay'">支付宝支付</a></el-button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import DateUtils from "../../utils/DateUtils";

    export default {
        data(){
            return {
                orderData:JSON.parse(this.order),
                closeTime:null,
                isShowInfo:false,
            }
        },
        mounted() {
            // alert('mounted');
            // 获取选中的商品
            let t=new Date(this.orderData.created_at);
            let h=t.setHours(t.getHours()+2);
            this.closeTime=DateUtils.time_stamp(h);
        },
        created() {
        },
        computed:{
        },
        watch:{

        },
        props:['order'],
        methods:{
            payment(id,uid){
                let _this=this;
                axios.post('/pay/'+id).then(function(res){
                    _this.$message('支付成功');
                    location.href='/users/'+uid+'/personal/orderDetail?id='+id;
                });
            },
            showInfoToggle(){
                this.isShowInfo=!this.isShowInfo;
            }
        },
    }
</script>
