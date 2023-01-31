@extends('layouts.layout')
@section('header')
@include('includes.header')
@endsection
@section('content')
<style>

  </style>
@if ($products!=null)
<div class="row p-3 mx-5 my-3 w-25 bg-light text-white rounded">
<div class="d-flex justify-content-start alert alert-light">
<h4><strong>Shopping Cart :({{$products->count()}})</strong></h4>
 </div>
  </div>
  <h1 class="mx-5 my-5 title">Cart:</h1>
  @foreach ($products as $product)
  <div class="d-flex mx-5 my-4 p-3 bg-light text-white rounded w-50 border">
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
          <input value="1" id="quantity" class="prd_cart_info form-control mt-2" type="number" >
        </div>
        <div class="d-flex my-3">
            <form action="{{route('removeSessionProduct',['id'=>$product->id])}}" method="GET">
            @csrf
            <button style="border: 0" type="submit">
            <svg width="35" height="35" viewBox="0 0 1024 1024" class="icon"  version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M667.8 362.1H304V830c0 28.2 23 51 51.3 51h312.4c28.4 0 51.4-22.8 51.4-51V362.2h-51.3z" fill="#CCCCCC" /><path d="M750.3 295.2c0-8.9-7.6-16.1-17-16.1H289.9c-9.4 0-17 7.2-17 16.1v50.9c0 8.9 7.6 16.1 17 16.1h443.4c9.4 0 17-7.2 17-16.1v-50.9z" fill="#CCCCCC" /><path d="M733.3 258.3H626.6V196c0-11.5-9.3-20.8-20.8-20.8H419.1c-11.5 0-20.8 9.3-20.8 20.8v62.3H289.9c-20.8 0-37.7 16.5-37.7 36.8V346c0 18.1 13.5 33.1 31.1 36.2V830c0 39.6 32.3 71.8 72.1 71.8h312.4c39.8 0 72.1-32.2 72.1-71.8V382.2c17.7-3.1 31.1-18.1 31.1-36.2v-50.9c0.1-20.2-16.9-36.8-37.7-36.8z m-293.5-41.5h145.3v41.5H439.8v-41.5z m-146.2 83.1H729.5v41.5H293.6v-41.5z m404.8 530.2c0 16.7-13.7 30.3-30.6 30.3H355.4c-16.9 0-30.6-13.6-30.6-30.3V382.9h373.6v447.2z" fill="#211F1E" /><path d="M511.6 798.9c11.5 0 20.8-9.3 20.8-20.8V466.8c0-11.5-9.3-20.8-20.8-20.8s-20.8 9.3-20.8 20.8v311.4c0 11.4 9.3 20.7 20.8 20.7zM407.8 798.9c11.5 0 20.8-9.3 20.8-20.8V466.8c0-11.5-9.3-20.8-20.8-20.8s-20.8 9.3-20.8 20.8v311.4c0.1 11.4 9.4 20.7 20.8 20.7zM615.4 799.6c11.5 0 20.8-9.3 20.8-20.8V467.4c0-11.5-9.3-20.8-20.8-20.8s-20.8 9.3-20.8 20.8v311.4c0 11.5 9.3 20.8 20.8 20.8z" fill="#211F1E" /></svg>
            </button>
            </form>
            <a href="{{route('wishlist.store',['id'=>$product->id])}}" type="button">
            <svg width="35px" height="35px" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg" stroke-width="3" stroke="red" fill="none"><path d="M9.06,25C7.68,17.3,12.78,10.63,20.73,10c7-.55,10.47,7.93,11.17,9.55a.13.13,0,0,0,.25,0c3.25-8.91,9.17-9.29,11.25-9.5C49,9.45,56.51,13.78,55,23.87c-2.16,14-23.12,29.81-23.12,29.81S11.79,40.05,9.06,25Z"/></svg>
            </a>
            </div>
    </div>
  </div>

  @endforeach

 @else
  <div class="container mx-1 my-3">
    <div class="alert alert-warning text-center">
     <strong>Alert: </strong> There is no Products in Cart !!
    </div>
  </div>
  @endif





@endsection





