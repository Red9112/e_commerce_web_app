@extends('layouts.layout')
@section('header')
@include('includes.header')
@endsection
@section('content')

@if ($products!=null)
<div class="row p-3 mx-5 my-3 w-25 bg-light text-white rounded">
<div class="d-flex justify-content-start alert alert-light">
<h4><strong>Shopping Cart :({{$products->count()}})</strong></h4>
 </div>
  </div>
  <h1 class="mx-5 my-5 title">Cart:</h1>
  <form action="{{route('checkout_process_discount')}}" method="POST">
  @csrf
  <div class="d-flex mx-5 my-4 p-3 bg-light text-dark rounded w-50 border">
    <label class="py-1 mx-3" for="shipping"><h5>Shipping: </h5> </label>
    <select class="form-select @error('shipping') is-invalid @enderror" id="shipping" name="shipping">
    <option  selected disabled hidden>Choose Shipping method</option>
    @foreach ($shipping as $item)
    <option value="{{$item->id}}">{{$item->name}}</option>
    @endforeach
    </select>
  <x-errors name="shipping"></x-errors>
  </div>
  <div class="mx-5 px-3">
    <x-errors name="products"></x-errors></div>
  
  @foreach ($products as $product)
  <div class="d-flex mx-5 my-4 p-3 bg-light text-white rounded w-50 border">
    <div> 
        <input class="selectProduct" type="checkbox" name="products[]" value="{{ $product->id }}">
      </div>
<div>
<img src="{{$product->getFirstImage()}}" class="rounded" alt="product photo" width="304" height="236">
</div> 
<div> 
<h3 class="product-title">{{ $product->name }}</h3>
        <div class="prd_cart_info">
          <span class="mr-2">Price: </span><span class="price-value"> {{ $product->price }}</span>
        </div>
        <div class="prd_cart_info d-flex">
          <span class="mt-3">Quantity:</span>
          <input class="prd_cart_info form-control mt-2" type="number" name="quantity[{{ $product->id }}]" id="quantity-{{ $product->id }}" value="1">
        </div>
        <div class="d-flex my-3">
            <a href="{{route('removeSessionProduct',['id'=>$product->id])}}" type="button">
                @include('includes.icons.delete')
            </a>
            <a href="{{route('wishlist.store',['id'=>$product->id])}}" type="button">
              @include('includes.icons.wishlist')
            </a>
            </div>

 <div class="dropdown dropend">
    <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
      Available Discounts
    </button>
    <ul class="dropdown-menu">
        @forelse ($product->discounts as $discount)
        <li class="discountDropdown"><h4><span class="dropdown-item bg-light text-dark text-center" >{{$discount->name}}:</span></h4></li>
        <div style="display: none" class="card w-100 bg-secondary">
            <div class="card-body">
              <h5 class="card-title">Value: <strong>{{$discount->value}}</strong>, Type: <strong>{{$discount->discount_type->name}}</strong></h5>
              <h5><p class="card-text"><strong>{{$discount->code}}</strong></p></h5>
              <span  class="card-link">Start:<strong>{{$discount->start_date ?? 'undefined'}}</strong></span>
              <span  class="card-link">End:<strong> {{$discount->end_date ?? 'undefined'}}</strong></span>
            </div>
          </div>
        @empty
        <li><span class="dropdown-item disabled" href="#">No available discounts</span></li>
        @endforelse
    </ul>
  </div>






    </div>
  </div>

  @endforeach
<button class="btn btn-danger mx-5 my-4 p-2 rounded border" type="submit">Checkout</button>

  </form>








 @else
  <div class="container mx-1 my-3">
    <div class="alert alert-warning text-center">
     <strong>Alert: </strong> There is no Products in Cart !!
    </div>
  </div>
  @endif


@endsection



