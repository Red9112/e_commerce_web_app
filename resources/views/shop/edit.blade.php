@extends('layouts.layout')
@section('header')
    @include('includes.header')
@endsection
@section('content')


{{-- Edit Category --}}

    <div class="container w-50 mx-3 my-3">
      <h2>Edit Shop :</h2>
  <form id="editForm" method="POST" action="{{route('shop.update',['shop'=>$shop->id])}}">
    @method('PUT')
    @csrf
    <div class="mb-3 mt-3">
        <label for="name">Name</label>
        <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{old('name',$shop->name ?? null)}}">
        <x-errors name="name"></x-errors>
      </div>

      <div class="mb-3 mt-3">
        <label for="phone_number">Phone number</label>
        <input id="phone_number" name="phone_number" type="text" class="form-control @error('phone_number') is-invalid @enderror" value="{{old('phone_number',$shop->phone_number ?? null)}}">
        <x-errors name="phone_number"></x-errors>
      </div>
      <div class="mb-3 mt-3">
        <label for="email">Email</label>
        <input id="email" name="email" type="text" class="form-control @error('email') is-invalid @enderror" value="{{old('email',$shop->email?? null)}}">
        <x-errors name="email"></x-errors>
      </div>
      <button  type="submit" class="btn btn-primary">Edit</button>
    </form>
  </div>

  {{-- End Edit Category --}}


  @endsection
