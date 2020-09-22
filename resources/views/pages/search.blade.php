@extends('layouts.app')
@section('content')
    <div class="search">
        <div class="bread">
            <div class="container">
                <el-breadcrumb separator-class="el-icon-arrow-right">
                    <el-breadcrumb-item><a href="/">首页</a></el-breadcrumb-item>
                    @if($category)
                        @if($category->parent_data)
                            @foreach($category->parent_data as $pcategory)
                                <el-breadcrumb-item ><a href="javascript:selectCategory('{{$pcategory['id']}}')">{{$pcategory['name']}}</a></el-breadcrumb-item>
                            @endforeach
                        @endif
                        @if($category)
                            <el-breadcrumb-item >
                                {{$category['name']}}
                            </el-breadcrumb-item>
                        @endif
                    @endif
                    @if($filters['search'])
                        <el-breadcrumb-item><a href="">{{$filters['search']}}</a></el-breadcrumb-item>
                    @endif
                </el-breadcrumb>
            </div>
        </div>
        <div class="search-filter">
            <div class="container">
                @if($category)
                    @if($category->children)
                    <ul class="properties-list">
                        <div class="item-main" >
                            <span class="label">
                                子类目：
                            </span>
                            @foreach($category->children as $ccategory)
                                <li class="property-item" >
                                    <a href="javascript:selectCategory('{{$ccategory['id']}}')">{{$ccategory->name}}</a>
                                </li>
                            @endforeach
                        </div>
                    </ul>
                    @endif
                @endif
                @if($checkPropties)
                <ul class="properties-list">
                    <div class="item-main" >
                        <span class="label">
                            已选：
                        </span>
                        @foreach($checkPropties as $name=>$value)
                            <li class="check-property-item property-item">
                                <span class="name" >{{$name}}</span> ： <span class="value" >{{$value}}</span>
                                <a href="javascript:removeFilterToQuery('{{$name}}','{{$value}}')" class="close" >x</a>
                            </li>
                        @endforeach
                    </div>
                </ul>
                @endif
                @foreach($propties as $p)
                    <ul class="properties-list">
                        <div class="item-main" >
                            <span class="label">
                                {{$p['key']}}：
                            </span>
                            @foreach($p['values'] as $v)
                            <li class="property-item">
                                <a href="javascript:appendFilterToQuery('{{$p['key']}}','{{$v}}')">{{$v}}</a>
                            </li>
                            @endforeach
                        </div>
                    </ul>
                @endforeach
            </div>
        </div>
        <div class="products">
            <div class="product-order">
                <div class="container">
                    <ul class="order-list">
                        <li class="order-item br" >
                            <a href="javascript:setOrder('')" style="@if(!$filters['order']) color:#ff6700 @endif">综合</a>
                        </li>
                        <li class="order-item br">
                            <a href="javascript:setOrder('id_desc')" style="@if($filters['order']==='id_desc') color:#ff6700 @endif">新品</a>
                        </li>
                        <li class="order-item br">
                            <a href="javascript:setOrder('sold_count_desc')" style="@if($filters['order']==='sold_count_desc') color:#ff6700 @endif">销量</a>
                        </li>
                        <li class="order-item br" style="border:0;">
                            <a href="javascript:setOrder('price_asc')" style="@if($filters['order']==='price_asc') color:#ff6700 @endif">价格</a>
                        </li>

                        <div style="clear: both"></div>
                    </ul>
{{--                    <select name="order" id="orders">--}}
{{--                        <option value ="">选择排序</option>--}}
{{--                        <option value ="price_asc" @if($filters['order']==='price_asc') selected @endif>价格升序</option>--}}
{{--                        <option value ="price_desc"  @if($filters['order']==='price_desc') selected @endif>价格降序</option>--}}
{{--                    </select>--}}
                </div>
            </div>
            <div class="products-box">
                <div class="container" style="width:1240px;">
                    <ul class="products-list">
                        @foreach($products as $product)
                        <li class="products-item">
                            <div class="img">
                                <a href="">
                                    <img src="{{$product['img_url']}}" alt="" width="200" height="200">
                                </a>
                            </div>
                            <div class="title">
                                <a href="">{{$product->title}}</a>
                            </div>
                            <div class="price">{{$product->price}}元 起 </div>
                            <p>{{$product->sold_count}}</p>
                            <p>{{$product->id}}</p>
                            <p>{{$product->price}}</p>
                        </li>
                        @endforeach
                        <div style="clear: both"></div>
                    </ul>
                    <div class="float-right" >{{$products->render()}}</div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        var filters={!! json_encode($filters) !!}
        $(document).ready(function(){

        });
        // 解析参数
        function parseParams(){
            // 定义一个空对象存放解析后的参数，以键值对的形式存放
            var params={}
            // 解析参数
            location.search.substr(1).split('&').forEach(function(str){
                var result=str.split('=');
                params[decodeURIComponent(result[0])]=decodeURIComponent(result[1]);
            });
            return params;
        }
        // 构建参数
        function buildParams(params){
            var path='?';
            _.forEach(params,function(value,key){
                path+=encodeURIComponent(key)+'='+encodeURIComponent(value)+'&';
            })
            return path.substr(0,path.length-1);
        }
        function appendFilterToQuery(key,value){
            var params=parseParams();
            // console.log(params);
            if(params['filters']){
                params['filters']+='|'+key+':'+value;
            }else{
                params['filters']=key+':'+value;
            }
            // 重新构建参数，并出发浏览器跳转
            location.search=buildParams(params);
        }
        function removeFilterToQuery(key,value){
            var params=parseParams();
            console.log(params);
            var filters=[];
            if(!params['filters']){
                return;
            }
            params['filters'].split('|').forEach(function(f){
                var kv=f.split(':');
                if(kv[0]===key){
                    return;
                }
                filters.push(f);
            });
            // 重新组合字符串
            params['filters']=filters.join('|');
            // 重新构建参数，并出发浏览器跳转
            location.search=buildParams(params);
        }
        function setOrder(sort){
            var params=parseParams();
            params['order']=sort;
            location.search=buildParams(params);
        }
        function selectCategory(id){
                var params=parseParams();
                params['category_id']=id;
                location.search=buildParams(params);
        }
        // $('select[name=order]').on('change', function() {
        //     var params=parseParams();
        //     params['order']=this.options[this.selectedIndex].value;
        //     location.search=buildParams(params);
        // })
    </script>
@endsection
