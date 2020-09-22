<style>
    .register-form{
        width:332px;
        margin:0 auto;
    }
</style>
<template>
    <div class="register-form" >
        <el-form ref="RegisterRef" :model="registerData" :rules="registerRules" >
            <div class="sendPhoneCode" v-show="step===1">
                <el-form-item label="国家/地区 -  目前只支持中国地区">
                     <el-input value="中国" :disabled="true"></el-input>
                </el-form-item>
                <el-form-item prop="phone" label="手机号码" :error="Err.phoneErr">
                    <el-input v-model="registerData.phone">
                        <span slot="prepend"> + 86</span>
                    </el-input>
                </el-form-item>
                <el-form-item>
                    <el-button type="warning" style="width:100%;" @click="sendPhoneCode('RegisterRef')">立即注册</el-button>
                </el-form-item>
            </div>
            <div class="phoneCode" v-show="step===2">
                <p>请输入短信中的验证码</p>
                <el-form-item prop="phoneCode" style="margin-top:10px;" :error="Err.phoneCodeErr">
                    <el-input placeholder="请输入验证码" v-model="registerData.phoneCode">
                        <template slot="append"><el-button @click="sendPhoneCodeRequest">{{timerConfig.lastTimeContent}}</el-button></template>
                    </el-input>
                </el-form-item>
                <a href="">收不到验证码？</a>
                <el-form-item>
                    <el-button type="warning" style="width:100%" @click="validatePhoneCode('RegisterRef')">下一步</el-button>
                </el-form-item>
                <el-form-item>
                    <el-button @click="goBack()" style="width:100%;">返回</el-button>
                </el-form-item>
            </div>
            <div class="register" v-show="step===3">
                    <p>请设置密码</p>
                    <el-form-item prop="password" style="margin-top:10px;" :error="Err.passwordErr">
                        <el-input type="password" placeholder="请输入密码" v-model="registerData.password"></el-input>
                    </el-form-item>
                    <el-form-item  prop="repassword" style="margin-top:10px;" :error="Err.repasswordErr">
                        <el-input type="password" placeholder="请输入密码" v-model="registerData.repassword"></el-input>
                    </el-form-item>
                    <el-form-item>
                        <el-button type="warning" style="width:100%;" @click="finishRegister('RegisterRef')">完成注册</el-button>
                    </el-form-item>
            </div>
        </el-form>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                registerData:{
                    phone:null,
                    phoneCode:null,
                    password:null,
                    repassword:null,
                    phoneCodeKey:null,
                },
                registerRules:{
                    phone:[
                        {required:true,message:'请输入手机号码',trigger:'blur'}
                    ],
                    phoneCode:[
                        {required:true,message:'请输入验证码',trigger:'blur'}
                    ],
                    password:[
                        {required:true,message:'请输入密码',trigger:'blur'}
                    ],
                    repassword:[
                        {required:true,message:'请再次输入密码',trigger:'blur'}
                    ],
                },
                Err:{
                    phoneErr:null,
                    phoneCodeErr:null,
                    passwordErr:null,
                    repasswordErr:null,

                },
                step:1,
                timerConfig:{
                    lastTimeContent:'发送验证码',
                    lastTime:60,
                },
                timer:null,
            }
        },
        methods:{
            sendPhoneCode(refName){
                let _this=this;
                this.Err.phoneErr=null;
                this.$refs[refName].validateField('phone',function(err){
                    if(err){
                        console.log(err);
                    }else{
                        _this.sendPhoneCodeRequest();
                    }
                })
            },
            finishRegister(refName){
                let _this=this;
                this.Err.passwordErr=null;
                this.Err.repasswordErr=null;
                if(this.registerData.password=='' || this.registerData.repassword==''){
                    this.$refs[refName].validateField('password');
                    this.$refs[refName].validateField('repassword');
                }else{
                    axios.post('register',{phone:_this.registerData.phone,password:_this.registerData.password,repassword:_this.registerData.repassword}).then(function(res){
                       location.reload();
                    }).catch(function(err){
                        if(err.response.status===422 && err.response.data.errors.password){
                            _this.Err.passwordErr=err.response.data.errors.password[0];
                        }
                        if(err.response.status===422 && err.response.data.errors.repassword){
                            _this.Err.repasswordErr=err.response.data.errors.repassword[0];
                        }
                    });
                }
            },
            sendPhoneCodeRequest(){
                let _this=this;
                axios.post('/sendPhoneCode',{phone:this.registerData.phone}).then(function(res){
                    _this.step=2;
                    _this.registerData.phoneCodeKey=res.data.key;
                    _this.sendPhoneCodeTimer();
                }).catch(function(err){
                    console.log(err.response);
                    // 422后端表单错误
                    if(err.response.status===422 && err.response.data.errors.phone){
                        _this.Err.phoneErr=err.response.data.errors.phone[0];
                    }
                })
            },
            goBack(){
                this.step=1;
                this.timerConfig.lastTimeContent='发送验证码';
                window.clearInterval(this.timer);
            },
            // 发送验证码倒计时
            sendPhoneCodeTimer(){
                if(this.timerConfig.lastTimeContent == '发送验证码' || this.timerConfig.lastTimeContent == '重新发送') {
                    let lastTime = this.timerConfig.lastTime;
                    this.timer = setInterval(() => {
                        if (lastTime > 0) {
                            this.timerConfig.lastTimeContent = lastTime + 's重新发送';
                            lastTime--;
                        } else {
                            window.clearInterval(this.timer);
                            this.timerConfig.lastTimeContent = '重新发送'
                        }
                    }, 1000);
                }
            },
            validatePhoneCode(refName){
                this.Err.phoneCodeErr=null;
                let _this=this;
                this.$refs[refName].validateField('phoneCode',errmsg=>{
                    if(errmsg){
                        return false;
                    }else{
                        axios.post('/validatePhoneCode',{phoneCode:this.registerData.phoneCode,phoneCodeKey:this.registerData.phoneCodeKey}).then(function(res){
                            _this.step=3;
                        }).catch(function(err){
                            console.log(err.response);
                            if(err.response.status===401){
                                _this.Err.phoneCodeErr=err.response.data.errmsg;
                            }
                            if(err.response.status===403){
                                _this.Err.phoneCodeErr=err.response.data.errmsg;
                            }
                            if(err.response.status===422 && err.response.data.errors.phoneCodeKey){
                                _this.Err.phoneCodeErr=err.response.data.errors.phoneCodeKey[0];
                            }
                            if(err.response.status===422 && err.response.data.errors.phoneCode){
                                _this.Err.phoneCodeErr=err.response.data.errors.phoneCode[0];
                            }
                        });
                    }
                });
            },

        },
        mounted() {
            console.log('组件加载完毕.')
        }
    }
</script>
