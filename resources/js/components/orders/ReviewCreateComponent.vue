<style lang="scss" scoped>
    .review{
        background:#f5f5f5;
    }
</style>
<template>
    <div class="review">
        <div class="container">
            <div class="review-box" style="padding:30px;">
                <div class="hd" style="height:30px;line-height: 30px;">
                    订单评价
                </div>
                <div class="bd" style="margin-top:20px;background: #fff;padding:30px;">
                    <div class="order-item" v-for="(v,k) in formData">
                        <el-divider></el-divider>
                        <div class="order-item-info" style="padding:30px;border:1px solid #ff6700">
                            <el-row>
                                <el-col :span="2">
                                    <div class="img">
                                        <img :src="v.product_sku.product.img_url" alt="" width="80" height="80">
                                    </div>
                                </el-col>
                                <el-col :span="19">
                                    <div class="info" style="margin-top:30px;">
                                        {{v.product_sku.product.title}} {{v.product_sku.title}}
                                    </div>
                                </el-col>
                                <el-col :span="3">
                                    <el-button size="mini" style="margin-top:30px;" @click="orderDetail(orderData.id)">查看订单</el-button>
                                </el-col>
                            </el-row>
                        </div>
                        <div class="order-review" style="margin-top:20px;padding:30px;">
                            <el-form ref="formRef" :rules="formRules" :model="v">
                                <el-form-item prop="rating">
                                  <el-rate  show-text v-model="v.rating"></el-rate>
                                </el-form-item>
                                <el-form-item prop="review">
                                    <el-input type="textarea" v-model="v.review"></el-input>
                                    <div class="up-icon"></div>
                                </el-form-item>
                                <el-form-item>
                                    <el-upload
                                        class="upload-demo"
                                        :action="'/abc/?oid='+v.id"
                                        :on-preview="handlePreview"
                                        :on-remove="handleRemove"
                                        :file-list="v.order_item_review_img"
                                        :on-success="success"
                                        list-type="picture">
                                        <el-button size="small" type="primary">点击上传</el-button>
                                        <div slot="tip" class="el-upload__tip">只能上传jpg/png文件，且不超过500kb</div>
                                    </el-upload>
                                </el-form-item>
                            </el-form>

                        </div>
                    </div>

                    <el-divider></el-divider>
                    <el-button style="float:right" @click="addReview(orderData.id)">发表评价</el-button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                orderData:{},
                fileList:[],
                formData:JSON.parse(this.order).order_items,
                formRules:{
                    rating:[
                        {required:true,message:'请选择评分',trigger:'blur'}
                    ],
                    review:[
                        {required:true,message:'请填写评价内容',trigger:'blur'}
                    ],
                },
            }
        },
        mounted() {
            this.orderData=JSON.parse(this.order);
        },
        created() {
        },
        computed:{
        },
        watch:{

        },
        props:['order'],
        methods:{
            addReview(id){
                let _this=this;
                axios.post('/orders/'+id+'/review',{reviews:this.formData}).then(function(res){
                    _this.$message('评论成功');
                    location.href='/comment/'+_this.orderData.id;
                },function(err){

                });
            },
            success(file){
                console.log(file);
                this.formData.forEach((i)=>{
                    if(i.id===file.order_item_id){
                        i.order_item_review_img.push(file);
                    }
                });

            },
            handleRemove(file, fileList) {
                console.log(file, fileList);
            },
            handlePreview(file) {
                console.log(file);
            },
            orderDetail(id){
                location.href='/users/'+this.orderData.user_id+'/personal/orderDetail?id='+id;
            },

        },
    }
</script>
