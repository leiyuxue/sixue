<style lang="scss" scoped>
    .carts{
        background:#f5f5f5;
        padding:38px 0;
        .carts_list{
            background:#fff;
            .list_hd{
                height:70px;
                line-height:70px;
                border-bottom:1px solid #ccc;
            }
            .list_bd{
                padding:14px 14px 0 0;
                .attr{
                    cursor:pointer;
                    text-align:center;
                    position:relative;
                    border:1px dashed #b0b0b0;
                    .edit_tag{
                        position:absolute;
                        top:0;
                        right:0;
                        font-size: 12px;
                        color:#b0b0b0;
                        height:15px;
                        display:none;
                        line-height:15px;
                    }
                    .attr_list{
                        position: absolute;
                        top:115px;
                        left:-1px;
                        z-index: 3;
                        background: #fff;
                        border:1px solid #b0b0b0;
                        font-size: 12px;
                        line-height:20px;
                        .el-tag{
                            float:left;
                            margin:5px 5px 5px 0;
                        }
                    }
                }
                .attr:hover{
                    border:1px #ff6700 dashed;
                    .edit_tag{
                        display:block;
                    }
                }
            }
        }
        .cart-bar{
            height:50px;line-height:50px;background:#fff;margin-top:20px;
            .el-link{
                float:left;margin-left:30px;
            }
            .cpro{
                float:left;margin-left:15px;font-size:14px;color:#757575;
                span{
                    color:#ff6700;
                }
            }
            .el-button{
                float:right;height:100%
            }
            .total{
                float:right;font-size:14px;color:#ff6700;margin-right:20px;
                span{
                    font-size:26px;
                }
            }
        }
    }
</style>
<template>
    <div class="carts">
        <div class="container">
            <div class="carts_list">
                <div class="list_hd">
                    <el-row>
                        <el-col :span="2" style="text-align:center"><el-checkbox  @change="checkedAll"  v-model="checkAll">全选</el-checkbox></el-col>
                        <el-col :span="2"> &nbsp</el-col>
                        <el-col :span="5">商品名称</el-col>
                        <el-col :span="4" style="text-align:center;">商品属性</el-col>
                        <el-col :span="3" style="text-align:center;">单价</el-col>
                        <el-col :span="3" style="text-align:center;">数量</el-col>
                        <el-col :span="3" style="text-align:center;">小计</el-col>
                        <el-col :span="2"  style="text-align:center;">操作</el-col>
                    </el-row>
                </div>
                <div class="list_bd">
                    <el-row :id="v.id" style="border-bottom:1px solid #ccc;padding:14px 0;line-height:115px;" v-for="(v,k) in cartData" :key="k">
                        <el-col :span="2" style="text-align:center;" >
                            <el-checkbox-group v-model="checkedArr" >
                                <el-checkbox ref="checkRef" :label="v.id" v-model="v.id"></el-checkbox>
                            </el-checkbox-group>
                        </el-col>
                        <el-col :span="2"  style="text-align:center;"><a :href="'/products/'+v.product_sku.product.id"><img :src="v.product_sku.product.img_url" style="vertical-align: middle" alt="" width="80" height="80"></a></el-col>
                        <el-col :span="5"  style="text-align:left;"><a :href="'/products/'+v.product_sku.product.id">{{v.product_sku.product.title}}</a></el-col>
                        <el-col :span="4" class="attr">{{v.product_sku.title}} <span class="edit_tag" @click="isShow(v.id,v.product_sku.id)">修改</span>
                            <el-card class="attr_list" shadow="hover" v-if="showAttr===v.id">
                                <div slot="header">
                                    <span>选择属性</span>
                                </div>
                                <el-tag  v-for="(i,j) in v.product_sku.product.skus" :key="j" :type="i.id===cartProductSkuId?'warning':'info'" @click="selectAttr(i.id)" >{{i.title}}</el-tag>
                                <div style="clear:both"></div>
                                <p style="line-height:30px;margin-top:10px;">
                                    <el-button size="mini" @click="updateAttr(v.id)" type="warning">确定</el-button>
                                    <el-button size="mini" @click="closeAttr">取消</el-button>
                                </p>
                            </el-card>
                        </el-col>
                        <el-col :span="3"  style="text-align:center;">{{v.product_sku.price}}元</el-col>
                        <el-col :span="3"  style="text-align:center;">
                            <el-input-number v-model="v.amount" controls-position="right" @change="upNum(v.id,v.amount)" :min="1" :max="10"></el-input-number>
                        </el-col>
                        <el-col :span="3"  style="text-align:center;">{{v.product_sku.price*v.amount}}元</el-col>
                        <el-col :span="2"  style="text-align:center;font-size:20px;">
                            <el-popconfirm title="确定删除吗？" @onConfirm="del(v.id)">
                                 <el-button icon="el-icon-close" type="danger" size="mini" circle slot="reference"></el-button>
                            </el-popconfirm>
                        </el-col>
                        <div style="clear: both"></div>
                    </el-row>
                </div>

            </div>
            <div class="cart-bar" >
                <el-link>继续购物</el-link>
                <el-divider direction="vertical" style="float:left;"></el-divider>
                <p class="cpro" style="">共 <span>{{formData.amount_count}}</span>件商品，已选择 <span>{{formData.select_count}}</span>件</p>
                <el-button type="warning" @click="checkBuy">去结算</el-button>
                <p class="total" >合计：<span>{{formData.total_price}}</span>元</p>
                <div style="clear: both"></div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                checkAll:false, //全选的默认选中状态
                checkedArr:[], //列表选中的数组，存放的是id
                cartData:JSON.parse(this.carts), // 购物车数据
                // 收货地址
                addressesData:JSON.parse(this.addresses),
                formData:{
                    amount_count:0,
                    select_count:0,
                    total_price:0,
                },
                // 默认选中的sku
                cartProductSkuId:null,
                showAttr:null,
            }
        },
        mounted() {
        },
        created() {
            this.computeAmountCount();
        },
        computed:{
        },
        watch:{
            checkedArr(){
                if(this.checkedArr.length==this.cartData.length){
                    this.checkAll=true;
                }else{
                    this.checkAll=false;
                }
                this.formData.select_count=0;
                this.formData.total_price=0;
                console.log(this.checkedArr);
                if(this.checkedArr.length>0){
                    // 获取cart商品总数量
                    this.computeSelectCount();
                    this.computeTotalPrice();
                }else{
                    this.formData.select_count=0;
                    this.formData.total_price=0;
                }

            }
        },
        props:['carts','addresses'],
        methods:{
            isShow(cid,sid){
                if(this.showAttr){
                    this.closeAttr();
                }else{
                    this.showAttr=cid;
                    this.cartProductSkuId=sid;
                }

            },
            selectAttr(sid){
                this.cartProductSkuId=sid;
            },
            closeAttr(){
                this.showAttr=null;
            },
            updateAttr(cid){
                let _this=this;
                axios.post('/update_attr/'+cid,{sid:this.cartProductSkuId}).then(function(res){
                    _this.cartData=res.data;
                    _this.$message('操作成功');
                    _this.closeAttr();
                },function(err){

                });
            },
            checkBuy(){
                if(this.checkedArr.length==0){
                    this.$message({
                        type:'error',
                        message:'请选择要购买的商品'
                    });
                }else{
                    let r=this.checkedArr.join('.');
                    location.href='/cart/checkout?r='+r;
                }

            },
            computeSelectCount(){
                this.cartData.forEach((item)=>{
                    if(this.checkedArr.indexOf(item.id)>=0){
                        this.formData.select_count+=item.amount;
                    }
                });
            },
            computeAmountCount(){
                this.cartData.forEach((item)=>{
                    this.formData.amount_count+=item.amount;
                });
            },
            computeTotalPrice(){
                this.checkedArr.forEach((item)=>{
                    this.cartData.forEach((v)=>{
                        if(item==v.id){
                            this.formData.total_price+=v.amount*v.product_sku.price;
                        }
                    });
                });
            },
            upNum(id,num){
                let _this=this;
                axios.put("/update_amount/"+id,{num:num}).then(function(res){
                    _this.formData.amount_count=0;
                    _this.formData.select_count=0;
                    _this.formData.total_price=0;
                    _this.computeAmountCount();
                    _this.computeSelectCount();
                    _this.computeTotalPrice();
                },function(err){
                    console.log(err.response);
                });
            },
            checkedAll(){
                if(this.checkAll){
                    this.checkedArr=[];
                    this.cartData.forEach((v)=>{
                        this.checkedArr.push(v.id);
                    });
                }else{
                    this.checkedArr=[];
                }
            },
            del(id){
                let _this=this;
                axios.delete('/del/'+id).then(function(res){
                    _this.cartData.forEach((ii)=>{
                        if(ii.id==id){
                            let j=_this.cartData.indexOf(ii);
                            _this.cartData.splice(j,1);
                        }
                    });

                   if(_this.checkedAll){
                      let index=_this.checkedArr.indexOf(id);
                      _this.checkedArr.splice(index,1);
                   }
                    $('#'+id).remove();
                    _this.formData.amount_count=0;
                    _this.formData.select_count=0;
                    _this.formData.total_price=0;
                    _this.computeAmountCount();
                    _this.computeSelectCount();
                    _this.computeTotalPrice();
                    _this.$message({
                        type:'success',
                        message:'删除成功',
                    });
                },function(err){
                    console.log(err.response);
                });
            },
        },
    }
</script>
