@extends('layouts.app')

@section('title', '个人中心')
@section('content')
    <div class="{{route_class()}}-page-container" style="background: #f5f5f5;">
        <div class="{{route_class()}}-box">
            <personal-component type="{{$type}}" user="{{$user}}"></personal-component>
        </div>
    </div>
@stop
