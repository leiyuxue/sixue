@extends('layouts.app')
@section('content')
    <product-nav-component product="{{$product}}"></product-nav-component>
    <product-propties-component product="{{$product}}"></product-propties-component>
@stop
