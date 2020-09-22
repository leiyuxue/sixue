<style lang="scss" scoped>

    ::v-deep .el-carousel__arrow--left{
        left:250px;
    }
</style>
<template>
    <div class="solider" >
        <el-carousel :interval="5000" arrow="always" width="1226px" height="460px">
            <el-carousel-item v-for="(item,key) in solidersData" :key="key">
                <a :href="item.link"><img :src="item.img" alt=""></a>
            </el-carousel-item>
        </el-carousel>
    </div>
</template>
<script>
    export default {
        data(){
            return {
                solidersData:JSON.parse(this.soliders),
            }
        },
        props:['soliders'],
    }
</script>
