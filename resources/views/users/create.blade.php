@extends('layouts.layout')
@section('header')
@include('includes.header')
@endsection
@section('content')

    <div class="container w-50 mt-3 mx-4">
      <h2>Create User: </h2>
      <form  method="POST" action="{{route('user.store')}}" >
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
    {{-- <div id="roleDiv" class="mb-3 mt-3">
      <label id="label" for="role" class="form-label">Role:</label>
      <select class="form-select @error('role') is-invalid @enderror" id="role" name="role">
        @foreach ($roles as $role)
        @if ($role->name=="customer")
        <option value="{{$role->id}}" selected>{{$role->name}}</option>
        @else
        <option value="{{$role ->id}}" >{{$role->name}}</option>
        @endif
        @endforeach
      </select>
      <x-errors name="role"></x-errors>
    </div>
 <button class="btn btn-outline-info btn-lg" id="clc" type="button">+</button> --}}

 <div id="allDiv" class="mb-3 mt-3">
    <label id="roleLabel" for="role" class="form-label">Role:</label>
    <select class="form-select @error('role') is-invalid @enderror" id="role" name="role">
      @foreach ($roles as $role)
      @if ($role->name=="customer")
      <option value="{{$role->id}}" selected>{{$role->name}}</option>
      @else
      <option value="{{$role ->id}}" >{{$role->name}}</option>
      @endif
      @endforeach
    </select>
    <x-errors name="role"></x-errors>
  </div>
<button class="btn btn-outline-info btn-lg" id="clc" type="button">+</button>









          <button type="submit" class="btn btn-primary my-2">create</button>
        </form>

      </div>



       {{-- // send roles from view to js file=container.js   : --}}
       <div id="objects" data-objects='{{ json_encode($roles) }}'></div>
       {{-- ----------------------- --}}
@endsection
