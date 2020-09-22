<style lang="scss" scoped>
   ::v-deep .el-tabs__nav{
        font-size: 24px;
        background-color:#fff;
        width:100%;
       .el-tabs__active-bar{
           background-color:#fff;
       }
       #tab-account{
           width:50%;
           font-size:24px;
           text-align: center;
       }
       .el-tabs__item.is-active {
           color: #ff6700;
       }
       #tab-qr{
           width:50%;
           font-size:24px;
           text-align: center;
       }
       #tab-account:hover{
           color:#ff6700;
       }
       #tab-qr:hover{
           color:#ff6700;
       }
    }
    ::v-deep .el-tabs__header{
        padding:27px 0 24px;
    }
    ::v-deep .el-tabs{
        margin:0 30px;
    }
    ::v-deep .el-divider--horizontal{
        margin-top:20px;
    }
</style>

<template>
    <div class="login-form">
        <el-tabs v-model="activeName">
            <el-tab-pane name="account" label="账号登录">
                <el-form ref="loginRef" :model="loginForm" :rules="loginRules">
                    <el-form-item prop="account" :error="Err.accountErr">
                        <el-input v-model="loginForm.account" placeholder="邮箱/手机号码"></el-input>
                    </el-form-item>
                    <el-form-item prop="password" :error="Err.passwordErr">
                        <el-input v-model="loginForm.password" type="password" placeholder="请输入密码"></el-input>
                    </el-form-item>
                    <el-form-item>
                        <el-button type="warning" @click="login('loginRef')" style="width:100%;">登录</el-button>
                    </el-form-item>
                </el-form>
                <el-row>
                    <el-col :span="12">
                        <el-button type="text" style="color:#ff6700">手机短信登录/注册</el-button>
                    </el-col>
                    <el-col :span="12">
                        <el-button type="text" style="color:#333">立即注册</el-button>
                        <el-divider direction="vertical"></el-divider>
                        <el-button type="text" style="color:#333;">忘记密码？</el-button>
                    </el-col>
                </el-row>
                <div class="other" style="margin-top:50px;">
                    <el-divider direction="horizontal" >其他方式登录</el-divider>
                    <div class="other-icon" style="padding:10px 30px;">
                        <el-row>
                            <el-col :span="6"><el-button type="text" style="font-size: 24px;"><i class="fa fa-qq" aria-hidden="true"></i></el-button></el-col>
                            <el-col :span="6"><el-button type="text" style="font-size: 24px;"><i class="fa fa-weibo" aria-hidden="true"></i></el-button></el-col>
                            <el-col :span="6"><el-button type="text" style="font-size: 24px;"><i class="fa fa-weixin" aria-hidden="true"></i></el-button></el-col>
                            <el-col :span="6"><el-button type="text" style="font-size: 24px;"><i class="fa fa-alipay" aria-hidden="true"></i></el-button></el-col>
                        </el-row>
                    </div>
                </div>
            </el-tab-pane>
            <el-tab-pane name="qr" label="扫码登录">

            </el-tab-pane>
        </el-tabs>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                activeName:'account',
                // 登录表单数据
                loginForm:{
                    account:null,
                    password:null,
                },
                // 登录表单规则
                loginRules:{
                    account:[
                        {required:true,message:'请输入登录账号',trigger:'blur'},
                    ],
                    password:[
                        {required:true,message:'请输入密码',trigger:'blur'},
                    ],
                },
                // 后台返回错误
                Err:{
                    accountErr:null,
                    passwordErr:null,
                }
            }
        },
        methods:{
            login(refName){
                this.$refs[refName].validate(valid=>{
                    if(valid){
                        // 验证通过
                        let _this=this;
                       axios.post('/login',{account:this.loginForm.account,password:this.loginForm.password}).then(function(res){
                           location.reload();
                       }).catch(function(err){
                           console.log(err.response);
                           if(err.response.status==422 && err.response.data.errors.account){
                                _this.Err.accountErr=err.response.data.errors.account[0];
                           }
                           if(err.response.status==422 && err.response.data.errors.password){
                               _this.Err.passwordErr=err.response.data.errors.password[0];
                           }
                           if(err.response.status==500){
                               _this.$message.error('系统出错，请稍后重试');
                           }
                       });
                    }else{
                        // 验证失败
                        return false;
                    }
                })
            },
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
