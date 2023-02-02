@extends('layouts.layout')
@section('header')
@include('includes.header')
@endsection
@section('content')


{{-- Edit  --}}

    <div class="container w-50 mx-3 my-3">
      <h2>Edit Order Statuses :</h2>
  <form id="editForm" method="POST" action="{{route('orderStatus.update',['orderStatus'=>$order_status->id])}}">
    @method('PUT')
    @csrf
    <div class="mb-3 mt-3">
        <label for="name">Name</label>
          <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" value="{{old('name')}}" name="name">
          <x-errors name="name"></x-errors>
        </div>
        <button  type="submit" class="btn btn-primary">Edit</button>
                               </form>
                                </div>

  {{-- End Edit  --}}


  @endsection
