@extends('layouts.app')
@section('content')
    <product-nav-component product="{{$product}}" user="{{$user}}" route_class="{{$route_class}}"></product-nav-component>
    <product-show-component product="{{$product}}" favored="{{$favored}}" is_login="{{$is_login}}"></product-show-component>
@stop



