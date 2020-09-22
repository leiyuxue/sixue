@extends('layouts.app')
@section('title','成功加入购物车-小米商城')
@section('style')
    <style lang="scss" scoped>
        .add_cart_success{
            background: #f5f5f5;
        }
        .success_info {
            border-bottom: 1px solid #ccc;
            height: 97px;
            padding-top:10px;
            .icon {
                font-size: 64px;
                color: #00ca6d;
                float: left;
            }

            .info {
                float: left;

                .mes {
                    font-size: 24px;
                    font-weight: 400;
                    color: #333;
                }

                .title {
                    font-size: 14px;
                    color: #757575;
                }
            }
        }
    </style>
@endsection
@section('content')
    <div class="add_cart_success">
        <div class="container">
            <div class="success_info">
                <el-row>
                    <el-col :span="12">
                        <div class="icon" style="float:left;">
                            <i class="el-icon-success" style="font-size: 64px;color:#00ca6d"></i>
                        </div>
                        <div class="info" style="float:left;margin-left:20px;">
                            <p class="mes" style="margin-top:10px;font-size: 24px;">已成功加入购物车</p>
                            <p class="title" style="color:#757575;font-size: 14px;margin-top:5px;">{{$cartData->productSku->product->title}} {{$cartData->productSku->title}}</p>
                        </div>
                    </el-col>
                    <el-col :span="12">
                        <div class="btn" style="padding-top:20px;">
                            <el-button type="info" style="float:right;margin-left:20px;" class="goback">返回上一级</el-button>
                            <el-button type="warning" style="float:right;" onclick="location.href='/cart_list'">去购物车结算</el-button>
                        </div>

                    </el-col>
                </el-row>
            </div>
        </div>
    </div>

@stop
@section('script')
    <script>
        $(document).ready(function(){
            $('.goback').click(function(){
                window.history.go(-1);
            });
        });
    </script>
@endsection
