@extends('layouts.layout')
@section('header')
@include('includes.header')
@endsection
@section('content')
<a title="Download " href="{{route('pdf')}}">
<svg xmlns="http://www.w3.org/2000/svg" width="80%" height="80" viewBox="0 0 200 24">
<path fill="#f4dab7" d="M26,8V28a2,2,0,0,1-2,2H8a2,2,0,0,1-2-2V4A2,2,0,0,1,8,2H20Z"/>
<path fill="#6d6daa" d="M24,31H8a3,3,0,0,1-3-3V4A3,3,0,0,1,8,1H20a1,1,0,0,1,.71.29l6,6A1,1,0,0,1,27,8V28A3,3,0,0,1,24,31ZM8,3A1,1,0,0,0,7,4V28a1,1,0,0,0,1,1H24a1,1,0,0,0,1-1V8.41L19.59,3Z"/><polygon fill="#d6b5b0" points="26 8 20 8 20 2 26 8"/><path fill="#6d6daa" d="M26 9H20a1 1 0 0 1-1-1V2a1 1 0 0 1 .62-.92 1 1 0 0 1 1.09.21l6 6a1 1 0 0 1 .21 1.09A1 1 0 0 1 26 9zM21 7h2.59L21 4.41zM16 27.06a1 1 0 0 1-.71-.29l-3-3a1 1 0 1 1 1.42-1.41L16 24.65l2.29-2.29a1 1 0 1 1 1.42 1.41l-3 3A1 1 0 0 1 16 27.06z"/><path fill="#6d6daa" d="M16,27.06a1,1,0,0,1-1-1v-14a1,1,0,0,1,2,0v14A1,1,0,0,1,16,27.06Z"/></svg></a>




@endsection