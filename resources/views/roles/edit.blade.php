@extends('layouts.layout')
@section('header')
    @include('includes.header')
@endsection
@section('content')


{{-- Edit Category --}}

    <div class="container  mx-3 my-3">
      <h2>Edit role :</h2>
      <div class="w-25">
    <form id="editForm" method="POST" action="{{route('role.update',['role'=>$role->id])}}">
    @method('PUT')
    @csrf
    <div class="mb-3 mt-3">
        <label for="name">Name</label>
        <input id="name" name="name" type="text" class="form-control  @error('name') is-invalid @enderror" value="{{old('name',$role->name ?? null)}}">
        <x-errors name="name"></x-errors>
      </div>
      <button  type="submit" class="btn btn-primary">Edit</button>
    </form>
</div>
  </div>

  {{-- End Edit Category --}}


  @endsection
