@extends('layouts.layout')
@section('header')
@include('includes.header')
@endsection
@section('content')


  <div class="container mt-3 my-3">
    <h1 class="my-3">Blogs:</h1> 
    <h2>
  <x-badge val="info">Nbr: {{$blogs->count()}}</x-badge>
    </h2>
    <a  id="plus" class=" btn btn-outline-info btn-lg my-2" href="{{route('blog.create')}}">+</a>
    <div class="all d-flex">
    <div id="accordion">
@foreach ($blogs as $blog)
      <div class="card w-75"> 
        <div class="blogIndex card-header">
            <a id="{{$blog->id}}" href="{{route('blog.show',['blog'=>$blog->id])}}" class="btn"> <strong><h3>{{$blog->title}}</h3></strong></a>
        </div>
        <x-category :cat="$blog->categories"></x-category>
        <div id="{{$blog->id}}" class="collapse show" >
          <div class="card-body">
            {{$blog->description}}  
          <hr>  
 <x-created  :date="$blog->created_at" :name="$blog->user->name" :userid="$blog->user->id" ></x-created>
          <x-created :date="$blog->updated_at">updated_at:</x-created>
          @if ($blog->comments_count!=0)
      <x-badge val="info">{{ trans_choice('messages.plural',$blog->comments_count) }}</x-badge>
          @else
        <x-badge val="dark">{{ trans_choice('messages.plural',$blog->comments_count) }}</x-badge>
          @endif
           @if ($blog->created_at->between(now()->submonth(1),now()))  
       <p><x-badge val="success">New</x-badge></p>
           @else
       <p><x-badge val="warning" >Old</x-badge></p>
           @endif

        @can(['update','delete'], $blog)
        <div class="actions ">
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
      </div>

      @endforeach

    </div>
  
    
  {{-- End index --}}
<div class="container w-50">
@include('blogs.sidebar')
</div>

</div>
</div>


@endsection