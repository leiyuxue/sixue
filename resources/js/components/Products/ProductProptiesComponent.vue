<style lang="scss" scoped>
    .propties{
        min-width:1226px;
        .propties-list{
            margin:0;
            .item{
                margin:0;
                padding:0;
                .name{
                    font-size: 20px;
                }
                .value{
                    font-size: 18px;
                }
            }
        }
    }
</style>
<template>
    <div class="propties">
        <div class="propties-list">
            <div class="container">
                <div class="none_item" v-if="productData.propties.length<=0">
                        暂无属性
                </div>
                <div class="item" v-for="(v,k) in productData.grouped_properties" :key="k" v-if="productData.propties.length>0">
                   <el-row>
                       <el-col :span="6">
                           <div class="name">{{k}}</div>
                       </el-col>
                       <el-col :span="18">
                           <div class="value">{{v.join(' ')}}</div>
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
                productData:JSON.parse(this.product),
            }
        },
        props:['product'],
        mounted() {

        }
    }
</script>
