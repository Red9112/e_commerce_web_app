@extends('layouts.layout')
@section('header')
@include('includes.header')
@endsection
@section('content')

<div class="row p-3 mx-5 my-3 w-25 bg-light text-white rounded">
<div class="d-flex justify-content-start alert alert-light">
<h4><strong>Shopping Cart :({{$products->count()}})</strong></h4>
 </div>
  </div>
  @foreach ($products as $product)
  <div class="mx-5 mt-4 p-3 bg-light text-white rounded w-50 border">
<img src="{{$product->getFirstImage()}}" class="rounded mx-2 p-1" alt="product photo" width="304" height="236">
<form action="{{route('removeSessionProduct',['id'=>$product->id])}}" method="GET">
    @csrf
    <button  class="btn btn-danger my-1 mx-1" type="submit">remove</button>
</form>
  </div>
  @endforeach




@endsection
