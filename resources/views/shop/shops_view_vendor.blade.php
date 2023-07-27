@extends('layouts.layout')
@section('header')
@include('includes.header')
@endsection
@section('content')


<div class="container pt-5">
    <h1>Dashboard</h1>
    <div class="cardEarnings w-50 my-3">
        <div class="row ">
            <h4>Earnings:</h4>
            <h3>$0.00</h3>
            <hr>
                </div>
      </div>
    <div class="row">
<div class="row my-3">
    <h4 style="color:#0CEA9D ">Statistics:</h4>
<h5 style="color:#FE7E8E ">Statistics in 30 days</h5>
<div class="containerCards">
    <div class="main-containerCards">
    <div class="cards d-flex">
        <div class="cardDash card-1 card w-50">
            <div class="card-body d-flex">
                <div class="card-title">@include('includes.icons.orders')</div>
                <div class="mx-4">
                    Orders
                    <h3>{{$ordersNbr}}</h3>
                </div>
            </div>
        </div>
        <div class="cardDash card-2 card w-50">
            <div class="card-body d-flex">
                <div class="card-title">@include('includes.icons.revenue')</div>
                <div class="mx-4">
                    Revenue
                    <h3>{{$earning}}</h3>
                </div>
            </div>
        </div>
        <div class="cardDash card-3 card w-50">
            <div class="card-body d-flex">
                <div class="card-title">@include('includes.icons.products')</div>
                <div class="mx-4">
                    Products
                    <h3>{{$nbrProd}}</h3>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>

</div>
    </div>
</div>


















@endsection
