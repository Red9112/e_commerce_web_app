@extends('layouts.layout')
@section('header')
@include('includes.header')
@endsection
@section('content')

<center>
<a class="nav-link" href="{{route('dashboard')}}">
<h2>{{__('welcome')}}</h2>
</a>


</center>
@auth
<a  id="plus" class=" btn btn-outline-info btn-lg mx-3" href="{{route('user.index')}}">Users</a>
@endauth
<x-category :cat="$categories"></x-category>

<x-display-prod :products="$products"></x-display-prod>


@endsection