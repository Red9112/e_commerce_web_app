@extends('layouts.layout')
@section('header')
@include('includes.header')
@endsection
@section('content')

<div class="container mt-3 d-flex">
    <div class="alert alert-light">
      <strong>Shopping Cart ({{$products->count}})</strong>
    </div>
  </div>
{{-- <form action="{{route('removeSessionProduct',['id'=>$product->id])}}" method="GET">
    @csrf
    <button  class="btn btn-danger my-1 mx-1" type="submit">remove</button>
</form> --}}

@endsection
