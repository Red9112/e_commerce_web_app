@extends('layouts.layout')
@section('header')
@include('includes.header')
@endsection
@section('content')


{{-- index --}}
<div class="d-flex flex-row justify-content-between">
<div class="w-50 mx-5 my-3">
<h2>List of Discounts :</h2>
  <table class="table">
    <thead>
      <tr>
        <th>Name</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($discounts as $item)
      <tr>
        <td>{{$item->name}}</td>
        <td>
{{--Actions--}}
<div class="d-inline-flex">
<a type="button" class="btn btn-success mx-2" href="{{route('discount.edit',['discount'=>$item->id])}}">Edit</a>
<form class="form-inline" method="POST" action="{{route('discount.destroy',['discount'=>$item->id])}}">
  @csrf
  @method('DELETE')
  <button class="btn btn-danger" type="submit" >Delete </button>
 </form>
</div>
      {{--END_Actions--}}
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>


</div>

{{-- End index --}}

{{-- Create Discount --}}

<div class="w-25 mx-5">
  <h2>Discount :</h2>
  <button type="button" id="createBtn" class=" btn btn-outline-info btn-lg">+</button>
  <form style="display: none" id="createForm" method="POST" action="{{route('discount.store')}}" enctype="multipart/form-data" >
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
                <label for="">Type</label>
                  <input type="text" class="form-control @error('type') is-invalid @enderror" id="type" value="{{old('type')}}" name="type">
                  <x-errors name="type"></x-errors>
                </div>
                <div class="mb-3 mt-3">
                    <label for="">Value Or Percent</label>
                      <input type="number" class="form-control @error('value_percent') is-invalid @enderror" id="value_percent" value="{{old('value_percent')}}" name="value_percent">
                      <x-errors name="value_percent"></x-errors>
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
</div>


@endsection
