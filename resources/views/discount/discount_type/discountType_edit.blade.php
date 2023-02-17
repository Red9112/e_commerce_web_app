@extends('layouts.layout')
@section('header')
@include('includes.header')
@endsection
@section('content')



{{-- Edit  --}}

<div class="container w-50 mx-3 my-3">
    <h2>Edit Discount Type:</h2>
<form id="editForm" method="POST" action="{{route('discount_type.update',['discount_type'=>$type->id])}}">
@method('PUT')
@csrf
<div class="mb-3 mt-3">
    <label for="name">Name</label>
    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" value="{{$type->name}}" name="name">
    <x-errors name="name"></x-errors>
    </div>
    <div class="form-group mb-3 mt-3">
    <label for="description">Description: </label>
    <textarea class="form-control" rows="5" id="description" name="description">{{$type->description}}</textarea>
    </div>
    <button  type="submit" class="btn btn-primary">Edit</button>
    </form>
    </div>

{{-- End Edit  --}}
@endsection
