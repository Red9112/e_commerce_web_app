@extends('layouts.layout')
@section('header')
@include('includes.header')
@endsection
@section('content')

<!-- Confirm Order Page -->
<div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1 class="text-center my-5">Confirm Order</h1>
      </div>
    </div>
    <div class="row">
      <div class="col-md-8">
        <h2 class="my-3">Order Details</h2>
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Product</th>
              <th>Selected quantities</th>
              <th>Bonus quantities</th>
              <th>Price</th>
            </tr>
          </thead>
          <tbody>
             @foreach($products as $product)
            <tr>
             <td>
             <img src="{{$product->getFirstImage()}}" class="rounded" alt="product photo" width="100" height="100">
             {{$product->name}}
            </td>
             @if (array_key_exists($product->id, $selectedQuantities))
              <td>{{$selectedQuantities[$product->id]}}</td>
              @else
              <td>none</td>
              @endif
              @if (array_key_exists($product->id, $bonusQuantities))
              <td>{{$bonusQuantities[$product->id]}}</td>
              @else
              <td>none</td>
              @endif
              @if (array_key_exists($product->id, $productsPrices))
                <td>{{$productsPrices[$product->id]}}</td>
                @else
                <td>none</td>
                 @endif
            </tr>
             @endforeach
          </tbody>
        </table>
      </div>
      <div class="col-md-4">
        <div class="card">
  <div class="card-body">
    <h2 class="my-3 text-center">Shipping Method</h2>
        <h3><span class="badge bg-success d-flex justify-content-center">{{$shipping->name}}</span></h3>
        <h2 class="my-3 text-center">Shipping Address</h2>
        <h3><span class="badge bg-success d-flex justify-content-center">{{$address->address}}</span></h3>
        <h2 class="my-3 text-center">Payment Card</h2>
        <h3><span class="badge bg-success d-flex justify-content-center">{{$payment->account_number}}</span></h3>
        <h2 class="my-3 text-center">Total Price</h2>
        <h3><span class="badge bg-success d-flex justify-content-center">{{$total}}</span></h3>
  </div>
</div>

      </div>
    </div>
    <div class="row">
           <div class="col-md-12">
         <form action="{{ route('order.store') }}" method="POST">
        @csrf
        @foreach($products as $product)
        <input hidden type="text" name="products[]" value="{{ $product->id }}">
        <input hidden type="text" name="bonusQuantities[]" value="{{$bonusQuantities[$product->id]}}">
        <input hidden type="text" name="selectedQuantities[]" value="{{$selectedQuantities[$product->id]}}">
        <input hidden type="text" name="productsPrices[]" value="{{$productsPrices[$product->id]}}">
        @endforeach
        <input type="hidden" name="shipping_id" value="{{$shipping->id}}">
        <input type="hidden" name="address_id" value="{{$address->id}}">
        <input type="hidden" name="payment_id" value="{{$payment->id}}">
        <input type="hidden" name="order_total" value="{{$total}}">
        <input type="hidden" name="order_status_id" value="1">
        <button type="submit" class="btn btn-danger  btn-block my-5">Confirm Order</button>
        </form>
        </div>
    </div>
  </div>


@endsection
