@extends('layouts.layout')
@section('header')
@include('includes.header')
@endsection
@section('content')



{{-- Edit Shipping --}}

<div class="container w-50 mx-3 my-3">
    <h2>Edit Discount :</h2>
<form id="editForm" method="POST" action="{{route('discount.update',['discount'=>$discount->id])}}">
  @method('PUT')
  @csrf
  <div class="mb-3 mt-3">
    <label for="code">Code</label>
      <input type="text" class="form-control @error('code') is-invalid @enderror" id="code" value="{{old('code',$discount->code)}}" name="code">
      <x-errors name="code"></x-errors>
    </div>
  <div class="mb-3 mt-3">
      <label for="name">Name</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" value="{{old('name',$discount->name)}}" name="name">
        <x-errors name="name"></x-errors>
      </div>
      <div class="mb-3 mt-3">
        <label for="discount_type_id">Type</label>
        <select class="form-select @error('discount_type_id') is-invalid @enderror" id="discount_type_id" name="discount_type_id">
        <option   disabled hidden>Choose...</option>
        @foreach ($types as $type)
        <option value="{{$type->id}}" @if ($discount->type==$type->name)selected @endif>{{$type->name}}</option>
        @endforeach
        </select>
      <x-errors name="discount_type_id"></x-errors>
      </div>
      <div class="mb-3 mt-3">
          <label for="">Value</label>
            <input type="number" class="form-control @error('value') is-invalid @enderror" id="value" value="{{old('value',$discount->value)}}" name="value">
            <x-errors name="value"></x-errors>
          </div>
          <div class="mb-3 mt-3">
            <label for="">Description</label>
            <textarea class="form-control" rows="5" id="description"  name="description">{{old('description',$discount->description)}}</textarea>
              <x-errors name="description"></x-errors>
            </div>
            <div class="mb-3 mt-3">
                <label for="">Start Date</label>
                  <input type="date" class="form-control @error('start_date') is-invalid @enderror" id="start_date" value="{{old('start_date',$discount->start_date)}}" name="start_date">
                  <x-errors name="start_date"></x-errors>
                </div>
                <div class="mb-3 mt-3">
                    <label for="">Expired Date</label>
                      <input type="date" class="form-control @error('end_date') is-invalid @enderror" id="end_date" value="{{old('end_date',$discount->end_date)}}" name="end_date">
                      <x-errors name="end_date"></x-errors>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="expired" name="expired"  @if($discount->expired)checked @endif>
                        <label class="form-check-label" for="expired">Is Expired</label>
                      </div>
      <button  type="submit" class="btn btn-primary">Edit</button>
                             </form>
                              </div>

{{-- End Edit Shipping --}}

  @endsection
