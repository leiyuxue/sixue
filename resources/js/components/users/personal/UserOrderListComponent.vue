<style lang="scss" scoped>
.order-box{
    padding:20px 48px;
    background:#fff;
    .order-hd{
        h3{
            color:#757575;
        }
    }
    .order-list{
        margin-top:20px;
        .order-tab{
            border:1px solid #ff6700;
            .hd{
                background:#fffaf7;padding:20px;
                .title{
                    color:#ff6700
                }
                .info{
                    margin:10px 0;color:#757575;font-size:14px;
                    .app_price_title{
                        float:right;
                        .app_price{
                            font-size: 18px;color:#333;
                        }
                    }

                }
             }
            .bd{
                border-top:1px solid #FFE495;padding:20px;
                .title-price{
                    font-size:14px;color:#757575;
                }
                .btns{
                    text-align:center;
                    .el-button{
                        width:100%;margin-top:10px;margin-left:0px;
                    }
                }
                ul{
                    list-style:none;
                    display:block;
                    .favorite-item{
                        float:left;
                        width:40%;
                        border-bottom:1px solid #ccc;
                        height:384px;
                        position:relative;
                        text-align: center;
                        .favorite-img{
                            width:200px;
                            height:200px;
                            margin:40px auto 10px;
                            .favorite-img-link{
                                display:block;

                            }
                        }
                        .title{
                            color:#333;
                            font-size:14px;
                            font-weight:400;
                            overflow:hidden;
                            white-space: nowrap;
                            text-overflow: ellipsis;
                            margin-bottom:5px;
                        }
                        .price{
                            color:#ff6700;
                            font-size:14px;
                            margin-bottom:10px;
                            del{
                                font-size:12px;
                            }
                        }
                        .favorite-actions{
                            margin-top:30px;
                        }
                    }
                    .favorite-item:nth-child(odd){
                        margin:0 40px 30px 0;
                    }
                    .favorite-item:nth-child(even){
                        margin:0 0 30px 0;
                    }
                    .favorite-item:hover{
                        border-color:#757575;
                    }
                    .favorite-actions{
                        opacity:0;
                    }
                    .favorite-item:hover .favorite-actions{
                        opacity:1;
                    }
                }
            }
        }

    }
}
</style>
<template>
    <div class="order-box">
        <div class="order-hd">
            <h3>我的订单</h3>
        </div>
        <div class="order-list">
            <el-tabs v-model="activeName" >
                <el-tab-pane label="全部有效订单" name="first">
                    <div class="first" >
                        <div class="order-tab"  v-for="(v,k) in orderList" >
                            <div class="hd">
                                <div class="title" >{{v.paid_at?'已付款':'未付款'}}-》{{v.ship_status==='pending'?'未发货':''}}{{v.ship_status==='delivered'?'已发货':''}}{{v.ship_status==='received'?'已收货':''}}</div>
                                <div class="info">
                                    <span>{{v.created_at}}</span>
                                    <el-divider direction="vertical"></el-divider>
                                    <span>{{v.address.contact_name}}</span>
                                    <el-divider direction="vertical"></el-divider>
                                    <span>订单号：{{v.no}}</span>
                                    <el-divider direction="vertical"></el-divider>
                                    <span>在线支付</span>
                                    <span class="app_price_title">应付金额： <span class="app_price">{{v.coupon_code_id?v.total_amount-v.coupon_code.value:v.total_amount}}</span> 元</span>
                                </div>
                            </div>
                            <div class="bd">
                                <el-row>
                                    <el-col :span="20">
                                        <ul>
                                            <li v-for="(item,j) in v.order_items">
                                                <el-row>
                                                    <el-col :span="4">
                                                        <div class="img">
                                                            <img :src="item.product.img_url" alt="" width="80" height="80px;">
                                                        </div>
                                                    </el-col>
                                                    <el-col :span="20">
                                                        <div class="title-price" >
                                                            <p>{{item.product.title}} {{item.product_sku.title}}</p>
                                                            <p>{{item.price}}元 × {{item.amount}}</p>
                                                        </div>
                                                    </el-col>
                                                </el-row>
                                            </li>
                                        </ul>
                                    </el-col>
                                    <el-col :span="4" class="btns">
                                        <div v-if="!v.closed">
                                            <el-button  type="warning" size="mini" @click="nowBuy(v.id)" v-if="!v.paid_at">立即付款</el-button>
                                            <el-button  type="warning" size="mini" @click="nowBuy(v.id)" v-if="v.paid_at">申请退款</el-button>
                                            <el-button  type="warning" size="mini" @click="review(v.id)" v-if="v.ship_status==='received' && !v.reviewed">去评价</el-button>
                                            <el-button  type="warning" size="mini" @click="received(v.id)" :id="'btn'+v.id" v-if="v.ship_status==='delivered'">确认收货</el-button>
                                            <el-button  type="info" size="mini" @click="orderDetail(v.id,v.user_id)">订单详情</el-button>
                                            <el-button  type="info" size="mini">联系客服</el-button>
                                        </div>
                                    </el-col>
                                    <div style="clear:both"></div>
                                </el-row>
                            </div>
                        </div>
                    </div>
                </el-tab-pane>
                <el-tab-pane label="待支付" name="second">
                    <div class="second">
                    <div class="order-list" style="border:1px solid #ff6700" v-for="(v,k) in unpaidList" >
                        <div class="hd" style="background:#fffaf7;padding:20px;">
                            <div class="title" style="color:#ff6700">{{v.paid_at?'已付款':'未付款'}}-》{{v.ship_status==='pending'?'未发货':''}}{{v.ship_status==='delivered'?'已发货':''}}{{v.ship_status==='received'?'已收货':''}}</div>
                            <div class="info" style="margin:10px 0;color:#757575;font-size:14px;">
                                <span>{{v.created_at}}</span>
                                <el-divider direction="vertical"></el-divider>
                                <span>{{v.address.contact_name}}</span>
                                <el-divider direction="vertical"></el-divider>
                                <span>订单号：{{v.no}}</span>
                                <el-divider direction="vertical"></el-divider>
                                <span>在线支付</span>
                                <span style="float:right;">应付金额： <span style="font-size: 18px;color:#333;">{{v.total_amount}}</span> 元</span>
                            </div>
                        </div>
                        <div class="bd" style="border-top:1px solid #FFE495;padding:20px;" >
                            <el-row>
                                <el-col :span="20">
                                    <ul>
                                        <li v-for="(item,j) in v.order_items">
                                            <el-row>
                                                <el-col :span="4">
                                                    <div class="img">
                                                        <img :src="item.product.img_url" alt="" width="80" height="80px;">
                                                    </div>
                                                </el-col>
                                                <el-col :span="20">
                                                    <div class="title-price" style="font-size:14px;color:#757575;">
                                                        <p>{{item.product.title}} {{item.product_sku.title}}</p>
                                                        <p>{{item.price}}元 × {{item.amount}}</p>
                                                    </div>
                                                </el-col>
                                            </el-row>
                                        </li>
                                    </ul>
                                </el-col>
                                <el-col :span="4" style="text-align:center">
                                    <div v-if="!v.closed">
                                        <el-button style="width:100%;margin-top:10px;" type="warning" size="mini" @click="nowBuy(v.id)" v-if="!v.paid_at">立即付款</el-button>
                                        <el-button style="width:100%;margin-top:10px;margin-left:0px;" type="warning" size="mini" @click="nowBuy(v.id)" v-if="v.paid_at">申请退款</el-button>
                                        <el-button style="width:100%;margin-top:10px;" type="warning" size="mini" @click="review(v.id)" v-if="v.ship_status==='received' && !v.reviewed">去评价</el-button>
                                        <el-button style="width:100%;margin-top:10px;" type="warning" size="mini" @click="received(v.id)" :id="'btn'+v.id" v-if="v.ship_status==='delivered'">确认收货</el-button>
                                        <el-button style="width:100%;margin-top:10px;margin-left:0" type="info" size="mini" @click="orderDetail(v.id,v.user_id)">订单详情</el-button>
                                        <el-button style="width:100%;margin-top:10px;margin-left:0" type="info" size="mini">联系客服</el-button>
                                     </div>
                                </el-col>
                                <div style="clear:both"></div>
                            </el-row>
                        </div>
                    </div>
                    </div>
                </el-tab-pane>
                <el-tab-pane label="待收货" name="third">
                    <div class="third">
                    <div class="order-list" style="border:1px solid #ff6700" v-for="(v,k) in unreceivedList" >
                        <div class="hd" style="background:#fffaf7;padding:20px;">
                            <div class="title" style="color:#ff6700">{{v.paid_at?'已付款':'未付款'}}-》{{v.ship_status==='pending'?'未发货':''}}{{v.ship_status==='delivered'?'已发货':''}}{{v.ship_status==='received'?'已收货':''}}</div>
                            <div class="info" style="margin:10px 0;color:#757575;font-size:14px;">
                                <span>{{v.created_at}}</span>
                                <el-divider direction="vertical"></el-divider>
                                <span>{{v.address.contact_name}}</span>
                                <el-divider direction="vertical"></el-divider>
                                <span>订单号：{{v.no}}</span>
                                <el-divider direction="vertical"></el-divider>
                                <span>在线支付</span>
                                <span style="float:right;">应付金额： <span style="font-size: 18px;color:#333;">{{v.total_amount}}</span> 元</span>
                            </div>
                        </div>
                        <div class="bd" style="border-top:1px solid #FFE495;padding:20px;" >
                            <el-row>
                                <el-col :span="20">
                                    <ul>
                                        <li v-for="(item,j) in v.order_items">
                                            <el-row>
                                                <el-col :span="4">
                                                    <div class="img">
                                                        <img :src="item.product.img_url" alt="" width="80" height="80px;">
                                                    </div>
                                                </el-col>
                                                <el-col :span="20">
                                                    <div class="title-price" style="font-size:14px;color:#757575;">
                                                        <p>{{item.product.title}} {{item.product_sku.title}}</p>
                                                        <p>{{item.price}}元 × {{item.amount}}</p>
                                                    </div>
                                                </el-col>
                                            </el-row>
                                        </li>
                                    </ul>
                                </el-col>
                                <el-col :span="4" style="text-align:center">
                                    <div v-if="!v.closed">
                                        <el-button style="width:100%;margin-top:10px;" type="warning" size="mini" @click="nowBuy(v.id)" v-if="!v.paid_at">立即付款</el-button>
                                        <el-button style="width:100%;margin-top:10px;" type="warning" size="mini" @click="review(v.id)" v-if="v.ship_status==='received'">去评价</el-button>
                                        <el-button style="width:100%;margin-top:10px;" type="warning" size="mini" @click="received(v.id)" :id="'btn'+v.id" v-if="v.ship_status==='delivered'">确认收货</el-button>
                                        <el-button style="width:100%;margin-top:10px;margin-left:0" type="info" size="mini" @click="orderDetail(v.id,v.user_id)">订单详情</el-button>
                                        <el-button style="width:100%;margin-top:10px;margin-left:0" type="info" size="mini">联系客服</el-button>
                                    </div>
                                </el-col>
                                <div style="clear:both"></div>
                            </el-row>
                        </div>
                    </div>
                    </div>
                </el-tab-pane>
                <el-tab-pane label="待评价" name="fore">
                    <div class="third">
                        <div class="order-list" style="border:1px solid #ff6700" v-for="(v,k) in unreviewList" >
                            <div class="hd" style="background:#fffaf7;padding:20px;">
                                <div class="title" style="color:#ff6700">{{v.paid_at?'已付款':'未付款'}}-》{{v.ship_status==='pending'?'未发货':''}}{{v.ship_status==='delivered'?'已发货':''}}{{v.ship_status==='received'?'已收货':''}}</div>
                                <div class="info" style="margin:10px 0;color:#757575;font-size:14px;">
                                    <span>{{v.created_at}}</span>
                                    <el-divider direction="vertical"></el-divider>
                                    <span>{{v.address.contact_name}}</span>
                                    <el-divider direction="vertical"></el-divider>
                                    <span>订单号：{{v.no}}</span>
                                    <el-divider direction="vertical"></el-divider>
                                    <span>在线支付</span>
                                    <span style="float:right;">应付金额： <span style="font-size: 18px;color:#333;">{{v.total_amount}}</span> 元</span>
                                </div>
                            </div>
                            <div class="bd" style="border-top:1px solid #FFE495;padding:20px;" >
                                <el-row>
                                    <el-col :span="20">
                                        <ul>
                                            <li v-for="(item,j) in v.order_items">
                                                <el-row>
                                                    <el-col :span="4">
                                                        <div class="img">
                                                            <img :src="item.product.img_url" alt="" width="80" height="80px;">
                                                        </div>
                                                    </el-col>
                                                    <el-col :span="20">
                                                        <div class="title-price" style="font-size:14px;color:#757575;">
                                                            <p>{{item.product.title}} {{item.product_sku.title}}</p>
                                                            <p>{{item.price}}元 × {{item.amount}}</p>
                                                        </div>
                                                    </el-col>
                                                </el-row>
                                            </li>
                                        </ul>
                                    </el-col>
                                    <el-col :span="4" style="text-align:center">
                                        <div v-if="!v.closed">
                                            <el-button style="width:100%;margin-top:10px;" type="warning" size="mini" @click="nowBuy(v.id)" v-if="!v.paid_at">立即付款</el-button>
                                            <el-button style="width:100%;margin-top:10px;margin-left:0px;" type="warning" size="mini" @click="nowBuy(v.id)" v-if="v.paid_at">申请退款</el-button>
                                            <el-button style="width:100%;margin-top:10px;" type="warning" size="mini" @click="review(v.id)" v-if="v.ship_status==='received' && !v.reviewed">去评价</el-button>
                                            <el-button style="width:100%;margin-top:10px;" type="warning" size="mini" @click="received(v.id)" :id="'btn'+v.id" v-if="v.ship_status==='delivered'">确认收货</el-button>
                                            <el-button style="width:100%;margin-top:10px;margin-left:0" type="info" size="mini" @click="orderDetail(v.id,v.user_id)">订单详情</el-button>
                                            <el-button style="width:100%;margin-top:10px;margin-left:0" type="info" size="mini">联系客服</el-button>
                                        </div>
                                    </el-col>
                                    <div style="clear:both"></div>
                                </el-row>
                            </div>
                        </div>
                    </div>
                </el-tab-pane>
            </el-tabs>
        </div>
    </div>

</template>

<script>
import DateUtils from "../../../utils/DateUtils";
    export default {
        data(){
            return {
                // 标题
                title:'个人中心-我的订单',
                activeName:'first',
                // 所有有效订单列表
                orderList:[],
                // 待支付订单列表
                unpaidList:[],
                // 待收货订单列表
                unreceivedList:[],
                // 待评价
                unreviewList:[],
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
            // 立即购买
            nowBuy(oid){
                location.href='/buy/confirm?id='+oid;
            },
            orderDetail(orderId,uid){
                location.href='/users/'+uid+'/personal/orderDetail?id='+orderId;
            },
            disFavoriteProduct(id){
                console.log(id);
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
            // 所有有效订单
            this.orderList=JSON.parse(this.user).orders.filter((i)=>{
                if(!i.closed){
                    i.created_at=DateUtils.utc2beijing(i.created_at);
                    return i;
                }
            });
            // 待付款订单
            this.unpaidList=JSON.parse(this.user).orders.filter((i)=>{
                i.created_at=DateUtils.utc2beijing(i.created_at);
                if(!i.closed && !i.paid_at){
                    return i;
                }
            });
            // 待收货订单
            this.unreceivedList=JSON.parse(this.user).orders.filter((i)=>{
                i.created_at=DateUtils.utc2beijing(i.created_at);
                if(!i.closed && i.paid_at && i.ship_status==='delivered'){
                    return i;
                }
            });
            // 待评价
            this.unreviewList=JSON.parse(this.user).orders.filter((i)=>{
                i.created_at=DateUtils.utc2beijing(i.created_at);
                if(!i.reviewed && !i.closed && i.paid_at && i.ship_status==='received'){
                    return i;
                }
            });
        }
    }
</script>
