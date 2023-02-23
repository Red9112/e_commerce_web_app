@extends('layouts.layout')
@section('header')
@include('includes.header')
@endsection
@section('content')

<div class="container mt-3 mx-3">
<h2>New Blog</h2>
<form method="POST" action="{{route('blog.store')}}">

@include('blogs.forms')
<div class="w-50">
 <x-create-select idLabel="categoryLabel" selectType="category_id" :objects="$categories">Select blog category: </x-create-select>
</div>

<button class="btn btn-block btn-primary my-2" type="submit" >Add Blog </button>
</form>
</div>




@endsection
