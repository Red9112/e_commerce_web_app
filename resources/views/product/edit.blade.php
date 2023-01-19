@extends('layouts.layout')
@section('header')
    @include('includes.header')
@endsection
@section('content')


{{-- Edit Product --}}

    <div class="container w-50 mx-3 my-5">
      <h2>Edit Product :</h2>
  <form id="editForm" method="POST" action="{{route('product.update',['product'=>$product->id])}}" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <div class="mb-3 mt-3">
        <label for="name">Name</label>
        <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{old('name',$product->name ?? null)}}">

         <x-errors name="name"></x-errors>
      </div>
      <div class="mb-3 mt-3">
        <label for="sku">SKU</label>
        <input id="sku" name="sku" type="text" class="form-control @error('sku') is-invalid @enderror" value="{{old('name',$product->sku ?? null)}}">
        <x-errors name="sku"></x-errors>
      </div>

    <x-editCategory :categories="$categories" :productcats="$product->categories"></x-editCategory>

      <div class="mb-3 mt-3">
        <label for="qty_in_stock">Quantity</label>
        <input id="qty_in_stock" name="qty_in_stock" type="text" class="form-control @error('qty_in_stock') is-invalid @enderror" value="{{old('name',$product->qty_in_stock ?? null)}}">
        <x-errors name="qty_in_stock"></x-errors>
      </div>
      <div class="mb-3 mt-3">
        <label for="qty_in_stock">Price</label>
        <input id="price" name="price" type="text" class="form-control @error('price') is-invalid @enderror" value="{{old('price',$product->price ?? null)}}">
        <x-errors name="price"></x-errors>
      </div>
      <div class="form-group mb-3 mt-3">
        <label for="description">Description: </label>
       <textarea class="form-control" rows="5" id="description" name="description">{{old('description',$product->description ?? null)}}</textarea>
      </div>
      @include('includes.uploadImage')
  <button  type="submit" class="btn btn-primary my-3">Edit</button>
    </form>
   {{-- delete product pic --}}
  <div class="d-flex">
        @foreach ($product->images as $image )
        <form class="form-inline" method="POST" action="{{route('image.destroy',['image'=>$image->id])}}">
          @csrf
          @method('DELETE')
         <div class="imageProduct">
        <img src="{{$image->url()}}"  id="ImagedeletePrd" class="rounded mx-2 " alt="" width="304" height="236">
        <button style="display: none" type="submit" id="deleteProductImgBtn" class="btn btn-danger">Delete</button>
      </div>
    </form>
        @endforeach
      </div>

     {{-- End delete --}}
  </div>


  {{-- End Edit Category --}}

      {{-- // send categories from view to file js : --}}
      <div id="objects" data-objects='{{ json_encode($categories) }}'></div>
      {{-- ----------------------- --}}

  @endsection
