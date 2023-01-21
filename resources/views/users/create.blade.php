@extends('layouts.layout')
@section('header')
@include('includes.header')
@endsection
@section('content')

    <div class="container w-50 mt-3 mx-4">
      <h2>Create User: </h2>
      <form  method="POST" action="{{route('user.store')}}" enctype="multipart/form-data">
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
                    <label for="email">Password</label>
                      <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password">
                      <x-errors name="password"></x-errors>
                    </div>

                    @include('includes.uploadImage')

            @if ($user==null||!$user->hasRole('admin'))
            <div id="allDiv" class="mb-3 mt-3">
                <label id="roleLabel" for="role" class="form-label">Role:</label>
                <select class="form-select @error('role') is-invalid @enderror" id="role" name="role">
               @foreach ($roles as $item)
               @if ($item->name=="customer" )
               <option value="{{$item->id}}" selected>{{$item->name}}</option>
               @endif
               @if ($item->name=="vendor" )
               <option value="{{$item->id}}" selected>{{$item->name}}</option>
               @endif
               @endforeach
               </select>
               </div>
            @elseif  ($user->hasRole('admin'))
            <x-create-select idLabel="roleLabel" selectType="role" :objects="$roles">Role:</x-create-select>
           @endif
          <button type="submit" class="btn btn-primary my-2">create</button>
        </form>

      </div>




@endsection
