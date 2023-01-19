@extends('layouts.layout')
@section('header')
@include('includes.header')
@endsection
@section('content')


{{-- index --}}
<div class="d-flex flex-row justify-content-between">
<div class="w-50 mx-5 my-3">
<h2>List of Categories :</h2>
  <table class="table">
    <thead>
      <tr>
        <th>Name</th>
        <th>Parent Category</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($categories as $category)
      <tr>
        <td>{{$category->name}}</td>
    @if ($category->parent_id!=false)
    <td>{{$category->parent->name}}</td>
     @else
     <td>-</td>
     @endif
        <td>
{{--Actions--}}
<div class="d-inline-flex">
<a type="button" class="btn btn-success mx-2" href="{{route('category.edit',['category'=>$category->id])}}">Edit</a>
<form class="form-inline" method="POST" action="{{route('category.destroy',['category'=>$category->id])}}">
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

{{-- Create Category --}}

<div class="w-25 mx-3">
  <h2>Category :</h2>
  <button type="button" id="createBtn" class=" btn btn-outline-info btn-lg">+</button>
  <button type="button" id="import" class=" btn btn-outline-info btn-lg">import</button>
  <form style="display: none" id="createForm" method="POST" action="{{route('category.store')}}" enctype="multipart/form-data" >
    @csrf
    <div class="mb-3 mt-3">
      <label for="name">Name</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" value="{{old('name')}}" name="name">
        <x-errors name="name"></x-errors>
      </div>
      <div class="mb-3 mt-3">
      <label for="parent_id" class="form-label">Select parent category:</label>
      <select class="form-select" id="parent_id" name="parent_id">
        <option value="{{null}}">none</option>
        @foreach ($categories as $parent)
        <option value="{{$parent->id}}" >{{$parent->name}}</option>
        @endforeach
      </select>
    </div>

      <button type="submit" class="btn btn-primary">create</button>
    </form>

     {{-- Import  Categories via excel file --}}
  <form style="display: none" id="importForm"  method="POST" action="{{route('category.store.excel')}}" enctype="multipart/form-data" >
  @csrf
  <input type="file" class="form-control mx-1 my-3" name="categories">
  <button type="submit" class="btn btn-primary mx-3">Import</button>
  </form>
  {{-- End importing Categories --}}

  </div>

  {{-- End Create Category --}}
</div>


@endsection
