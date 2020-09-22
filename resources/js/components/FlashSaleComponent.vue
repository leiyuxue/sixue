<style lang="scss" scoped>
    .flash_sale_hd{
        height:58px;
        line-height:58px;
        .title{
            font-weight:200;
            line-height:58px;
            color:#333;
        }
    }
    .flash_sale_bd{
        text-align: center;
        height:340px;
        position:relative;
        .flash_sale_time{
            width:234px;
            height:300px;
            background:#f1eded;
            padding-top:39px;
            border-top:1px solid #e53935;
            text-align: center;
            float:left;
            position:relative;
            .round{
                text-align: center;
                color:#e53935;
                font-size:21px;
                padding-top:15px;
            }
            img{
                margin:25px auto;
            }
            .desc{
                text-align:center;
                font-size:15px;
                color:#b0b0b0
            }
           ::v-deep .time{
                margin:28px auto 0;
                width:168px;
                span{
                    width:46px;
                    height:46px;
                    font-size:24px;
                    line-height:46px;
                    background:#605751;
                    color:#fff;
                    float:left;
                }
                i{
                    height:46px;
                    width:15px;
                    font-size:28px;
                    line-height:46px;
                    float:left;
                    font-style:normal;
                    color:#605751
                }
            }
        }
        .switch-btn{
            position:absolute;
            top:-30px;
            right:0;
        }

    }
    .seamless-warp2 {
        overflow: hidden;
        height: 340px;
        width: 992px;
        float:left;
        ul.item {
            width: 580px;
            li {
                width:234px;
                border-top:1px solid red;
                margin-left:14px;
                float:left;
                height:340px;
                background:#fff;
                .img{
                    width:160px;
                    margin:39px auto 22px;
                }
                .title{
                    margin:0 20px 3px;
                    overflow: hidden;
                    white-space: nowrap;
                    text-overflow: ellipsis;
                    color:#212121;
                    font-size:14px;
                }
                .desc{
                    height:18px;
                    margin:0 20px 12px;
                    overflow:hidden;
                    white-space:nowrap;
                    text-overflow:ellipsis;
                    color:#b0b0b0;
                    font-size:12px;
                }
                .price{
                    color:#ff6700;
                    margin:0;
                    font-size:12px;
                    del{
                        color:#b0b0b0;
                    }
                }
            }
        }
    }
</style>
<template>
    <div class="container">
        <div class="flash_sale_hd">
            <h2 class="title">小米闪购</h2>
        </div>
        <div class="flash_sale_bd">
            <div class="flash_sale_time">
                <div class="round">{{seckillsData.start_at.slice(0,5)}} 场</div>
                <img src="/images/flash.jpg" alt="">
                <div class="desc">距离结束还有</div>
                <count-down :data1="seckillsData" inline-template>
                    <div class="time">
                        <span class="hour">{{count_down.h}}</span><i>:</i>
                        <span class="minute">{{count_down.m}}</span><i>:</i>
                        <span class="second">{{count_down.s}}</span>
                    </div>
                </count-down>
            </div>
            <vue-seamless-scroll :data="seckillsData.products" :class-option="optionLeft" class="seamless-warp2" >
                <span slot="left-switch" class="left-arrow">left</span>
                <span slot="right-switch" class="right-arrow">right</span>
                <ul class="item" :style="ulWidth" >
                    <li v-for="(item,key) in seckillsData.products" :key="key">
                        <a href="/seckill">
                            <div class="img">
                                <img :src="item.img_url" alt="" width="160" height="160">
                            </div>
                            <div class="title">{{item.title}}</div>
                            <p class="desc" v-html="item.description"></p>
                            <p class="price">
                                <span>{{item.price}}元</span>
                                <del>1449元</del>
                            </p>
                        </a>
                    </li>
                </ul>
            </vue-seamless-scroll>
        </div>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                seckillsData:JSON.parse(this.seckills),
            }
        },
        props:['seckills'],
        computed: {
            ulWidth(){
                return {
                    width:Object.keys(this.seckillsData).length*248+'px',
                    listStyle:'none',
                };
            },
            optionLeft () {
                return {
                    direction: 2,//横向向左移动
                    limitMoveNum: 3, //数据的最小长度，满足才可以滑动
                    hoverStop:true, //鼠标滑过是否停顿
                    singleWidth:248, //移动的宽度/单位时间
                    waitTime:3000, //移动停顿时间
                    step:10, //单位时间移动的速度
                    switchSingleStep: 100,
                    switchDelay: 200,
                    autoPlay:true,
                }
            }
        },
        mounted() {
        },
        created(){
        },
        methods: {
        }
    }
</script>
