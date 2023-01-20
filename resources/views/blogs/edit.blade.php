@extends('layouts.layout')
@section('header')
@include('includes.header')
@endsection
@section('content')
<div class="container mt-3 my-3">
<h2>Edit Blog</h2>
<form method="POST" action="{{route('blog.update',['blog'=>$blog])}}">
  @method('PUT')
  @include('blogs.forms')

  <x-edit-select  :savedobjects="$blog->categories"  :objects="$categories"  idLabel="categoryLabel" selectType="category_id">Category  :</x-edit-select>
  <div>
<button class="btn btn-block btn-warning my-2" type="submit" >Update Blog </button>
</div>
</form>
</div>



      {{-- // send categories from view to file js : --}}
      <div id="objects" data-objects='{{ json_encode($categories) }}'></div>
      {{-- ----------------------- --}}
@endsection
