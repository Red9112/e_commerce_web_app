@extends('layouts.layout')
@section('header')
    @include('includes.header')
@endsection
@section('content')

{{-- Create Product --}}
    <div class="container w-50 mt-3 mx-4">
      <h2>Create Product: </h2>
      <form method="POST" action="{{route('product.store')}}" enctype="multipart/form-data">
        @csrf
              <div class="mb-3 mt-3">
              <label for="sku">SKU</label>
              <input type="text" class="form-control @error('sku') is-invalid @enderror"  value="{{old('sku')}}" id="sku" placeholder="Ex:CW21001" name="sku">

<x-errors name="sku"></x-errors>
            </div>
        <div class="mb-3 mt-3">
          <label for="name">Name</label>
            <input type="text" class="form-control  @error('name') is-invalid @enderror" value="{{old('name')}}" id="name"  name="name">

             <x-errors name="name"></x-errors>
          </div>

          @include('includes.addCategory')

                <div class="mb-3 mt-3">
                  <label for="price">Price: </label>
                    <input type="text" class="form-control @error('price') is-invalid @enderror" value="{{old('price')}}" id="price" placeholder="$" name="price">
<x-errors name="price"></x-errors>
                  </div>
          <div class="mb-3 mt-3">
            <label for="qty_in_stock">Quantity</label>
            <input type="text" class="form-control @error('qty_in_stock') is-invalid @enderror" id="qty_in_stock" value="{{old('qty_in_stock')}}" placeholder="Quantity in stock" name="qty_in_stock">
  <x-errors name="qty_in_stock"></x-errors>
          </div>
            <div class="form-group mb-3 mt-3">
              <label for="description">Description: </label>
             <textarea class="form-control" rows="5" id="description" name="description"></textarea>
            </div>
            @include('includes.uploadImage')
          <button type="submit" class="btn btn-primary mb-3 my-3">create</button>
        </form>



      </div>

      {{-- End Create Category --}}


      {{-- // send categories from view to file js : --}}
<div id="objects" data-objects='{{ json_encode($categories) }}'></div>
      {{-- ----------------------- --}}


@endsection
