<style lang="scss" scoped>
    .summaries{
        min-width:1226px;
        .summaries-list{
            margin:0;
            .item{
                margin:0;
                padding:0;
                font-size: 0;
                .el-image{
                    vertical-align:bottom;
                }
            }
        }
    }
</style>
<template>
    <div class="summaries">
        <div class="none_summaries" v-if="!productData.summaries">
            <div class="container">
                暂无概述
            </div>
        </div>
        <div class="summaries-list"  v-if="!productData.summaries">
            <div class="item" v-for="(v,k) in productData.summary_url" :key="k">
                <el-image :src="v"></el-image>
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
