@extends('layouts.layout')
@section('header')
@include('includes.header')
@endsection
@section('content')



<center><h2> 
<a class="nav-link justify-content-center" href="{{route('dashboard')}}">{{__('welcome')}}</a>
</h2></center>

<x-display-prod :products="$products"></x-display-prod>






@endsection







