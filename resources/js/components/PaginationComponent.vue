<template>
    <div class="pagination">
        <p>每页条数：{{pagination.pageSize}}</p>
        <p>当前页：{{pagination.curPage}}</p>
        <p>总条数：{{pagination.total}}</p>
        <p>页面数：{{Math.ceil(pagination.total/pagination.pageSize)}}</p>
        <a href="javascript:void(0);" v-show="showFirstPage" v-on:click="firstPage" >首页</a>
        <a href="javascript:void(0);" v-show="showPrevPage" v-on:click="prevPage" >上一页</a>
        <a href="javascript:void(0);" v-show="showPrevPage" v-on:click="simplePage(v)" v-for="(v,k) in pages" :key="k">{{v}}</a>
        <a href="javascript:void(0);" v-show="showNextPage" v-on:click="nextPage" >下一页</a>
        <a href="javascript:void(0);" v-show="showLastPage" v-on:click="lastPage" >尾页</a>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                showFirstPage:true,//是否显示首页按钮
                showLastPage:true,//是否显示最后一页的按钮
                showPrevPage:true,//是否显示上一页按钮
                showNextPage:true,//是否显示下一页按钮
                pages:Math.ceil(this.pagination.total/this.pagination.pageSize),//页面总数

            }
        },
        props:['pagination'],//pageSize:页面大小，curPage:当前页，total:数据总条数
        methods:{
            firstPage(){},
            prevPage(){},
            simplePage(v){
                console.log(v);
                this.$emit('getData',v);
            },
            nextPage(){},
            lastPage(){},
        },
        mounted() {

        }
    }
</script>
