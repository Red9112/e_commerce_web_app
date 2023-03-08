@extends('layouts.layout')
@section('header')
@include('includes.header')
@endsection
@section('content')

<div class="container p-2 ">
    <h2 class="text-center text-success">Products of shop:<span class="mx-3"><i class="fa-regular fa-shop"></i>  {{$shop->name}}</span></h2>
</div>



<x-display-prod :products="$shop->products"></x-display-prod>






@endsection