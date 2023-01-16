@extends('layouts.layout')
@section('header')
@include('includes.header')
@endsection
@section('content')
<div class="card  mx-1 my-1" style="width:400px">
    <img class="card-img-top " 
    src="{{( $user->image) ? $user->image->url():$user->defaultImage()}}" 
    alt="profile picture" style="width:100%">
    <div class="card-body">
      <h4 class="card-title">{{$user->name}}</h4>
      <h5 class="card-title">{{$user->email}}</h5>
    </div>
    @can('update', $user) 
<a class="btn btn-success my-1 mx-1" href="{{route('user.edit',['user'=>$user->id])}}">Edit</a>
@endcan
  </div>
@endsection