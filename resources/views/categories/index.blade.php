@extends('layouts.app')
@section('content')
{{--幻灯片--}}
<solids-component solids="{{$solids}}"></solids-component>
{{--   分类及商品--}}
@if($much)
<categories-products categories="{{$categories}}"></categories-products>
@else
<category-products categories="{{$categories}}"></category-products>
    @endif
@stop
