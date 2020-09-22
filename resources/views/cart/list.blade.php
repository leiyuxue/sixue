@extends('layouts.cart.app')
@section('content')
    <div class="bd" style="background: #f5f5f5;margin:0;padding:0;">
    <carts-component carts="{{json_encode($carts)}}" addresses="{{json_encode($addresses)}}"></carts-component>
    </div>
@stop
