@extends('layouts.layout')
@section('header')
@include('includes.header')
@endsection
@section('content')


<div class="container mt-1 my-3 ">
    <h1 class="my-3">Blog:</h1>
    <div class="all d-flex flex-row justify-content-between">
    <div class="mr-auto w-75 " id="accordion">
      <div class="card">
    <div class="blogIndex card-header border border-light rounded">
        <button class="btn"> <strong><h1>{{$blog->title}}</h1></strong></button>
    </div>
    <x-category :cat="$blog->categories"></x-category>
    <div id="{{$blog->id}}" class="collapse show" >
      <div class="card-body">
        {{$blog->description}}
      <hr>
      <x-created  :date="$blog->created_at" :name="$blog->user->name" :userid="$blog->user->id" ></x-created>
      <x-created :date="$blog->updated_at">updated_at:</x-created>
       @if ($blog->created_at->between(now()->submonth(1),now()))
   <p><x-badge val="success">New</x-badge></p>
       @else
   <p><x-badge val="warning" >Old</x-badge></p>
       @endif

    @can(['update','delete'], $blog)
    <div class="d-inline-flex">
    <a class="btn btn-sb btn-warning my-1 " href="{{route('blog.edit',['blog'=>$blog->id])}}">Edit</a>
    <form class="form-inline" method="POST" action="{{route('blog.destroy',['blog'=>$blog->id])}}">
        @csrf
        @method('DELETE')
        <button class="btn btn-sb btn-danger mx-2 my-1" type="submit" >Delete </button>
       </form>
    </div>
    @endcan
  </div>
    </div>
    <x-comment :id="$blog->id" :action="route('storeBlogComment',['id'=>$blog->id])"></x-comment>
    <x-displayComments :comments="$blog->comments"></x-displayComments>
  </div>
  </div>
  <div class="ml-auto container w-25 ">
    @include('blogs.sidebar')
    </div>


  </div>
  </div>



@endsection
