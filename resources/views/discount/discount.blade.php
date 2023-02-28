@extends('layouts.layout')
@section('header')
@include('includes.header')
@endsection
@section('content')


{{-- index --}}
<div class="d-flex flex-row justify-content-between">
<div class="w-100 m-5  p-3">
<h2 class="my-3">List of Discounts :</h2>
<a type="button" class=" btn btn-outline-info btn-lg" href="{{route('discount.create')}}">+</a>
<a type="button" class="btn btn-outline-success btn-lg m-3" href="{{route('discount_type.index')}}">Discount Type</a>
<div class="w-50 my-3"><x-search route='discount.index'>
           <select style="width: fit-content" class="form-select me-2" id="search_by" name="search_by">
            <option value="none" hidden>By</option>
            <option value="name" >name</option>
            <option value="code" >code</option>
            <option value="type" >type</option>
            </select>
    </x-search></div>
<table class="table text-center">
    <thead>
      <tr>
        <th>Code</th>
        <th>Name</th>
        <th>Type</th>
        <th>Discount creator</th>
        <th>Value</th>
        <th>Description</th>
        <th>Start date</th>
        <th>End date</th>
        <th>Expired</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($discounts as $item)
      <tr>
        <td>{{$item->code}}</td>
        <td>{{$item->name}}</td>
        <td>{{$item->discount_type->name}}</td>
        <td><a class="btn" href="{{route('user.show',['user'=>$item->user->id])}}">{{$item->user->name}}</a></td>
        <td>{{$item->value}}</td>
        <td>{{$item->description ?? 'undefined'}}</td>
        <td> {{$item->start_date ?? 'undefined'}}</td>
        <td>{{$item->end_date ?? 'undefined'}}</td>
        <td>{{ ($item->expired)?'true':'false'}}</td>
        <td>
{{--Actions--}}
<div class="d-inline-flex">
<a type="button" class="btn btn-success mx-2" href="{{route('discount.edit',['discount'=>$item->id])}}">Edit</a>
<form class="form-inline" method="POST" action="{{route('discount.destroy',['discount'=>$item->id])}}">
  @csrf
  @method('DELETE')
  <button class="btn btn-danger" type="submit" >Delete </button>
 </form>
 <a type="button" class="btn btn-info mx-2" href="{{route('affect_to_products',['disId'=>$item->id])}}">Affect</a>
</div>
      {{--END_Actions--}}
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
{{-- End index --}}
</div>


@endsection
