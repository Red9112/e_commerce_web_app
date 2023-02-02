@extends('layouts.layout')
@section('header')
@include('includes.header')
@endsection
@section('content')


<div class="w-25 mx-5 my-3">
    <h2>Create Address :</h2>
    <form id="createForm" method="POST" action="{{route('address.store')}}" enctype="multipart/form-data" >
      @csrf
      <div class="mb-3 mt-3">
        <label for="street_number">Street Number</label>
          <input type="text" class="form-control @error('street_number') is-invalid @enderror" id="street_number" value="{{old('street_number')}}" name="street_number">
          <x-errors name="street_number"></x-errors>
        </div>
        <div class="mb-3 mt-3">
            <label for="address">Address</label>
              <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" value="{{old('address')}}" name="address">
              <x-errors name="address"></x-errors>
            </div>
            <div class="mb-3 mt-3">
                <label for="region">Region</label>
                  <input type="text" class="form-control @error('region') is-invalid @enderror" id="region" value="{{old('region')}}" name="region">
                  <x-errors name="region"></x-errors>
                </div>
                <div class="mb-3 mt-3">
                    <label for="postal_code">Postal Code</label>
                      <input type="text" class="form-control @error('postal_code') is-invalid @enderror" id="postal_code" value="{{old('postal_code')}}" name="postal_code">
                      <x-errors name="postal_code"></x-errors>
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="country">Country</label>
                          <input type="text" class="form-control @error('country') is-invalid @enderror" id="country" value="{{old('country')}}" name="country">
                          <x-errors name="country"></x-errors>
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="city">City</label>
                              <input type="text" class="form-control @error('city') is-invalid @enderror" id="city" value="{{old('city')}}" name="city">
                              <x-errors name="city"></x-errors>
                            </div>
                        <div class="mb-3 mt-3">
                            <label for="is_default" class="form-label">Is a default address:</label>
                            <select class="form-select" id="is_default" name="is_default">
                              <option value="0">True</option>
                              <option value="1" >false</option>
                            </select>
                          </div>

        <button type="submit" class="btn btn-primary">create</button>
      </form>

    </div>

    {{-- End Create  --}}
  </div>


  @endsection
