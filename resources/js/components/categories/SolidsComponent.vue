<style lang="scss" scoped>
    ::v-deep .el-carousel__arrow--left{
        left:50%;
        margin-left:-613px;
    }
    ::v-deep .el-carousel__arrow--right{
        right:50%;
        margin-right:-613px;
    }
.solids{
    height:620px;
    a:hover{

    }
    .text{
        position:absolute;
        z-index:11;
        top:250px;
        left:50%;
        margin-left:-550px;
        .title{
            color:#333;
            font-size:22px;
        }
        .desc{
            color:#333;
            font-size:22px;
        }
        .btn{
            color:#333;
        }
        .price{
            color:#333;
            margin-top:50px;
            font-size:22px;
        }
    }
}
</style>
<template>
<div class="solids">
    <el-carousel :interval="5000" arrow="always"  height="620px">
        <el-carousel-item v-for="(item,key) in solidProductsData" :key="key">
            <a :href="'/products/'+item.id">
                <img :src="item.flash_img_url" alt="" width="2560" height="620">
            </a>
        </el-carousel-item>
    </el-carousel>
</div>
</template>
<script>
    export default {
        data(){
            return {
                solidProductsData:JSON.parse(this.solids),
            }
        },
        props:['solids'],
    }
</script>
