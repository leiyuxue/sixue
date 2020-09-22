<style lang="sass" scoped></style>

<template>
    <div class="search-box">
        <el-input placeholder="请输入内容" v-model="search" class="input-with-select">
            <el-button slot="append" icon="el-icon-search" @click="submit"></el-button>
        </el-input>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                search:'',
            }
        },
        mounted() {
            let _this=this;
            location.search.substr(1).split('&').forEach(function(str){
                var result=str.split('=');
                if(decodeURIComponent(result[0])==='keyword'){
                    _this.search=decodeURIComponent(result[1]);
                }
            });
        },
        methods:{
            submit(){
                if(this.search){
                    location.href='/search?keyword='+this.search;
                }else{
                    location.href='/search';
                }


            },
        },
    }
</script>
