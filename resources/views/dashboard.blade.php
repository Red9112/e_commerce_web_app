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


<x-display-prod :products="$products"></x-display-prod>




@endsection
