@extends('layouts.layout')
@section('header')
@include('includes.header')
@endsection
@section('content')
<div class="container">
    <h1>Order Details</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Product</th>
                <th>Selected quantity</th>
                <th>Bonus quantity</th>
                <th>Price</th>  
            </tr>
        </thead>
        <tbody>
            @foreach ($order->products as $product)
                <tr>
                    <td>
                        <a class="btn btn-info my-1 mx-1" href="{{route('product.show',['product'=>$product->id])}}">
                            <img src="{{$product->getFirstImage()}}" class="rounded" alt="product photo" width="100" height="100">
                        </a>
                        {{$product->name}}
                       </td>
                    <td>{{$product->pivot->selected_quantity}}</td>
                    <td>{{$product->pivot->bonus_quantity}}</td>
                    <td>
                        {{-- <div class="d-flex flex-row align-items-center mb-1"> --}}
                        <h4 class="mb-1 me-1">{{$product->pivot->price}}</h4>
                        <span class="text-danger"><s>{{$product->price}}</s></span>
                        {{-- </div> --}}
                        </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="row">
        <div class="col-md-6">
            <p><strong>Shipping Method:</strong> {{ $order->shipping->name }}</p>
            <p><strong>Shipping Address:</strong> {{ $order->address->address }}</p>
            <p><strong>Shipping Price:</strong> {{$order->shipping->price }}</p>
        </div>
        <div class="col-md-6">
            <p><strong>Total:</strong> {{ $order->order_total }}</p>
            <p><strong>Payment Card Number:</strong> {{ $order->payment->account_number }}</p>
            <p><strong>User Name:</strong> {{ $order->user->name }}</p>
        </div>
    </div>
</div>

@endsection