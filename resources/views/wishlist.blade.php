
@extends('layouts.layout')
@section('header')
@include('includes.header')
@endsection
@section('content')


@if ($products!=null)

  <h1 class="mx-5 my-5 title">Wishlist:({{$products->count()}})</h1>

 @foreach ($products as $product)
 <div class="d-flex mx-5 my-4 p-3 bg-light text-white rounded w-50 border">
    <div>
        <img src="{{$product->getFirstImage()}}" class="rounded" alt="product photo" width="304" height="236">
    </div>
    <div>
        <div>
        <h3 class="product-title">{{ $product->name }}</h3>
           <div class="prd_cart_info">
             <span class="mr-2">Price: </span><span class="price-value"> {{ $product->price }}</span>
           </div>
       </div>
       <div class="d-flex">
        <div><a href="{{route('wishlist.destroy',['id'=>$product->id])}}" class="btn" type="button">
            <svg width="35" height="35" viewBox="0 0 1024 1024" class="icon"  version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M667.8 362.1H304V830c0 28.2 23 51 51.3 51h312.4c28.4 0 51.4-22.8 51.4-51V362.2h-51.3z" fill="#CCCCCC" /><path d="M750.3 295.2c0-8.9-7.6-16.1-17-16.1H289.9c-9.4 0-17 7.2-17 16.1v50.9c0 8.9 7.6 16.1 17 16.1h443.4c9.4 0 17-7.2 17-16.1v-50.9z" fill="#CCCCCC" /><path d="M733.3 258.3H626.6V196c0-11.5-9.3-20.8-20.8-20.8H419.1c-11.5 0-20.8 9.3-20.8 20.8v62.3H289.9c-20.8 0-37.7 16.5-37.7 36.8V346c0 18.1 13.5 33.1 31.1 36.2V830c0 39.6 32.3 71.8 72.1 71.8h312.4c39.8 0 72.1-32.2 72.1-71.8V382.2c17.7-3.1 31.1-18.1 31.1-36.2v-50.9c0.1-20.2-16.9-36.8-37.7-36.8z m-293.5-41.5h145.3v41.5H439.8v-41.5z m-146.2 83.1H729.5v41.5H293.6v-41.5z m404.8 530.2c0 16.7-13.7 30.3-30.6 30.3H355.4c-16.9 0-30.6-13.6-30.6-30.3V382.9h373.6v447.2z" fill="#211F1E" /><path d="M511.6 798.9c11.5 0 20.8-9.3 20.8-20.8V466.8c0-11.5-9.3-20.8-20.8-20.8s-20.8 9.3-20.8 20.8v311.4c0 11.4 9.3 20.7 20.8 20.7zM407.8 798.9c11.5 0 20.8-9.3 20.8-20.8V466.8c0-11.5-9.3-20.8-20.8-20.8s-20.8 9.3-20.8 20.8v311.4c0.1 11.4 9.4 20.7 20.8 20.7zM615.4 799.6c11.5 0 20.8-9.3 20.8-20.8V467.4c0-11.5-9.3-20.8-20.8-20.8s-20.8 9.3-20.8 20.8v311.4c0 11.5 9.3 20.8 20.8 20.8z" fill="#211F1E" /></svg>
         </a></div>
         <div>
            <form method="GET" action="{{route('addToCart')}}">
                <input hidden  type="text" name="idprd" id="idprd" value="{{$product->id}}">
                <button class="btn btn-info mt-2" type="submit" >
                    add to cart
                  </button>
              </form>
            </div>
       </div>
    </div>



 </div>

 @endforeach




 @else
  <div class="container mx-1 my-3">
    <div class="alert alert-warning text-center">
     <strong>Alert: </strong> There is no Products in Wishlist !!
    </div>
  </div>
  @endif
 @endsection
