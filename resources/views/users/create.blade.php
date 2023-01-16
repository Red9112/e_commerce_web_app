@extends('layouts.layout')
@section('header')
@include('includes.header')
@endsection
@section('content')
<div class="createCat w-50 ">
    <div class="container mt-3 mx-4">
      <h2>Create User: </h2>
      <form  id="createForm" method="POST" action="{{route('user.store')}}" >
        @csrf
        <div class="mb-3 mt-3">
          <label for="name">Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"placeholder="Name" name="name" >
            <x-errors name="name"></x-errors>
          </div>
            <div class="mb-3 mt-3"> 
                <label for="email">Email</label>
                  <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Email Adress" name="email">
                  <x-errors name="email"></x-errors>
                </div>
                <div class="mb-3 mt-3"> 
                    <label for="email">Email</label>
                      <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password">
                      <x-errors name="password"></x-errors>
                    </div>
                    @include('includes.uploadImage')
          <button type="submit" class="btn btn-primary">create</button>
        </form>
       
      </div>
      </div>

@endsection