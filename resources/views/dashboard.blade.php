@extends('layouts.layout')
@section('header')
@include('includes.header')
@endsection
@section('content')



<center>
<a class="welcomeTitle nav-link justify-content-center" href="{{route('dashboard')}}">{{__('welcome')}}</a>
</center>

<x-display-prod :products="$products"></x-display-prod>






@endsection







