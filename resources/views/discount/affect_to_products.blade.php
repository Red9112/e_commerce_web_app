@extends('layouts.layout')
@section('header')
@include('includes.header')
@endsection
@section('content')

<div class="p-3 my-3 mx-5 w-50 ">
<h2>Affect discount to products:</h2>
<h3>discount name :<span class="badge bg-success">{{$discount->name}}</span></h3>
<div class="my-3 p-2">
<button type="button" id="disAllProducts" class=" btn btn-outline-info btn-lg mx-2">all products</button>
<form id="disAllProdForm" style="display:none" method="GET" action="{{route('discount_product',['discountId'=>$discount->id])}}" enctype="multipart/form-data" >
    <div class="mx-5 my-4 p-3 bg-light rounded w-50 border">
<div class="form-check">
    <h4>
<input class="selectProduct form-check-input" type="checkbox" name="applyToAll" value="1">
<label for="applyToAll">Apply this discount to all products</label>
    </h4>
</div>
<button type="submit" class="btn btn-success">affect</button>
    </div>
</form>


<button type="button" id="disSpecific" class=" btn btn-outline-info btn-lg ">specify products</button>
<form id="disSpecificForm" style="display:none"  method="GET" action="{{route('discount_product',['discountId'=>$discount->id])}}" enctype="multipart/form-data" >
    @csrf
    <div   class=" mx-5 my-4 p-3 bg-light text-white rounded w-50 border">
          <div class="col-md-12">
            <table class="table">
              <thead>
                <tr>
                  <th>Name</th>
                </tr>
              </thead>
              <tbody>
             @foreach ($products as $product)
                  <tr>
                    <td>
                       <div class="form-check">
                            <input class="selectProduct form-check-input" type="checkbox" name="products[]" value="{{ $product->id }}">
                         <label>{{$product->name}}</label>
                        </div>
                    </td>
                </tr>
                  @endforeach
              </tbody>
            </table>
          </div>
          <button type="submit" class="btn btn-success">affect</button>
        </div>
    </form>

    <button type="button" id="disByCatgr" class=" btn btn-outline-info btn-lg mx-2">add by category</button>
    <form  id="disByCatgrForm" style="display: none"  method="GET" action="{{route('discount_product',['discountId'=>$discount->id])}}" enctype="multipart/form-data" >
        @csrf
        <div   class="mx-5 my-4 p-3 bg-light text-white rounded w-50 border">
              <div class="col-md-12">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Name</th>
                    </tr>
                  </thead>
                  <tbody>
                 @foreach ($categories  as $cat)
                      <tr>
                        <td>
                           <div class="form-check">
                                <input class="selectProduct form-check-input" type="checkbox" name="cats[]" value="{{ $cat->id }}">
                             <label>{{$cat->name}}</label>
                            </div>
                        </td>
                    </tr>
                      @endforeach
                  </tbody>
                </table>
              </div>

              <button type="submit" class="btn btn-success">affect</button>
            </div>
            </form>














        </div>
    </div>
@endsection
