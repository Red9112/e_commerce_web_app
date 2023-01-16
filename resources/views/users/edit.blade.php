@extends('layouts.layout')
@section('header')
@include('includes.header')
@endsection
@section('content')
<div class="createCat w-50 ">
    <div class="container mt-3 mx-4">
      <h2>Edit User: </h2>
      <form  id="createForm" method="POST" action="{{route('user.update',['user'=>$user->id])}}" enctype="multipart/form-data" >
        @method('PUT')
        @csrf
        <div class="mb-3 mt-3">
          <label for="name">Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" value="{{old('name')}}" placeholder="Name" name="name" >
            <x-errors name="name"></x-errors>
          </div>
            <div class="mb-3 mt-3"> 
                <label for="email">Email</label>
                  <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" value="{{old('email')}}" placeholder="Email Adress" name="email">
                  <x-errors name="email"></x-errors>
                </div>
                <div class="mb-3 mt-3"> 
                    <label for="email">Password</label>
                      <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror"  value="{{old('password')}}" placeholder="Password" name="password">
                      <x-errors name="password"></x-errors>
                    </div>
                  @include('includes.uploadImage') 
          <button type="submit" class="btn btn-success my-3">Edit</button>
        </form>
        @if ($user->image)
        <img src="{{$user->image->url()}}" class="rounded-circle" alt="profile picture" width="304" height="236">
        @endif
      </div>
      </div>


@endsection