@extends('layouts.layout')
@section('header')
    @include('includes.header')
@endsection
@section('content')

{{-- Create Category --}}
    <div class="container w-50 mt-3 mx-4">
      <h2>Create Shop: </h2>
      <form  method="POST" action="{{route('shop.store')}}" >
        @csrf
        <div class="mb-3 mt-3">
          <label for="name">Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" value="{{old('name')}}" name="name" >
            <x-errors name="name"></x-errors>
          </div>
          <div class="mb-3 mt-3">
            <label for="phone_number">Phone Number</label>
             <input type="text" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number" value="{{old('phone_number')}}" placeholder="Ex:0976458231" name="phone_number">

              <x-errors name="phone_number"></x-errors>
            </div>
            <div class="mb-3 mt-3">
                <label for="email">Email</label>
                  <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" value="{{old('email')}}" placeholder="Email Adress" name="email">
                  <x-errors name="email"></x-errors>
                </div>
                <div class="mb-3 mt-3">
                <label for="user_id" class="form-label">Select Vender :</label>
      <select class="form-select" id="user_id" name="user_id">
        <option  selected disabled hidden>Choose...</option>
        @foreach ($users as $user)
        <option value="{{$user->id}}" >{{$user->name}}</option>
        @endforeach
      </select>
    </div>
          <button type="submit" class="btn btn-primary">create</button>
        </form>

      </div>

      {{-- End Create Category --}}

@endsection
