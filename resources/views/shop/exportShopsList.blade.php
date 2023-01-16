@extends('layouts.layout')
@section('header')
    @include('includes.header')
@endsection
@section('content')
<div class="createCat">
<div class="container mt-3">
        
        {{-- Export  Shops List via file --}}
        <p class="h2">Export Shops List : </p>
  <form  method="GET" action="{{route('shop.export')}}" enctype="multipart/form-data" >
    @csrf
    <div class="form-check">
        <input type="radio" class="form-check-input" id="excel" name="optradio" value="excel" checked>Excel
        <label class="form-check-label" for="excel"></label>
      </div>
      <div class="form-check">
        <input type="radio" class="form-check-input" id="html" name="optradio" value="html">html
        <label class="form-check-label" for="html"></label>
      </div>
    <button type="submit" class="btn btn-primary mx-3">Export</button>
    </form>
    {{-- End --}}
    
    </div></div>
@endsection