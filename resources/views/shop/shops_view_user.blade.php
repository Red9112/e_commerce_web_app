@extends('layouts.layout')
@section('header')
@include('includes.header')
@endsection
@section('content')


<div class="container pt-5">
    <div class="row">
@foreach ($shops as $shop)
        <div class="col-sm-3 mx-2">
            <div class="card">
                <img height="200px" class="card-img-top"
                src="{{( $shop->image) ? $shop->image->url():$shop->defaultShopImage()}}" alt="Card image">
                <div class="card-body">
                  <h6 class="card-title">{{$shop->name}}</h6>
                  <p class="card-text"><i class="fa-solid fa-envelope"></i> :{{$shop->email}}</p>
                 <p class="card-text"> <i class="fa-solid fa-phone"></i> : {{$shop->phone_number}}</p>
                  <a href="{{route('display.shop.products',['id'=>$shop->id])}}"
                     class="btn btn-primary">Store products</a>
                </div>
              </div>
        </div>
@endforeach

    </div>
</div>


















@endsection
