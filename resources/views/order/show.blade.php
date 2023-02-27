@extends('layouts.layout')
@section('header')
@include('includes.header')
@endsection
@section('content')
<div class="container my-3">
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
@can('set_order_status', $order)
    <div class="my-5">
    <h2>Set status</h2>
    <form id="editForm" method="POST" action="{{route('set.order.status',['order'=>$order->id])}}">
        @method('PUT')
        @csrf
            <div class="mb-3 mt-3 w-25">
              <label for="order_status">Select status :</label>
              <select class="form-select @error('order_status') is-invalid @enderror" id="order_status" name="order_status">
              @foreach ($order_statuses as $status)
              <option value="{{$status->id}}"
              @if($status->id==$order->order_status->id)selected @endif>{{ $status->name }}</option>
              @endforeach
              </select>
            <x-errors name="order_status"></x-errors>
            </div>
            <button  type="submit" class="btn btn-primary">save</button>
          </form>
           </div>
@endcan
</div>

@endsection
