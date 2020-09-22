<style lang="scss" scoped>
.menu-list{
    list-style: none;
    width:73%;
    position:relative;
    .menu-item{
        float:left;
        text-align:center;
        height:44px;
        width:20%;
        position:relative;
        .current{
            color:#ff6700!important;
        }
        .link{
            color:#333;
            font-size: 14px;
            font-weight:bold;
            overflow:hidden;
            height:20px;
            line-height:20px;
            display:block;
        }
        .down{
            background: url('/images/down.png') 0 0 no-repeat;
            width:23px;
            height:12px;
            margin-top:13px;
            margin-bottom:-2px;
            display: inline-block;
            position:relative;
            z-index:3;
        }
        .link:hover{
            color:#ff6700;
        }
    }

}
.content{
    background: #fff;
    padding: 34px;
    border: 1px solid #e6e6e6;
    border-radius: 10px;
    min-height: 400px;
    position:relative;
    z-index:1;
    .security{
        margin:0;
        .title{
            padding-bottom:10px;
            h4{
                display:inline-block;
            }
            p{
                font-size:14px;
                display:inline-block;
                span{
                    font-size:20px;
                    font-weight:bold;
                    color:red;
                }
            }
            .el-progress{
                width:60%;
                display: inline-block;
            }

        }
        .edit-area{
            list-style: none;
            .security-item{
                i{
                    font-size: 25px;
                    color:#ff6700;
                    margin-top:10px;
                }
                .item-title{
                    display:block;
                    h4{
                        color:#555;
                        font-size: 16px;
                        display:inline-block;
                    }
                    .warning{
                        display:inline-block;
                        margin-left:10px;
                        font-size: 14px;
                        color:#ff6700;
                        i{
                            font-size:14px;
                        }
                    }
                }

                p{
                    display:block;
                    color:#9d9d9d;
                    font-size:14px;
                }
            }
        }
    }
}
</style>
<template>
    <div class="main-box">
        <div class="menu">
            <ul class="menu-list">
                <li class="menu-item">
                    <a href="/users/account/security" class="link" :class="[type==='security'?'current':'']">账号安全</a>
                    <span v-if="type==='security'" class="down"></span>
                </li>
                <li class="menu-item">
                    <a href="/users/account/profile" class="link" :class="[type==='profile'?'current':'']">个人信息</a>
                    <span v-if="type==='profile'" class="down"></span>
                </li>
                <li class="menu-item">
                    <a href="/users/account/sns" class="link" :class="[type==='sns'?'current':'']">绑定授权</a>
                    <span v-if="type==='sns'" class="down"></span>
                </li>
                <li class="menu-item">
                    <a href="/users/account/services" class="link" :class="[type==='services'?'current':'']">小米服务</a>
                    <span v-if="type==='services'" class="down"></span>
                </li>
                <li class="menu-item">
                    <a href="/users/account/device" class="link "  :class="[type==='device'?'current':'']">设备管理</a>
                    <span v-if="type==='device'" class="down"></span>
                </li>
                <li style="clear: both"></li>
            </ul>
        </div>
        <div class="content">
            <div class="security" v-if="type==='security'">
                <div class="title">
                    <h4>安全等级</h4>
                    <p><span>40</span>分</p>
                    <el-progress :percentage="50" status="warning"></el-progress>
                    <p>存在 <span>2</span> 项风险</p>
                </div>
                <el-divider></el-divider>
                <ul class="edit-area">
                    <li class="security-item">
                        <el-row>
                            <el-col :span="1">
                                <i class="el-icon-lock"></i>
                            </el-col>
                            <el-col :span="20">
                                <div class="item-title"><h4>账号密码</h4><div class="warning"> <i class="el-icon-warning"></i><span>未绑定</span></div></div>
                                <p>用于保护帐号信息和登录安全</p>
                            </el-col>
                            <el-col :span="3">
                                <el-button>修改</el-button>
                            </el-col>
                        </el-row>
                    </li>
                    <el-divider></el-divider>
                    <li class="security-item">
                        <el-row>
                            <el-col :span="1">
                                <i class="el-icon-message"></i>
                            </el-col>
                            <el-col :span="20">
                                <div class="item-title"><h4>安全邮箱</h4><div class="warning"> <i class="el-icon-warning"></i><span>未绑定</span></div></div>
                                <p>安全邮箱将可用于登录小米帐号和重置密码，建议立即设置</p>
                            </el-col>
                            <el-col :span="3">
                                <el-button>绑定</el-button>
                            </el-col>
                        </el-row>
                    </li>
                    <el-divider></el-divider>
                    <li class="security-item">
                        <el-row>
                            <el-col :span="1">
                                <i class="el-icon-mobile-phone"></i>
                            </el-col>
                            <el-col :span="20">
                                <div class="item-title"><h4>安全手机 185******05  </h4><div class="warning"> <i class="el-icon-warning"></i><span>未绑定</span></div></div>
                                <p>安全手机可以用于登录小米帐号，重置密码或其他安全验证</p>
                            </el-col>
                            <el-col :span="3">
                                <el-button>修改</el-button>
                            </el-col>
                        </el-row>
                    </li>
                    <el-divider></el-divider>
                    <li class="security-item">
                        <el-row>
                            <el-col :span="1">
                                <i class="el-icon-date"></i>
                            </el-col>
                            <el-col :span="20">
                                <div class="item-title"><h4>密保问题</h4><div class="warning"> <i class="el-icon-warning"></i><span>未设置</span></div></div>
                                <p>密保问题用于安全验证，建议立即设置</p>
                            </el-col>
                            <el-col :span="3">
                                <el-button>设置</el-button>
                            </el-col>
                        </el-row>
                    </li>
                </ul>
            </div>

            <div class="profile" v-if="type==='profile'">
                {{type}}
            </div>
            <div class="sns" v-if="type==='sns'">
                {{type}}
            </div>
            <div class="services" v-if="type==='services'">
                {{type}}
            </div>
            <div class="device" v-if="type==='device'" >
                {{type}}
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {

            }
        },
        props:['type'],
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
