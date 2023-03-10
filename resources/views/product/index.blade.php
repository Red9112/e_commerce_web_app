@extends('layouts.layout')
@section('header')
    @include('includes.header')
@endsection
@section('content')




{{-- index --}}
<div class="">
    <div class="container mt-3 mx-3">
      @if ($products!=null)
      <h2 class="my-3">My products:</h2>
      <div class="d-flex mb-5">
      <a   class=" btn btn-outline-info btn-lg me-2 my-3" href="{{route('product.create')}}">+</a>
          <div class="w-75 my-3 d-flex justify-content-center "><x-search route='product.index'>
              <select class="form-select me-2 w-25" id="searchTypeSelect" name="search_by">
               <option value="none" hidden>By</option>
               <option value="name" >name</option>
               <option value="sku" >sku</option>
               <option value="category" >category</option>
               </select>
       </x-search></div>
    </div>
      <table class="table">
        <thead>
          <tr>
            <th>Image</th>
            <th>Sku</th>
            <th>Name</th>
            <th>Quantity</th>
            <th>Category</th>
            <th>Actions</th>
          </tr>
        </thead>

        <tbody>
          @forelse($products as $product)
          <tr>
            <td> <img src="{{$product->getFirstImage()}}" class="rounded-circle" alt="Cinque Terre" width="70" height="70"></td>
            <td>{{$product->sku}}</td>
            <td>{{$product->name}}</td>
        <td>{{$product->qty_in_stock}}</td>
        <td> @foreach ($product->categories as $category) {{$category->name}}, @endforeach</td>
            <td>
             {{--Actions--}}
    <div class="d-inline-flex">
     <a type="button" class="btn btn-success my-1 mx-1" href="{{route('product.edit',['product'=>$product->id])}}">Edit</a>
     <a class="btn btn-info my-1 mx-1" href="{{route('product.show',['product'=>$product->id])}}">Detail</a>
     <form class="form-inline" method="POST" action="{{route('product.destroy',['product'=>$product->id])}}">
      @csrf
      @method('DELETE')
      <button class="btn btn-danger my-1 mx-1" type="submit" >Delete </button>
     </form>
    </div>
          {{--END_Actions--}}
          </td>
          </tr>
          @empty
          <div class="container mx-1 my-3">
          <div class="alert alert-warning text-center">
           <strong>Alert: </strong> There is no Products found !!
          </div>
        </div>
          @endforelse
        </tbody>
      </table>
    @else
   <center> <div><h3><x-badge val="warning mx-3 my-3">You don't have shop !!</x-badge></h3></div> </center>
      @endif



    </div>
    </div>
    {{-- End index --}}








@endsection
