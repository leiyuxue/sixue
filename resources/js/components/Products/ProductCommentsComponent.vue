<style lang="scss" scoped>
.comments{
    background: #f5f5f5;
    padding-top:30px;
    .comment-top{
        background: #fff;
        padding:30px;
        .title{
            font-size:18px;
            color:#757575;
        }
        .btn{
            margin-top:20px;
            .el-button{
                margin-right:15px;
            }
        }
    }
    .comment-bd{
        margin-top:30px;
        .bd{
            margin-top:10px;
            .l{
                .comment-item{
                    background: #fff;
                    padding:30px;
                    margin-bottom: 10px;
                    .user-info{
                        .img{

                        }
                        .name-time{
                            .name{
                                font-size:16px;
                                color:#8d665a;
                            }
                            .time{
                                margin-top:10px;
                                color:#b0b0b0;
                                font-size:14px;
                            }
                        }
                    }
                    .comment-info{
                        padding-top:20px;
                        .content{
                            font-size: 16px;

                        }
                        .imgs{
                            margin-top:20px;
                            .img{
                                width:160px;
                                height:160px;
                                margin-right:8px;
                                float:left;
                                margin-bottom:8px;
                            }
                        }
                    }
                }
            }
            .r{
                background: #fff;
                padding:30px;
                .count{
                    font-size:14px;
                    color:#b0b0b0;
                    margin-bottom: 20px;
                    span{
                        font-size: 22px;
                        color:#ff6700
                    }
                }
            }
        }

    }
}
</style>
<template>
  <div class="comments">
      <div class="container">
          <div class="comment-top">
            <div class="title">
                大家认为
            </div>
              <div class="btn">
                  <el-button>全部(123456789)</el-button>
                  <el-button>手感好(123)</el-button>
                  <el-button>外观漂亮(789)</el-button>
                  <el-button>拍照漂亮(789)</el-button>
                  <el-button>屏幕舒服(789)</el-button>
                  <el-button>充电快(4567)</el-button>
              </div>
          </div>
          <div class="comment-bd">
              <div class="title">
                热门评价
              </div>
              <div class="bd">
                  <el-row :gutter="10">
                      <el-col :span="16">
                          <div class="l">
                              <div class="comment-item" v-for="(v,k) in comments" v-if="comments.length>0">
                                  <div class="user-info">
                                    <el-row>
                                        <el-col :span="2">
                                            <div class="img">
                                                <img :src="v.order.user.avatar" alt="" width="47" height="47">
                                            </div>
                                        </el-col>
                                        <el-col :span="20">
                                            <div class="name-time">
                                                <p class="name">{{v.order.user.phone}}</p>
                                                <p class="time">{{v.review_at}}</p>
                                            </div>
                                        </el-col>
                                        <el-col :span="2">
                                            <div class="rating" style="color:#ff6700">
                                                <i :class="v.rating_tip.icon" ></i><span style="margin-left:5px;">{{v.rating_tip.text}}</span>
                                            </div>
                                        </el-col>
                                    </el-row>
                                  </div>
                                  <div class="comment-info">
                                     <el-row>
                                         <el-col :span="2">&nbsp</el-col>
                                         <el-col :span="22">
                                             <div class="content">{{v.review}}</div>
                                             <div class="imgs">
                                                 <div class="img" v-for="(i,k) in v.order_item_review_img">
                                                     <el-image :src="i.url" alt="" style="width: 160px;height:160px;" :preview-src-list="v.order_item_review_img.map(img=>{return img.url})"></el-image>
                                                 </div>
                                             </div>
                                         </el-col>
                                     </el-row>
                                  </div>
                              </div>
                              <div class="comment-item" v-if="comments.length===0">
                                  <p style="text-align: center;">暂无评论</p>
                              </div>
                          </div>
                      </el-col>
                      <el-col :span="8">
                          <div class="r">
                              <p class="count"><span>{{productData.review_count}}</span>人购买满意</p>
                              <el-progress :text-inside="true" :stroke-width="20"  :percentage="ratingData" status="success"></el-progress>
                          </div>
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
            return {
                comments:{},
                productData:{},
                ratingData:0,
            }
        },
        props:['comments_data','product'],
        mounted() {
            this.comments=JSON.parse(this.comments_data);
            this.productData=JSON.parse(this.product);
            this.ratingData=this.productData.rating*20;
        }
    }
</script>
