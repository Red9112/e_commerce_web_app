@extends('layouts.layout')
@section('header')
@include('includes.header')
@endsection
@section('content')


{{-- Edit Discount --}}

    <div class="container w-50 mx-3 my-3">
      <h2>Edit Discount :</h2>
  <form id="editForm" method="POST" action="{{route('discount.update',['discount'=>$discount->id])}}">
    @method('PUT')
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
                  <label for="type">Type</label>
                    <input type="text" class="form-control @error('type') is-invalid @enderror" id="type" value="{{old('type')}}" name="type">
                    <x-errors name="type"></x-errors>
                  </div>
                  <div class="mb-3 mt-3">
                      <label for="value_percent">Value Or Percent</label>
                        <input type="number" class="form-control @error('value_percent') is-invalid @enderror" id="value_percent" value="{{old('value_percent')}}" name="value_percent">
                        <x-errors name="value_percent"></x-errors>
                      </div>
                      <div class="mb-3 mt-3">
                          <label for="description">Description</label>
                          <textarea class="form-control" rows="5" id="description" value="{{old('description')}}" name="description"></textarea>
                            <x-errors name="description"></x-errors>
                          </div>
                          <div class="mb-3 mt-3">
                              <label for="start_date">Start Date</label>
                                <input type="date" class="form-control @error('start_date') is-invalid @enderror" id="start_date" value="{{old('start_date')}}" name="start_date">
                                <x-errors name="start_date"></x-errors>
                              </div>
                                  <div class="mb-3 mt-3">
                                    <label for="end_date">Expired Date</label>
                                      <input type="date" class="form-control @error('end_date') is-invalid @enderror" id="end_date" value="{{old('end_date')}}" name="end_date">
                                      <x-errors name="end_date"></x-errors>
                                    </div>
                                        <div class="mb-3 mt-3">
                                            <label for="expired" class="form-label">Status:</label>
                                            <select class="form-select" id="expired" name="expired">
                                              <option value="0">Active</option>
                                              <option value="1" >Expired</option>
                                            </select>
                                          </div>
                                          <button  type="submit" class="btn btn-primary">Edit</button>
                                      </div>
                               </form>
                                </div>

  {{-- End Edit Discount --}}


  @endsection
