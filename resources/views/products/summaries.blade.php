@extends('layouts.app')
@section('content')
    <product-nav-component product="{{$product}}"></product-nav-component>
    <product-summaries-component product="{{$product}}"></product-summaries-component>
@stop
