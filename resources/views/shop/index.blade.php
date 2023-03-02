@extends('layouts.layout')
@section('header')
    @include('includes.header')
@endsection
@section('content')

{{-- index --}}
<div class="d-flex flex-row justify-content-between">

<div class="w-50 mx-5 my-3">
    <h2>List of Shops :</h2>
  <div class="d-flex my-3 mb-5">
      <a   class=" btn btn-outline-info btn-lg" href="{{route('shop.create')}}">+</a>
      <a   class=" btn btn-outline-info btn-lg mx-3" href="{{route('shop.export.list')}}">Export</a>
      <div class="w-75  d-flex justify-content-center "><x-search route='shop.index'></x-search></div>
  </div>

      <table style="text-align: center" class="table ">
        <thead>
          <tr>
            <th>Logo</th>
            <th>Name</th>
            <th>Products Count</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($shops as $shop)
          <tr>
            <td>-image--</td>
        <td>{{$shop->name}}</td>
        <td>
          @if ($shop->products_count)
          <span class="badge bg-warning">{{$shop->products_count}}</span>
          @else
          <span class="badge bg-dark">none</span>
          @endif
        </td>
            <td>
             {{--Actions--}}
             <div class="d-inline-flex">
              @can('update', $shop)
              <a type="button" class="btn btn-success my-1 mx-1" href="{{route('shop.edit',['shop'=>$shop->id])}}">Edit</a>
              @endcan
     <a class="btn btn-info my-1 mx-1" href="{{route('shop.show',['shop'=>$shop->id])}}">Detail</a>
     @can('delete', $shop)
     <form class="form-inline" method="POST" action="{{route('shop.destroy',['shop'=>$shop->id])}}">
      @csrf
      @method('DELETE')
      <button class="btn btn-danger my-1 mx-1" type="submit" >Delete </button>
     </form>
     @endcan
    </div>
          {{--END_Actions--}}
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>


{{-- most Shops products  --}}
<div class="w-25 mx-3 my-3">
<x-card
header=" Shop Products"
:collection="$shopProducts">
</x-card>
</div>


</div>
    {{-- End index --}}




@endsection
