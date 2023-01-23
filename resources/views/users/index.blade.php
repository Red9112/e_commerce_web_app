@extends('layouts.layout')
@section('header')
    @include('includes.header')
@endsection
@section('content')

@foreach (auth()->user()->unreadNotifications as $notification)
    <div class="alert alert-{{ $notification->type }}">
        {{ $notification->data['notification'] }}
    </div>
@endforeach

{{-- index --}}
<div class="">
    <div class="container mt-3 mx-3">
      <h2 class="my-3">Users:</h2>
      <a   class=" btn btn-outline-info btn-lg" href="{{route('user.create')}}">+</a>
      <table class="table">
        <thead>
          <tr>
            <th>Id</th>
            <th>Name</th>
            <th>email</th>
            <th>Is Admin</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($users as $user)
          <tr>
            <td>{{$user->id}}</td>
            <td>{{$user->name}}</td>
        <td>{{$user->email}}</td>
        <td>{{$user->is_admin}}</td>
        <td>
{{--Actions--}}
<div class="d-inline-flex">
@can('update', $user)
<a class="btn btn-success my-1 mx-1" href="{{route('user.edit',['user'=>$user->id])}}">Edit</a>
@endcan
@can('view', $user)
<a class="btn btn-info my-1 mx-1" href="{{route('user.show',['user'=>$user->id])}}">Detail</a>
@endcan
  @can('delete', $user)
<form class="form-inline" method="POST" action="{{route('user.destroy',['user'=>$user->id])}}">
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
    </div>
    {{-- End index --}}


    {{-- { how to put the count notifications in the middle of bell::
    <script>
      let svg = document.getElementById("bell-svg");
      let notfcount = document.getElementById("notfcount");
      let bbox = svg.getBBox();
      let text = document.createElementNS("http://www.w3.org/2000/svg", "text");
      text.setAttribute("x", bbox.x + bbox.width/2);
      text.setAttribute("y", bbox.y + bbox.height/2);
      text.setAttribute("text-anchor", "middle");
      text.textContent ="5";
      svg.appendChild(text);
    </script>  --}}

@endsection
