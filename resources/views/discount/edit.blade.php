@extends('layouts.layout')
@section('header')
@include('includes.header')
@endsection
@section('content')



{{-- Edit Shipping --}}

<div class="container w-50 mx-3 my-3">
    <h2>Edit Shipping Method :</h2>
<form id="editForm" method="POST" action="{{route('shipping.update',['shipping'=>$shipping->id])}}">
  @method('PUT')
  @csrf
  <div class="mb-3 mt-3">
      <label for="name">Name</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" value="{{old('name')}}" name="name">
        <x-errors name="name"></x-errors>
      </div>
  <div class="mb-3 mt-3">
      <label for="price">Price</label>
        <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" value="{{old('price')}}" name="price">
        <x-errors name="price"></x-errors>
      </div>
      <button  type="submit" class="btn btn-primary">Edit</button>
                             </form>
                              </div>

{{-- End Edit Shipping --}}

  @endsection
