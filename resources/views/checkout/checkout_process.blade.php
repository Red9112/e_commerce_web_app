@extends('layouts.layout')
@section('header')
@include('includes.header')
@endsection
@section('content')


<div class="container text-center">
    <div class="d-grid gap-3 my-3 ">
       <button id="discountsDetailsBtn" type="button" class="btn btn-info btn-block">Discounts details:</button>
      </div>
      <div id="discountsDetailsTable" style="display: none">
    <h2>Selected Products:</h2>
    <table  class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>Product Name</th>
                <th>Original Price</th>
                <th>Discounted Price</th>
                <th>Selected quantity</th>
                <th>Total quantity (with Free items) </th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->price }}</td>
                @if (array_key_exists($product->id, $productsPrices))
                <td>{{$productsPrices[$product->id]}}</td>
                @else
                <td>none</td>
                 @endif
                 @if (array_key_exists($product->id, $selectedQuantities))
                <td>{{$selectedQuantities[$product->id]}}</td>
                 @endif
                 @if (array_key_exists($product->id, $quantitiesWithOffer))
                 <td>{{$quantitiesWithOffer[$product->id]}}</td>
                  @endif
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<form action="{{route('checkout_process_payment')}}" method="POST">
 @csrf
<div class="d-flex">
<div id="totalPriceCard" class="card w-50 my-3 mx-3">
    <div class="card-body ">
<h3>Subtotal :<strong>{{ $subtotal }}</strong></h3>
<h3>Shipping fee :<strong>{{ $shipping->price }}</strong></h3>
<h2>Total :<strong>{{ $total }}</strong></h2>
<input hidden type="text" name="total" value="{{$total}}">
<input hidden type="text" name="shipping" value="{{$shipping->id}}">
    </div>
<button type="submit" class="btn btn-danger  my-2">Checkout</button>
</div>
  <div class="card w-50 my-3 bg-light mx-3">
    <form action="{{route('checkout_process_payment')}}" method="POST">
        @csrf
    <div class="card-body ">
    <h3>Payment Methods:</h3>
    <div class="mb-3 mt-3">
    <h4>Select Payment Method</h4>
    <label for="account_number">Account Number:</label>
    <input type="text" class="form-control @error('account_number') is-invalid @enderror" id="account_number" value="{{old('account_number')}}" name="account_number">
    </div>
    <h3>Shipping Address</h3>
    <div class="mb-3 mt-3">
    <label for="account_number">Select adress</label>
    <input type="text" class="form-control @error('account_number') is-invalid @enderror" id="account_number" value="{{old('account_number')}}" name="account_number">
    </div>
</div>
</div>
</div>
</form>


</div>




@endsection
