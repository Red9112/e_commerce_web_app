@extends('layouts.layout')
@section('header')
    @include('includes.header')
@endsection
@section('content')

<div class="container my-2">
    <div class="jumbotron">
      <h1>Product details</h1>
      <div class="form-group">
       <x-category :cat="$product->categories"></x-category>
        <label for="sku" class="col-sm-2 control-label">SKU:</label>
        <div class="col-sm-10">
          <input type="text" id="sku" class="form-control"  disabled value="{{$product->sku}}">
        </div>
      </div>
      <div class="form-group">
        <label for="name" class="col-sm-2 control-label">Name:</label>
        <div class="col-sm-10">
          <input type="text" id="name" class="form-control"  disabled value="{{$product->name}}">
        </div>
      </div>
      <div class="form-group">
        <label for="price" class="col-sm-2 control-label">Price</label>
        <div class="col-sm-10">
          <input type="text" id="price" class="form-control"  disabled value="{{ \App\Helpers\Helper::displayPrice($product->price)}}">
        </div>
      </div>
      <div class="form-group">
        <label for="qty_in_stock" class="col-sm-2 control-label">Quantity in stock:</label>
        <div class="col-sm-10">
          <input type="text" id="qty_in_stock" class="form-control"  disabled value="{{$product->qty_in_stock}}">
        </div>
      </div>
      <div class="form-group">
        <label for="description" class="col-sm-2 control-label">Description:</label>
        <div class="col-sm-10">
            <textarea class="form-control" rows="5" id="description" disabled >{{$product->description}}</textarea>
        </div>
      </div>
         {{-- <div class="mt-4 p-5 bg-primary text-white rounded"> --}}
          @foreach ($product->images as $image )
          <img src="{{$image->url()}}" class="rounded mx-2 p-1" alt="product photo" width="304" height="236">
          @endforeach
        {{-- </div> --}}
  </div>

  <div class="card w-75  ">
    <x-comment :id="$product->id" :action="route('storeProductComment',['id'=>$product->id])"></x-comment>
    <x-displayComments :comments="$product->comments"></x-displayComments>
  </div>

  </div>


@endsection
