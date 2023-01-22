@extends('layouts.layout')
@section('header')
    @include('includes.header')
@endsection
@section('content')
<div class="dropdown">
 
    <svg id="bell-svg" type="button" data-bs-toggle="dropdown" width="40" height="40" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 47.5 47.5" viewBox="0 0 47.5 47.5">
    <defs><clipPath id="a"><path d="M0 38h38V0H0v38Z"/></clipPath></defs>
    <g clip-path="url(#a)" 
      transform="matrix(1.25 0 0 -1.25 0 47.5)"><path fill="#ffac33" 
      d="M0 0c0-11 5-10 5-15 0 0 0-2-2-2h-26c-2 0-2 2-2 2 0 5 5 4 5 15 0 5.522 4.478 10 10 10S0 5.522 0 0" 
      transform="translate(29 24)"/><path fill="#ffac33" d="M0 0a3 3 0 1 1-6 0 3 3 0 0 1 6 0" 
      transform="translate(22 34)"/><path fill="#ffac33" d="M0 0a4 4 0 0 1 4 4h-8a4 4 0 0 1 4-4" 
      transform="translate(19 1)"/><span id="notfcount" class="badge bg-danger">{{auth()->user()->unreadNotifications->count()}}</span></g></svg>

<ul class="dropdown-menu">
@foreach (auth()->user()->unreadNotifications as $notification)
{{-- {{ $notification->data['notification'] }} --}}
<li><a class="dropdown-item" href="#">{{$notification->type}}</a></li>
@endforeach
    <li><hr class="dropdown-divider"></li>
    <li><a class="dropdown-item" href="#">All</a></li>
  </ul>
</div>
<i class="fa fa-bell" aria-hidden="true"></i>

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
