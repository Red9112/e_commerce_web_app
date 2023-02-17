@extends('layouts.layout')
@section('header')
@include('includes.header')
@endsection
@section('content')

<div class="d-flex flex-row justify-content-between">
    <div class="w-100 m-5  p-3">
    <h2>Create Discount Type :</h2>
    <button type="button" id="createBtn" class=" btn btn-outline-info btn-lg my-3">+</button>
    <div class="w-50">
    <form style="display: none" id="createForm" method="POST" action="{{route('discount_type.store')}}" enctype="multipart/form-data" >
      @csrf
        <div class="mb-3 mt-3">
          <label for="name">Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" value="{{old('name')}}" name="name">
            <x-errors name="name"></x-errors>
          </div>
            <div class="form-group mb-3 mt-3">
              <label for="description">Description: </label>
             <textarea class="form-control" rows="5" id="description" name="description"></textarea>
            </div>
        <button type="submit" class="btn btn-primary">create</button>
      </form>
    </div>
      <div class="col-md-6">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Name</th>
              <th>Description</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($types as $type)
              <tr>
                <td>{{$type->name}}</td>
                <td>{{$type->description}}</td>
                <td>
                 <div class="d-inline-flex">
                  <a type="button" class="btn btn-success mx-2" href="{{route('discount_type.edit',['discount_type'=>$type->id])}}">Edit</a>
             <form class="form-inline" method="POST" action="{{route('discount_type.destroy',['discount_type'=>$type->id])}}">
              @csrf
                  @method('DELETE')
                   <button class="btn btn-danger" type="submit" >del</button>
                   </form>
                   </div>

            </td>
            </tr>
              @endforeach
          </tbody>
        </table>
      </div>
    </div>
    </div>


    {{-- End Create --}}
@endsection
