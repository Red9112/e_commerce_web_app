@extends('layouts.layout')
@section('header')
@include('includes.header')
@endsection
@section('content')


{{-- index --}}
<div class="d-flex flex-row justify-content-between">
<div class="w-75 mx-5 my-3">
<h2>List of Discounts :</h2>
<a type="button" class=" btn btn-outline-info btn-lg" href="{{route('discount.create')}}">+</a>
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


{{-- Create --}}

<div class="w-25 mx-5">
    <h2>Create Discount Type :</h2>
    <button type="button" id="createBtn" class=" btn btn-outline-info btn-lg">+</button>
    <form style="display: none" id="createForm" method="POST" action="{{route('discount_type.store')}}" enctype="multipart/form-data" >
      @csrf

        <div class="mb-3 mt-3">
          <label for="name">Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" value="{{old('name')}}" name="name">
            <x-errors name="name"></x-errors>
          </div>
            <div class="form-group mb-3 mt-3">
              <label for="description">Description: </label>
             <textarea class="form-control" rows="5" id="description" name="description"></textarea>
            </div>
        <button type="submit" class="btn btn-primary">create</button>
      </form>
      <div class="col-md-6">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Name</th>
              <th>Description</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <!-- Loop through saved products -->
            @foreach ($types as $type)
              <tr>
                <td>{{$type->name}}</td>
                <td>{{$type->description}}</td>
                <td>
                 <div class="d-inline-flex">
                  <a type="button" class="btn btn-success mx-2" href="{{route('discount_type.edit',['discount_type'=>$type->id])}}">Edit</a>
             <form class="form-inline" method="POST" action="{{route('discount_type.destroy',['discount_type'=>$type->id])}}">
              @csrf
                  @method('DELETE')
                   <button class="btn btn-danger" type="submit" >del</button>
                   </form>
                   </div>

            </td>
            </tr>
              @endforeach
          </tbody>
        </table>
      </div>
    </div>


    {{-- End Create --}}
</div>


@endsection
