@extends('layouts.layout')
@section('header')
@include('includes.header')
@endsection
@section('content')

<div class="p-3 my-3 mx-5 w-75 ">
<h2 class="p-1 m-1">Affect discount to products:</h2>
<h3 class="p-2 m-2">Discount name :<span class="badge bg-success">{{$discount->name}}</span></h3>
@include('discount.attach')
@include('discount.detach')
    </div>
@endsection
