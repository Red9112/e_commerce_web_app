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
                <th>Selected quantities</th>
                <th>Bonus quantities</th>
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
                @else
                <td>none</td>
                 @endif
                 @if (array_key_exists($product->id, $bonusQuantities))
                 <td>{{$bonusQuantities[$product->id]}}</td>
                 @else
                 <td>none</td>
                 @endif
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<form action="{{route('confirm_order')}}" method="POST">
    @csrf
    <div class="d-flex">
 <div id="totalPriceCard" class="card w-50 my-3 mx-3 py-5">
    <div class="card-body ">
<h3>Subtotal :<strong>{{ $subtotal }}</strong></h3>
<h3>Shipping fee :<strong>{{ $shipping->price }}</strong></h3>
<h2>Total :<strong>{{ $total }}</strong></h2>
<input hidden type="text" name="total" value="{{$total}}">
<input hidden type="text" name="shipping" value="{{$shipping->id}}">

@foreach($products as $product)
<input hidden type="text" name="prices[]" value="{{$productsPrices[$product->id]}}">
<input hidden type="text" name="bonusQuantities[]" value="{{$bonusQuantities[$product->id]}}">
<input hidden type="text" name="selectedQuantities[]" value="{{$selectedQuantities[$product->id]}}">
<input hidden type="text" name="products[]" value="{{ $product->id }}">
@endforeach
</div> 
</div>
  <div class="card w-50 my-3 bg-light mx-3">
      <div class="card-header bg-secondary"><h3>Payment Method</h3></div>
    <div class="card-body ">
    <div class="mb-3 mt-3 text-left">
        <a id="createpayment" type="button" class=" btn btn-outline-info my-1 btn-sm " href="{{route('payment.index')}}">add payment</a>
        <button id="selectpaymentBtn" type="button" class=" btn btn-outline-success my-1 btn-sm">Select payment</button>
        <select style="display: none" class="form-select @error('payment') is-invalid @enderror" id="payment" name="payment">
        <option  selected disabled hidden>Choose...</option>
        @foreach ($payments as $payment)
        <option @if($payment->is_default)selected @endif value="{{$payment->id}}">{{$payment->account_number}}</option>
        @endforeach
        </select>
      <x-errors name="payment"></x-errors>
      </div>
      </div>
      <div class="card-header bg-secondary"><h3>Shipping Address</h3></div>
      <div class="card-body ">
    <div class="mb-3 mt-3 text-left">
        <a id="createadre" type="button" class=" btn btn-outline-info my-1 btn-sm " href="{{route('address.create')}}">add address</a>
        <button id="selectAdre" type="button" class=" btn btn-outline-success my-1 btn-sm">Select address</button>
        <select style="display: none" class="form-select @error('address') is-invalid @enderror" id="address" name="address">
        <option  selected disabled hidden>Choose...</option>
        @foreach ($addresses as $address)
        <option @if($address->is_default)selected @endif value="{{$address->id}}">{{$address->address}}</option>
        @endforeach
        </select>
      <x-errors name="address"></x-errors>
      </div>
      </div>

</div>
</div>
<button class="d-flex justify-content-end btn btn-danger my-2 mx-3 " type="submit">Confirm Order</button>
</div>

</form>


</div>


@endsection
