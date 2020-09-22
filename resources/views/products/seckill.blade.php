@extends('layouts.app')
@section('title','小米商城')
@section('content')
    <div class="seckill-bd">
        <sec-kill-component seckills="{{$seckills}}" is_login="{{$is_login}}"></sec-kill-component>
    </div>
@stop
