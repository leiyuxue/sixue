@extends('layouts.app')
@section('content')
    <product-nav-component product="{{$product}}"></product-nav-component>
    <product-comments-component comments_data="{{$commentsData}}" product="{{$product}}"></product-comments-component>
@stop
