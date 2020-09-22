<style lang="scss" scoped>
.address-box{
    padding:20px 48px;
    background:#fff;
    .address-hd{
        h3{
            color:#757575;
        }
    }
    .address-list{
        margin-top:20px;
        ul{
            list-style:none;
            display:block;
            .address-item{
                float:left;
                width:30%;
                margin:0 25px 30px 0;
                border:1px solid #ccc;
                height:180px;
                cursor:pointer;
                position:relative;
                .address-info{
                    padding:20px;
                    color:#757575;
                    font-size:14px;
                    .name-tag{
                        font-size:16px;
                        color:#333;
                        line-height:30px;
                        margin-bottom:10px;
                        .tag{
                            float:right;
                            font-size:14px;
                            color:#757575;
                        }
                    }
                    .phone{
                        line-height:22px;
                    }
                    .address-action{
                        position:absolute;
                        right:24px;
                        bottom:10px;
                        opacity:0;
                        a{
                            color:#ff6700!important;
                        }
                        a:hover{
                            color:#ff6700!important;
                        }
                    }
                }
            }
            .add-address{
                border:1px dashed #ccc;
                position:relative;
                .add-desc{
                    color:#b0b0b0;
                    position:absolute;
                    top:50%;
                    left:50%;
                    transform:translate3d(-50%,-50%,0);
                    i{
                        font-size:30px;
                        display:block;
                        text-align:center;
                    }
                }
            }
            .address-item:hover{
                border-color:#757575;
            }
            .address-item:hover .address-action{
                opacity:1;
            }
            .add-address:hover i{
                color:#757575!important;
            }
        }
    }
}
</style>
<template>
    <div class="address-box">
        <div class="address-hd">
            <h3>收货地址</h3>
        </div>
        <div class="address-list">
            <ul>
                <li class="address-item add-address"  @click="addAddressDialog">
                    <div class="add-desc">
                        <i class="el-icon-circle-plus" ></i>
                        <span>添加新地址</span>
                    </div>
                </li>
                <el-dialog :title="title" :visible.sync="dialogFormVisible" width="40%">
                    <el-form :model="addressForm" :rules="addressRules" ref="addAddressRef">
                        <el-row :gutter="20">
                            <el-col :span="12">
                                <el-form-item label="" prop="contact_name" :error="Err.contactNameErr">
                                    <el-input v-model="addressForm.contact_name" placeholder="请输入姓名" ></el-input>
                                </el-form-item>
                            </el-col>
                            <el-col :span="12">
                                <el-form-item label="" prop="contact_phone" :error="Err.contactPhoneErr">
                                    <el-input v-model="addressForm.contact_phone" placeholder="请输入手机号码" ></el-input>
                                </el-form-item>
                            </el-col>
                        </el-row>
                        <el-row :gutter="10">
                            <el-col :span="8">
                                <el-form-item prop="provinceId">
                                    <el-select v-model="addressForm.provinceId" filterable placeholder="省">
                                        <el-option v-for="(name, id) in addressForm.provinces" :value="id" :key="id" :label="name" > </el-option>
                                    </el-select>
                                </el-form-item>
                            </el-col>
                            <el-col :span="8">
                                <el-form-item prop="cityId">
                                    <el-select v-model="addressForm.cityId" filterable placeholder="市">
                                        <el-option v-for="(name, id) in addressForm.cities" :value="id" :key="id"  :label="name" > </el-option>
                                    </el-select>
                                </el-form-item>
                            </el-col>
                            <el-col :span="8">
                                <el-form-item prop="districtId">
                                    <el-select v-model="addressForm.districtId" filterable placeholder="区" @change="onDistrictChange">
                                        <el-option v-for="(name, id) in addressForm.districts" :value="id" :key="id" :label="name" > </el-option>
                                    </el-select>
                                </el-form-item>
                             </el-col>
                        </el-row>
                        <el-form-item label="" prop="address" :error="Err.addressErr">
                            <el-input type="textarea" v-model="addressForm.address" placeholder="请输入详细地址"></el-input>
                        </el-form-item>
                        <el-form-item label="" prop="tag" :error="Err.tagErr">
                            <el-input type="input" v-model="addressForm.tag" placeholder="请输入地址标签/公司/家庭"></el-input>
                        </el-form-item>
                    </el-form>
                    <div slot="footer" class="dialog-footer">
                        <el-button type="warning" @click="addAddress('addAddressRef')" v-if="!addressForm.id">确定</el-button>
                        <el-button type="warning" @click="editAddress('addAddressRef',addressForm.id)" v-if="addressForm.id">确定</el-button>
                        <el-button type="info">取消</el-button>
                    </div>
                </el-dialog>
                <li class="address-item" v-for="(v,k) in JSON.parse(user).addresses">
                    <div class="address-info">
                        <div class="name-tag">
                            {{v.contact_name}} <span class="tag">{{v.tag}}</span>
                        </div>
                        <div class="phone">
                            {{v.contact_phone}}
                        </div>
                        <div class="full-address">
                            <span>{{v.province}}</span>
                            <span>{{v.city}}</span>
                            <span>{{v.district}}</span>
                            <span>{{v.address}}</span>
                        </div>
                        <div class="address-action">
                            <el-popconfirm title="确定删除吗？" @onConfirm="delAddress(v.id)">
                                <el-button slot="reference" size="mini" >删除</el-button>
                            </el-popconfirm>
                            <el-button size="mini" @click="editAddressDialog(v)">修改</el-button>
                        </div>
                    </div>
                </li>

                <li style="clear: both"></li>
            </ul>
        </div>
    </div>
</template>

<script>
    // 从刚刚安装的库中加载数据
    const addressData = require('china-area-data/v5/data');
    // 引入 lodash，lodash 是一个实用工具库，提供了很多常用的方法
    import _ from 'lodash';
    export default {
        data(){
            return {
                // 标题
                title:null,
                // 表单数据
                addressForm:{
                    id:null,
                    contact_name:null,
                    contact_phone:null,
                    address:null,
                    tag:null,
                    province:null,
                    city:null,
                    district:null,

                    provinces: addressData['86'], // 省列表
                    cities: {}, // 城市列表
                    districts: {}, // 地区列表
                    provinceId: '', // 当前选中的省
                    cityId: '', // 当前选中的市
                    districtId: '', // 当前选中的区
                },
                // 表单规则
                addressRules:{
                   contact_name:[
                       {required:true,message:'请输入姓名',trigger:'blur'},
                   ],
                    contact_phone:[
                        {required:true,message:'请输入手机号码',trigger:'blur'}
                    ],
                    address:[
                        {required:true,message:'请输入详细地址',trigger:'blur'}
                    ],
                    tag:[
                        {required:true,message:'请输入地址标签',trigger:'blur'}
                    ],
                    provinceId:[
                        {required:true,message:'请选择省份',trigger:'change'}
                    ],
                    cityId:[
                        {required:true,message:'请选择城市',trigger:'change'}
                    ],
                    districtId:[
                        {required:true,message:'请选择区域',trigger:'change'}
                    ],
                },
                // 后台错误验证
                Err:{
                    contactNameErr:null,
                    contactPhoneErr:null,
                    addressErr:null,
                    tagErr:null,
                    provinceErr:null,
                    cityErr:null,
                    districtErr:null,
                },
                // 对话框是否显示
                dialogFormVisible:false,
            }
        },
        props:{
            type:String,
            user:String,
            // 用来初始化省市区的值，在编辑时会用到
            initValue: {
                type: Array, // 格式是数组
                default: () => ([]), // 默认是个空数组
            }

        },
        // 定义观察器，对应属性变更时会触发对应的观察器函数
        watch: {
            'addressForm.provinceId':function(val){
                if (!val) {
                    this.addressForm.cities = {};
                    this.addressForm.cityId = '';
                    return;
                }
                // // 将城市列表设为当前省下的城市
                this.addressForm.cities = addressData[val];
                // // 如果当前选中的城市不在当前省下，则将选中城市清空
                if (!this.addressForm.cities[this.addressForm.cityId]) {
                    this.addressForm.cityId = '';
                }
            },
            'addressForm.cityId':function(val){
                if(!val){
                    this.addressForm.districts = {};
                    this.addressForm.districtId = '';
                    return;
                }
                // 将地区列表设为当前城市下的地区
                this.addressForm.districts = addressData[val];
                // 如果当前选中的地区不在当前城市下，则将选中地区清空
                if (!this.addressForm.districts[this.addressForm.districtId]) {
                    this.addressForm.districtId = '';
                }
            },
            'addressForm.districtId':function(){
                this.onDistrictChange();
            }

        },
        // 组件初始化时会调用这个方法
        created() {
            // this.setFromValue(this.initValue);
        },
        methods:{
            // 删除收货地址
            delAddress:function(id){
                let _this=this;
                axios.delete('/user_address/'+id).then(function(res){
                    _this.$message('删除成功');
                    location.reload();
                }).catch(function(err){
                    console.log(err.response);
                });
            },
            addAddressDialog:function(){
                this.resetForm();
                this.dialogFormVisible=true;
                this.title='新增收货地址';
            },
            editAddressDialog:function(address){
                this.dialogFormVisible=true;
                this.addressForm.contact_name=address.contact_name;
                this.addressForm.contact_phone=address.contact_phone;
                this.addressForm.province=address.province;
                this.addressForm.city=address.city;
                this.addressForm.district=address.district;
                this.addressForm.address=address.address;
                this.addressForm.tag=address.tag;
                this.addressForm.id=address.id;
                this.title='修改收货地址';
                // 寻找地址key
                // 省
                let provinceId=_.findKey(this.addressForm.provinces,o=>o===this.addressForm.province);
                if(!provinceId){
                    this.addressForm.provinceId=null;
                    return;
                }
                this.addressForm.provinceId=provinceId;
                // 市
                let cityId=_.findKey(addressData[provinceId],o=>o===this.addressForm.city);
                if(!cityId){
                    this.addressForm.cityId=null;
                    return;
                }
                this.addressForm.cityId=cityId;
                // 区
                let districtId=_.findKey(addressData[cityId],o=>o===this.addressForm.district);
                if(!districtId){
                    this.addressForm.districtId=null;
                    return;
                }
                this.addressForm.districtId=districtId;
            },
            resetForm:function(){
                this.addressForm.contact_name=null;
                this.addressForm.contact_phone=null;
                this.addressForm.province=null;
                this.addressForm.city=null;
                this.addressForm.district=null;
                this.addressForm.address=null;
                this.addressForm.tag=null;
                this.addressForm.id=null;
                this.addressForm.provinces= addressData['86']; // 省列表
                this.addressForm.cities= {}; // 城市列表
                this.addressForm.districts= {}; // 地区列表
                this.addressForm.provinceId= ''; // 当前选中的省
                this.addressForm.cityId= ''; // 当前选中的市
                this.addressForm.districtId= ''; // 当前选中的区
            },
            addAddress:function(refName){
                let _this=this;
                this.$refs[refName].validate(valid=>{
                    if(valid){
                        // 通过验证
                        axios.post('/user_address',this.addressForm).then(function(res){
                            _this.$message('添加成功');
                            location.reload();
                        }).catch(function(err){
                            console.log(err.response);
                        });
                    }else{
                        return false;
                    }
                });
            },
            editAddress:function(refName,id){
                this.$refs[refName].validate(valid=>{
                    let _this=this;
                    if(valid){
                        axios.put('/user_address/'+id,this.addressForm).then(function(res){
                            _this.$message('修改成功');
                            location.reload();
                            // console.log(res);
                        }).catch(function(err){
                            console.log(err.response);
                        });
                    }
                });
            },
            onDistrictChange:function () {
                this.addressForm.province=this.addressForm.provinces[this.addressForm.provinceId];
                this.addressForm.city=this.addressForm.cities[this.addressForm.cityId];
                this.addressForm.district=this.addressForm.districts[this.addressForm.districtId];
            },
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
