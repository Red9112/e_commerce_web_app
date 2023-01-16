@extends('layouts.layout')
@section('header')
@include('includes.header')
@endsection
@section('content') 

<div class="container mt-3 mx-3">
<h2>New Blog</h2>
<form method="POST" action="{{route('blog.store')}}">
   
    @include('blogs.forms')
    @include('includes.addCategory')

        <button class="btn btn-block btn-primary my-2" type="submit" >Add Blog </button>
   
</form>
</div>



      {{-- // send categories from view to file js : --}}
      <div id="categories" data-categories='{{ json_encode($categories) }}'></div>
      {{-- ----------------------- --}}
@endsection