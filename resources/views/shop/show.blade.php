@extends('layouts.layout')
@section('header')
    @include('includes.header')
@endsection
@section('content')

<div class="card" style="width:400px">
    {{-- <img class="card-img-top " src="https://botble.b-cdn.net/farmart/storage/stores/8-150x150.png" alt="Card image" style="width:100%"> --}}
    <img class="card-img-top "
    src="{{( $shop->image) ? $shop->image->url():$shop->defaultShopImage()}}"
     alt="Card image" style="width:100%">
    <div class="card-body">
      <h4 class="card-title">{{$shop->name}}</h4>
      <h4 class="card-title">{{$shop->user->name}}</h4>
      <i class="fa fa-phone fa-lg mx-1 my-2" aria-hidden="true">  {{$shop->phone_number}}</i>
      <h5 class="card-title">{{$shop->email}}</h5>




    </div>
  </div>
@endsection
