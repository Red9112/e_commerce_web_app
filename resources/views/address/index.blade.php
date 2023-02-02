@extends('layouts.layout')
@section('header')
@include('includes.header')
@endsection
@section('content')


{{-- index --}}
<div class="d-flex flex-row justify-content-between">
<div class="w-50 mx-5 my-3">
    <a id="createBtn"  class=" btn btn-outline-info btn-lg my-3" href="{{route('address.create')}}">+</a>
<h2>List of Addresses :</h2>
  <table class="table text-center">
    <thead>
      <tr>
        <th>address</th>
        <th>street_number</th>
        <th>city</th>
        <th>region</th>
        <th>postal_code</th>
        <th>country</th>
        <th>is_default</th>
        <th>user</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($addresses as $item)
      <tr>
        <td>{{$item->address}}</td>
        <td>{{$item->street_number}}</td>
        <td>{{$item->city}}</td>
        <td>{{$item->region}}</td>
        <td>{{$item->postal_code}}</td>
        <td>{{$item->country}}</td>
        <td>{{$item->is_default}}</td>
        <td><a class="btn" href="{{route('user.show',['user'=>$item->user->id])}}">{{$item->user->name}}</a></td>
        <td>
{{--Actions--}}
<div class="d-inline-flex">
<a type="button" class="btn btn-success mx-2" href="{{route('address.edit',['address'=>$item->id])}}">Edit</a>
<form class="form-inline" method="POST" action="{{route('address.destroy',['address'=>$item->id])}}">
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
@endsection
