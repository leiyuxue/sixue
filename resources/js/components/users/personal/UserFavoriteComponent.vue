<style lang="scss" scoped>
.favorite-box{
    padding:20px 48px;
    background:#fff;
    .favorite-hd{
        h3{
            color:#757575;
        }
    }
    .favorite-list{
        margin-top:20px;
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
</style>
<template>
    <div class="favorite-box">
        <div class="favorite-hd">
            <h3>我的喜欢</h3>
        </div>
        <div class="favorite-list">
            <ul>
                <li class="favorite-item" v-for="(v,k) in JSON.parse(user).favorite_products" :key="k">
                    <div class="favorite-img">
                        <a href="" class="favorite-img-link">
                            <img :src="v.img_url" alt="" width="200" height="200">
                        </a>
                    </div>
                    <p class="title"><a href="" class="favorite-title-link">{{v.title}}</a></p>
                    <p class="price">{{v.price}}元 <del>2099元</del></p>
                    <div class="favorite-actions">
                        <el-button size="mini" type="info" @click="disFavoriteProduct(v.id)">删除</el-button>
                        <el-button size="mini" type="warning" @click="goDetail(v.id)">查看详情</el-button>
                    </div>
                </li>

                <li style="clear: both"></li>
            </ul>
        </div>
    </div>
</template>

<script>

    export default {
        data(){
            return {
                // 标题
                title:'个人中心-我的喜欢',
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
        }
    }
</script>
