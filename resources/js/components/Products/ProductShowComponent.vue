<style lang="scss" scoped>
    .detail{
        .product-data{
            padding:20px;
            .title{
                text-align:left;
                font-size:24px;
                font-weight:400;
                color:#212121;
            }
            .price{
                margin-top:20px;
                font-size:18px;
                color:#ff6700;
            }
            .price1{
                color:#fff;background:#ff6700;padding:10px;
                .time{
                    font-size:14px;
                    margin-top:15px;
                    text-align:right;
                    span{
                        padding:3px;
                        background:#f1393a;
                    }
                }
            }
            .skus{
                margin-top:20px;
                .skus-key{
                    font-size:18px;
                }
                .skus-box{
                    margin-top:30px;
                    .skus-list{
                        list-style:none;
                        display:block;
                        li{
                            cursor:pointer;
                        }
                        li:hover{
                            color:#ff6700;
                            border:1px solid #ff6700!important;
                        }
                        .active{
                            color:#ff6700;
                            border:1px solid #ff6700!important;
                        }
                        li:nth-child(odd){
                            float:left;width:280px;height:42px;line-height:42px;border:1px solid #ccc;text-align:center;font-size:16px;
                            margin-top:10px;
                        }
                        li:nth-child(even){
                            float:right;width:280px;height:42px;line-height:42px;border:1px solid #ccc;text-align:center;font-size:16px;
                            margin-right:0;margin-top:10px;
                        }
                    }
                }
                .select-info{
                    background: #f9f9fa;
                    padding: 30px;
                    margin-bottom: 30px;
                    margin-top:30px;
                    .title-price{
                        font-size:12px;
                        color:#616161;
                        line-height:30px;
                        height:30px;
                        .select-price{
                            float:right;
                            font-size:14px;

                        }
                    }
                    .total-price{
                        font-size:24px;
                        color:#ff6700;
                        padding-top:20px;
                    }
                }
            }
        }
        .el-image{
            width:613px;height:606px;
        }
    }
</style>
<template>
    <div class="detail">
        <div class="container">
            <el-row>
                <el-col :span="12">
                    <el-carousel :interval="5000" arrow="always" height="606px" :initial-index="initialIndex" ref="carousel">
                        <el-carousel-item v-for="(item,key) in product1.skus" :key="key" >
                            <el-image :src="item.img_url"></el-image>
                        </el-carousel-item>
                    </el-carousel>
                </el-col>
                <el-col :span="12">
                    <div class="product-data">
                        <div class="title">{{product1.long_title?product1.long_title:product1.title}}</div>
                        <div class="price" v-if="!product1.seckill_time">{{active_sku.price}}元 <del style="font-size:14px;color:#b0b0b0">2099元</del></div>
                        <div class="price1" v-if="product1.seckill_time">
                            <el-row >
                                <el-col :span="16">
                                    <p>秒杀价：{{active_sku.price}}元</p>
                                    <p><del style="font-size:14px;">市场价：2099元</del></p>
                                </el-col>
                                <el-col :span="8">
                                    <count-down inline-template :data1="product1.seckill_time">
                                        <div class="time">
                                         {{count_down.title}} <span>{{count_down.h}}</span>: <span>{{count_down.m}}</span> : <span>{{count_down.s}}</span>
                                        </div>
                                    </count-down>
                                </el-col>
                            </el-row>

                        </div>
                        <div class="skus" >
                            <div class="skus-key">选择</div>
                            <div class="skus-box">
                                <ul class="skus-list" >
                                    <li v-for="(v,k) in product1.skus" :key="k" :class="[v.id===active_sku.id?'active':'']" @click="select_sku(v.id)">{{v.title}}</li>
                                    <div style="clear:both;"></div>
                                </ul>
                            </div>
                            <div class="select-info">
                                <p class="title-price">{{product1.title}} {{active_sku.title}}<span class="select-price">{{active_sku.price}}元 <del>2099元</del> </span></p>
                                <p class="total-price">总计：{{active_sku.price}}元 </p>
                            </div>
                            <div class="cart-link-btn">
                                <el-button type="warning" style="width:50%;" @click="addCart" v-if="is_login" :disabled="!is_buy" >加入购物车</el-button>
                                <el-button type="warning" style="width:50%;" @click="login" v-if="!is_login" >登录购买</el-button>
                                <el-button type="info" @click="favoriteProduct" v-if="!f1">❤ 喜欢</el-button>
                                <el-button type="info" @click="disfavoriteProduct" v-if="f1">取消喜欢</el-button>
                            </div>
                        </div>
                    </div>
                </el-col>
            </el-row>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                initialIndex:2,
                product1:JSON.parse(this.product),
                active_sku:{},
                f1:this.favored,
                is_buy:true,
            }
        },
        props:['product','favored','is_login'],
        mounted() {
            let _this=this;
            this.product1.skus.map(function(sku) {
               if(sku.price===_this.product1.price){
                   _this.active_sku=sku;
               }
           });
        },
        computed:{

        },
        methods:{

            login(){
                location.href='/login';
            },
            // 选择单品
            select_sku(id){
                let _this=this;
                this.product1.skus.map(function(sku,i) {
                    if(sku.id===id){
                        _this.$refs['carousel'].setActiveItem(i);
                        _this.active_sku=sku;
                    }
                });

            },
            // 加入购物车
            addCart(){
                let _this=this;
                axios.post('/addCart',{amount:1,product_sku_id:this.active_sku.id}).then(function(res){
                    _this.$message({
                        type:'success',
                        message:'操作成功'
                    });
                    location.href='/addCartSuccess/'+res.data.id;
                },function(err){
                    console.log(err.response);
                    if(err.response.status===401){
                        _this.$message({
                            type:'error',
                            message:'请先登录后操作'
                        });
                    }
                });
            },
            favoriteProduct(){
                let _this=this;
                axios.post('/products/'+this.product1.id+'/favor').then(function(){
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
            disfavoriteProduct(){
                let _this=this;
                axios.delete('/products/'+this.product1.id+'/favor').then(function(){
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
        },
    }
</script>
