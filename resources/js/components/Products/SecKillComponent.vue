<style lang="scss" scoped>
    .hd{
        height:170px;
        background: url("/images/seckill-hd-bg.jpg") 50% 0 no-repeat;
        h1{
            text-indent: -9999px;
        }
    }
    .bd{
        .time{

        }
        ::v-deep .el-tabs__item{
            background:#414141;
            color:#fff;
            height:68px;
            width:20%;
            line-height:68px;
            text-align: center;
        }
        ::v-deep .is-active{
            background:#f1393a;
        }
        ::v-deep .el-tabs__active-bar{
            display:none;
        }
        ::v-deep .el-tabs__nav-wrap::after{
            display:none;
        }
        ::v-deep .el-tabs__nav{
            width:100%;
            height:68px;
        }
        ::v-deep .el-tabs__header{
            margin:-68px 0 15px;
            height:68px;
        }
        .pro{
            .list{
                list-style:none;
                margin-left:-13px;
                .item:hover{
                    transform: translate3d(0,-2px,0);
                    box-shadow: 0 15px 30px rgba(0,0,0,0.1);
                }
                .item{
                    width:400px;
                    height:190px;
                    background: #fff;
                    margin-left:13px;
                    margin-bottom:13px;
                    position:relative;
                    float:left;
                    .item-link{
                        text-decoration:none;
                        text-align:center;
                        position:absolute;
                        top:0;
                        left:0;
                        color:#757575;
                        .item-box{
                            .img{
                                width:190px;
                                height:190px;
                                background:#e9e9e9;
                                float:left;
                                display:block;
                            }
                            .con{
                                margin-left:30px;
                                padding-top:30px;
                                float:left;
                                display:block;
                                width:180px;
                                p{
                                    text-align:left;
                                }
                                .title{
                                    font-size:16px;
                                    color:#333;
                                    white-space:nowrap;
                                    overflow:hidden;
                                    text-overflow:ellipsis;
                                }
                                .desc{
                                    color:#b0b0b0;
                                    font-size:12px;
                                    white-space:nowrap;
                                    overflow:hidden;
                                    text-overflow:ellipsis;
                                    margin-top:7px;
                                }
                                .price{
                                    font-size:16px;
                                    color:#f1393a;
                                    white-space:nowrap;
                                    overflow:hidden;
                                    text-overflow:ellipsis;
                                    margin-top:14px;
                                    del{
                                        font-size:12px;
                                        color:#b0b0b0;
                                    }

                                }
                                .btn{
                                    margin-top:30px;
                                }
                            }
                        }
                    }
                }
            }
        }
    }
</style>
<template>
    <div class="container">
        <div class="hd">
            <h1>小米秒杀</h1>
        </div>
        <div class="bd">
                <el-tabs v-model="activeName" >
                    <el-tab-pane>
                        <div slot="label">
                            <span style="vertical-align: middle">{{activeSeckill.start_at.slice(0,5)}}</span>
                            <count-down :data1="activeSeckill" inline-template ref="time">
                                <span style="display:inline-block;vertical-align: middle;height:40px;line-height:1;text-align:left;margin-left:15px;">
                                    <span style="line-height: 20px;">抢购中<br/>
                                         <span>距离结束 {{count_down.h}}：{{count_down.m}}：{{count_down.s}}</span>
                                    </span>
                                </span>
                            </count-down>
                        </div>
                        <div class="pro">
                            <ul class="list">
                                <li class="item" v-for="(a,b) in activeSeckill.products" :key="b">
                                    <a :href="'products/'+a.id" class="item-link">
                                        <div class="item-box">
                                            <span class="img">
                                                <img :src="a.img_url" alt="" width="190" height="190">
                                            </span>
                                            <span class="con">
                                                <p class="title">
                                                    {{a.title}}
                                                </p>
                                                <p class="desc" v-html="a.description"></p>
                                                <p class="price">
                                                    {{a.price}}元
                                                    <del>299元</del>
                                                </p>
                                                <p class="btn">
                                                     <el-link type="warning" v-if="!is_login" href="/login">登录后抢购</el-link>
                                                    <el-button type="danger" size="mini" v-if="is_login">立即抢购</el-button>
                                                </p>
                                            </span>
                                        </div>
                                    </a>
                                </li>
                                <li style="clear:both;"></li>
                            </ul>
                        </div>
                    </el-tab-pane>
                    <el-tab-pane v-for="(i,k) in seckillsData" :key="k">
                        <div slot="label">{{i.start_at.slice(0,5)}} 即将开始</div>
                        <div class="pro">
                            <ul class="list">
                                <li class="item" v-for="(c,d) in i.products" :key="d">
                                    <a :href="'products/'+c.id" class="item-link">
                                        <div class="item-box">
                                            <span class="img">
                                                <img :src="c.img_url" alt="" width="190" height="190">
                                            </span>
                                            <span class="con">
                                                <p class="title">
                                                    {{c.title}}
                                                </p>
                                                <p class="desc" v-html="c.description"></p>
                                                <p class="price">
                                                    {{c.price}}元
                                                    <del>299元</del>
                                                </p>
                                                <p class="btn">
                                                    <el-button type="danger" size="mini" >活动未开始</el-button>
                                                </p>
                                            </span>
                                        </div>
                                    </a>
                                </li>
                                <li style="clear:both;"></li>
                            </ul>
                        </div>
                    </el-tab-pane>

                </el-tabs>

        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                activeName:'0',
                seckillsData:JSON.parse(this.seckills),
                activeSeckill:{
                    start_at:'',
                    end_at:'',
                },
            }
        },
        props:['seckills','is_login'],
        created() {
        },
        mounted() {
            this.activeItem()
        },
        methods:{
            // 去登陆
            login(){
                window.location.href='/login';
            },
            activeItem(){
                // 当前的时间戳
                let date=new Date();
                let nowStamp=date.getTime();
                this.$nextTick(function(){
                this.seckillsData.forEach((i,k)=>{
                    if(this.$refs.time.getStartStamp(i)<nowStamp && nowStamp<this.$refs.time.getEndStamp(i)){
                        this.activeSeckill=i;
                        this.seckillsData.splice(k,1);
                    }
                    });

                });
            },
        },
    }
</script>
