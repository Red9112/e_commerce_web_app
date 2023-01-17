@extends('layouts.layout')
@section('header')
@include('includes.header')
@endsection
@section('content')


{{-- Edit Category --}}
<div class="editCat">
    <div class="container mt-3 mb-3">
      <h2>Edit Category :</h2> 
  <form id="editForm" method="POST" action="{{route('category.update',['category'=>$category->id])}}">
    @method('PUT') 
    @csrf
    <div class="mb-3 mt-3">
        <label for="name">Name</label>
        <input id="name" name="name" type="text" class="form-control  @error('name') is-invalid @enderror" value="{{old('name',$category->name ?? null)}}">
        <x-errors name="name"></x-errors>
      </div>
      <div class="mb-3 mt-3">
      <label for="parent" class="form-label">Select parent category:</label>
      <select class="form-select" id="parent_id" name="parent_id">
        <option value="{{null}}">none</option>
        @foreach ($parent as $item)
        <option value="{{$item->id}}" >{{$item->name}}</option>
        @endforeach
      </select>
    </div> 
      <button  type="submit" class="btn btn-primary">Edit</button>
    </form>
  </div>
  </div>
  {{-- End Edit Category --}}


  @endsection