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
  <h3 class="mx-5 my-4">Cart:</h3>
  @foreach ($products as $product)
  <div class="mx-5 my-4 p-3 bg-light text-white rounded w-50 border">
<img src="{{$product->getFirstImage()}}" class="rounded mx-2 p-1" alt="product photo" width="304" height="236">
<form action="{{route('removeSessionProduct',['id'=>$product->id])}}" method="GET">
    @csrf
    <button  class="btn btn-danger rounded mx-2 p-1" type="submit">remove</button>
</form>
  </div>

  @endforeach
 <h3 class="mx-5 my-4">Wishlist:</h3>
  @foreach ($cartWishlist as $product)
  <div class="mx-5 my-4 p-3 bg-light text-white rounded w-50 border">
<img src="{{$product->getFirstImage()}}" class="rounded mx-2 p-1" alt="product photo" width="304" height="236">
<div><a href="{{route('wishlist.destroy',['id'=>$product->id])}}" class="btn btn-danger rounded mx-2 p-1" type="button">remove from Wishlist</a></div>
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





