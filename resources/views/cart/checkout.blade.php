@extends('layouts.cart.app')
@section('title','填写订单信息')
@section('content')
    <carts-check-out-component check_data="{{json_encode($checkData)}}" addresses="{{json_encode($addresses)}}" coupon_codes="{{$coupon_codes}}"></carts-check-out-component>
@stop
