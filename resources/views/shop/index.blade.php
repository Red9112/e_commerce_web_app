@extends('layouts.layout')
@section('header')
    @include('includes.header')
@endsection
@section('content')
 
{{-- index --}}
<div class="">
    <div class="container mt-3 mx-3">
      <h2 class="my-3">List of Shops :</h2> 
      <a  id="plus" class=" btn btn-outline-info btn-lg" href="{{route('shop.create')}}">+</a>
      <a  id="plus" class=" btn btn-outline-info btn-lg" href="{{route('shop.export.list')}}">Export</a>
      <div class="all d-flex">
      <div class="w-75 mx-3">
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
             <div class="actions">
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
<div class="container w-25 mx-3">
<x-card 
header=" Shop Products"
:collection="$shopProducts">
</x-card>
</div>


    </div>
    </div>
    {{-- End index --}}

    </div>
    
@endsection