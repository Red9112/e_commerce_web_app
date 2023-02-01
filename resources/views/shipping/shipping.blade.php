@extends('layouts.layout')
@section('header')
@include('includes.header')
@endsection
@section('content')


{{-- index --}}
<div class="d-flex flex-row justify-content-between">
<div class="w-50 mx-5 my-3">
<h2>List of Shipping methods :</h2>
  <table class="table">
    <thead>
      <tr>
        <th>Name</th>
        <th>Price</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($shippings as $item)
      <tr>
        <td>{{$item->name}}</td>
        <td>{{$item->price}}</td>
        <td>
{{--Actions--}}
<div class="d-inline-flex">
<a type="button" class="btn btn-success mx-2" href="{{route('shipping.edit',['shipping'=>$item->id])}}">Edit</a>
<form class="form-inline" method="POST" action="{{route('shipping.destroy',['shipping'=>$item->id])}}">
  @csrf
  @method('DELETE')
  <button class="btn btn-danger" type="submit" >Delete </button>
 </form>
</div>
      {{--END_Actions--}}
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>


</div>

{{-- End index --}}

{{-- Create Shipping --}}

<div class="w-25 mx-5">
  <h2>Shipping :</h2>
  <button type="button" id="createBtn" class=" btn btn-outline-info btn-lg">+</button>
  <form style="display: none" id="createForm" method="POST" action="{{route('shipping.store')}}" enctype="multipart/form-data" >
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

      <button type="submit" class="btn btn-primary">create</button>
    </form>

  </div>

  {{-- End Create shipping --}}
</div>


@endsection
