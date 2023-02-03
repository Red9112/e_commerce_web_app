@extends('layouts.layout')
@section('header')
@include('includes.header')
@endsection
@section('content')


{{-- Create Discount --}}


<div class="w-25 mx-5">
    <h2>Create Discount :</h2>
    <form id="createForm" method="POST" action="{{route('discount.store')}}" enctype="multipart/form-data" >
        @csrf
        <div class="mb-3 mt-3">
            <label for="code">Code</label>
              <input type="text" class="form-control @error('code') is-invalid @enderror" id="code" value="{{old('code')}}" name="code">
              <x-errors name="code"></x-errors>
             </div>
             <div class="mb-3 mt-3">
                <label for="name">Name</label>
                  <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" value="{{old('name')}}" name="name">
                  <x-errors name="name"></x-errors>
                </div>
                <div class="mb-3 mt-3">
                    <label for="discount_type_id">Type</label>
                    <select class="form-select @error('discount_type_id') is-invalid @enderror" id="discount_type_id" name="discount_type_id">
                    <option  selected disabled hidden>Choose...</option>
                    @foreach ($types as $type)
                    <option value="{{$type->id}}">{{$type->name}}</option>
                    @endforeach
                    </select>
                  <x-errors name="discount_type_id"></x-errors>
                  </div>
                   <div class="mb-3 mt-3">
                      <label for="value">Value</label>
                        <input type="number" class="form-control @error('value') is-invalid @enderror" id="value" value="{{old('value')}}" name="value">
                        <x-errors name="value"></x-errors>
                      </div>
                      <div class="mb-3 mt-3">
                          <label for="">Description</label>
                          <textarea class="form-control" rows="5" id="description" value="{{old('description')}}" name="description"></textarea>
                            <x-errors name="description"></x-errors>
                          </div>
                          <div class="mb-3 mt-3">
                              <label for="">Start Date</label>
                                <input type="date" class="form-control @error('start_date') is-invalid @enderror" id="start_date" value="{{old('start_date')}}" name="start_date">
                                <x-errors name="start_date"></x-errors>
                              </div>
                              <div class="mb-3 mt-3">
                                  <label for="">Expired Date</label>
                                    <input type="date" class="form-control @error('end_date') is-invalid @enderror" id="end_date" value="{{old('end_date')}}" name="end_date">
                                    <x-errors name="end_date"></x-errors>
                                  </div>
          <button type="submit" class="btn btn-primary">create</button>
        </form>
    </div>

    {{-- End Create Discount --}}









    @endsection
