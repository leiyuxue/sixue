@extends('layouts.app')

@section('title', '首页')

@section('content')
    <div class="{{route_class()}}-page">
            <div class="slide">
                <div class="container">
                    <solider-component soliders="{{$soliders}}"></solider-component>
                </div>
            </div>
            <div class="bd">
                <div class="container">
                    <div class="flash_sale">
                        <flash-sale-component seckills="{{$seckills}}"></flash-sale-component>
                    </div>
                    <category-products-component data="{{$data}}"></category-products-component>
                </div>
            </div>
    </div>
@stop
