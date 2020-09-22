<style lang="scss" scoped>
.order-detail-box{
    padding:48px 48px;
    background:#fff;
    color:#757575;
    .order-detail-hd{
        color:#757575;
        border-bottom: 1px solid #b0b0b0;
        padding-bottom:30px;
        .title{
            font-size: 28px;
        }
        .order-no{
            margin-top:30px;
            color:#333;
            span{
                float:right;
                color:#757575;
            }
        }
    }
    .order-detail-bd{
        margin-top:30px;
        .status{
            color:#b0b0b0;
            font-size:16px;
        }
        .step{
            margin:20px 0;
        }
    }
    .orders{
        border-bottom: 1px solid #b0b0b0;
        margin-top:30px;
        padding:30px;
        ul{
            list-style:none;
            display:block;
            li{
                margin-bottom:10px;
                .order-title{
                    font-size: 14px;
                    color:#333;
                    margin-top:30px;
                }
                .price{
                    font-size: 14px;
                    color:#333;
                    margin-top:30px;
                }
            }
        }
    }
    .address{
        margin-top:30px;
        border-bottom: 1px solid #757575;
        padding-bottom: 30px;
        .address-title{
            font-size: 16px;
            color:#333;
        }
        .address-info{
            color:#757575;
            font-size:14px;
            margin-top:20px;
            p{
                line-height: 2;
                span{
                    font-weight:400;
                }
            }

        }
    }
    .payment{
        margin-top:20px;
        padding-bottom:30px;
        border-bottom:1px solid #b0b0b0;
        .payment-title{
            font-size:16px;
            color:#333;
        }
        .payment-bd{
            font-size:14px;
            margin-top:10px;
        }
    }
    .total{
        .el-row{
            margin-top:10px;
        }
        margin-top:30px;
        padding-bottom:30px;
        .total-title{
            font-weight:600;
        }
        .total-value{
            color:#ff6700;
        }
        .total-amount{
            font-size: 16px!important;
        }
    }
}
</style>
<template>
    <div class="order-detail-box">
        <div class="order-detail-hd">
            <div class="title">订单详情</div>
            <div class="order-no">订单号：{{orderData.no}} <span><el-button type="info" size="mini">联系客服</el-button></span> </div>
        </div>
        <div class="order-detail-bd">
            <div class="status">{{orderData.closed?'已关闭':''}}</div>
            <div class="step">
                <el-steps :active="active" simple>
                    <el-step title="下单" icon="el-icon-edit"></el-step>
                    <el-step title="付款" icon="el-icon-upload"></el-step>
                    <el-step title="出库" icon="el-icon-picture"></el-step>
                    <el-step title="交易成功" icon="el-icon-picture"></el-step>
                </el-steps>
            </div>
            <div class="orders">
                <ul>
                    <li v-for="(v,k) in JSON.parse(user).orders[0].order_items">
                        <el-row>
                            <el-col :span="3">
                                <div class="img"><img :src="v.product.img_url" alt="" width="80" height="80"></div>
                            </el-col>
                            <el-col :span="8">
                                <div class="order-title">{{v.product.title}} {{v.product_sku.title}}</div>
                            </el-col>
                            <el-col :span="13">
                                <div class="price">{{v.price}}元 x {{v.amount}}</div>
                            </el-col>
                        </el-row>
                    </li>
                </ul>
            </div>
            <div class="address">
                <div class="address-title">
                    收货信息
                </div>
                <div class="address-info">
                    <p><span>姓名：</span>{{JSON.parse(user).orders[0].address.contact_name}}</p>
                    <p><span>联系电话：</span>{{JSON.parse(user).orders[0].address.contact_phone}}</p>
                    <p><span>收货地址：</span>{{JSON.parse(user).orders[0].address.address}}</p>
                </div>
            </div>
            <div class="payment">
                <div class="payment-title">
                    支付方式
                </div>
                <div class="payment-bd">
                    支付方式：在线支付
                </div>
            </div>
            <div class="total">
                <el-row>
                    <el-col :span="3" class="total-title">付款状态：</el-col>
                    <el-col :span="3" class="total-value">{{orderData.paid_at?'已付款':'未付款'}}</el-col>
                    <el-col :span="12">
                        <el-button size="mini" v-if="!orderData.closed && orderData.paid_at">申请退款</el-button>
                        <el-button size="mini" v-if="!orderData.closed && !orderData.paid_at">去付款</el-button>
                        &nbsp</el-col>
                    <el-col :span="3" class="total-title">商品总价：</el-col>
                    <el-col :span="3" class="total-value">{{orderData.total_amount}}元</el-col>
                </el-row>
                <el-row>
                    <el-col :span="3" class="total-title">物流状态：</el-col>
                    <el-col :span="3" class="total-value">{{orderData.ship_status==='pending'?'未发货':''}} {{orderData.ship_status==='received'?'已收货':''}} {{orderData.ship_status==='delivered'?'已发货':''}}</el-col>
                    <el-col :span="12"><el-button size="mini" v-if="!orderData.closed && orderData.ship_status==='delivered'" :id="'btn'+orderData.id" @click="received(orderData.id)">确认收货</el-button>&nbsp</el-col>
                    <el-col :span="3" class="total-title">运费：</el-col>
                    <el-col :span="3" class="total-value">0元</el-col>
                </el-row>
                <el-row>
                    <el-col :span="3" class="total-title">&nbsp</el-col>
                    <el-col :span="3" class="total-value">&nbsp</el-col>
                    <el-col :span="12">&nbsp</el-col>
                    <el-col :span="3" class="total-title">店铺优惠：</el-col>
                    <el-col :span="3" class="total-value total-amount">-{{orderData.coupon_code_id?orderData.coupon_code.value:0}}元</el-col>
                </el-row>
                <el-row>
                    <el-col :span="3" class="total-title">订单状态：</el-col>
                    <el-col :span="3" class="total-value">{{orderData.closed?'已关闭':'未关闭'}}</el-col>
                    <el-col :span="12"><el-button size="mini" v-if="!orderData.closed && orderData.ship_status==='received' && !orderData.reviewed" @click="review(orderData.id)">去评价</el-button>&nbsp</el-col>
                    <el-col :span="3" class="total-title">应付金额：</el-col>
                    <el-col :span="3" class="total-value total-amount">{{orderData.coupon_code_id?orderData.total_amount-orderData.coupon_code.value:orderData.total_amount}}元</el-col>
                </el-row>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        data(){
            return {
                // 标题
                title:'个人中心-我的喜欢',
                active:2,
                orderData:JSON.parse(this.user).orders[0],
            }
        },
        props:{
            type:String,
            user:String,
        },
        // 定义观察器，对应属性变更时会触发对应的观察器函数
        watch: {


        },
        // 组件初始化时会调用这个方法
        created() {
        },
        methods:{
            // 去评价
            review(id){
                location.href='/orders/'+id+'/review';
            },
            // 确认收货
            received(id){
                this.$emit('funreceived',id);
                this.$message('操作成功');
                $('#btn'+id).remove();
            },
            disFavoriteProduct(id){
                let _this=this;
                axios.delete('/products/'+id+'/favor').then(function(){
                    _this.$message('操作成功');
                    location.reload();
                },function(err){
                    if(err.response && err.response.status===401){
                        _this.$message({
                            message:'请先登录',
                            type:'error',
                        });
                    }else if (error.response && (error.response.data.msg || error.response.data.message)) {
                        // 其他有 msg 或者 message 字段的情况，将 msg 提示给用户
                        _this.$message({
                            message:error.response.data.msg ? error.response.data.msg : error.response.data.message,
                            type:'error',
                        });
                    }  else {
                        // 其他情况应该是系统挂了
                        _this.$message({
                            message:'系统错误',
                            type:'error'
                        });
                    }
                });
            },
            goDetail(id){
                location.href='/products/'+id;
            },
        },
        mounted() {
            if(this.orderData.paid_at){
                this.active=2;
            }
            if(this.orderData.ship_status==='delivered'){
                this.active=3;
            }
            if(this.orderData.ship_status==='received'){
                this.active=4;
            }
        }
    }
</script>
