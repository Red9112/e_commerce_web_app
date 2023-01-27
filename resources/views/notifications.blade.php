@extends('layouts.layout')
@section('header')
@include('includes.header')
@endsection
@section('content')

<div class="container pt-5 justify-content-center w-50 mt-3 mx-4">
<h1>Notifications:</h1>
<div id="accordion">
    <div class="card">
      <div class="card-header bg-info">
        <a class="btn" data-bs-toggle="collapse" href="#unread">
     <h5><span class="fs-5 font-weight-bold">Unread: <span class="badge bg-secondary">{{auth()->user()->unreadNotifications->count()}}</span></span></h5>
        </a>
      </div>
      <div id="unread" class="collapse show" data-bs-parent="#accordion">
        <div class="card-body">
@foreach (auth()->user()->unreadNotifications as $notification)
<div class="rounded d-flex justify-content-between bg-secondary mb-3">
  <div><h5 class="mx-1 my-1 fs-5 font-weight-bold">Content:</h5></div>
  <div class="d-flex">
    <form class="form-inline" method="POST" action="{{route('notification.destroy',['id'=>$notification->id])}}">
        @method('DELETE')
        @csrf
        <button class="btn btn-danger my-1 mx-1" type="submit" >del </button>
        </form>
    <form class="form-inline" method="POST" action="{{route('notification.markAsRead',['id'=>$notification->id])}}">
        @method('PUT')
        @csrf
        <button class="btn btn-warning my-1 mx-1" type="submit" >mark as read</button>
        </form>
  </div>
</div>
<div class="alert alert-light">
  <p><strong>Subject:</strong> {{ $notification->data['subject'] }}</p>
  <p><strong>name:</strong> {{ $notification->data['name'] }}</p>
  <p><strong>email:</strong> {{ $notification->data['email'] }}</p>
  <p><strong>Message:</strong> {{ $notification->data['notification'] }}</p>
 <a style="text-decoration: none" class="btn btn-success" href="{{route('user.show',['user'=>$notification->data['user_id']])}}"> <strong>profil</strong></a>
  </div>
  <hr>
@endforeach
        </div>
      </div>
    </div>

    <div class="card">
        <div class="card-header bg-info">
          <a class="collapsed btn" data-bs-toggle="collapse" href="#all">
            <h5><span class="fs-5 font-weight-bold">All: <span class="badge bg-secondary ">{{auth()->user()->notifications->count()}}</span></span></h5>
          </a>
        </div>
        <div id="all" class="collapse" data-bs-parent="#accordion">
            <div class="card-body">
                @foreach (auth()->user()->notifications as $notification)
                <div class="rounded d-flex justify-content-between bg-secondary mb-3">
                    <div><h5 class="mx-1 my-1 fs-5 font-weight-bold">Content:</h5></div>
                    <div>
                        <form class="form-inline" method="POST" action="{{route('notification.destroy',['id'=>$notification->id])}}">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-danger my-1 mx-1" type="submit" >del </button>
                            </form>
                    </div>
                  </div>
                <div class="alert alert-light">
                    <p><strong>Subject:</strong> {{ $notification->data['subject'] }}</p>
                    <p><strong>name:</strong> {{ $notification->data['name'] }}</p>
                    <p><strong>email:</strong> {{ $notification->data['email'] }}</p>
                    <p><strong>Message:</strong> {{ $notification->data['notification'] }}</p>
                    {{-- <a style="text-decoration: none" class="btn btn-success" href="{{route('user.show',['user'=>$notification->data['user_id']])}}"> <strong>profil</strong></a> --}}
                  </div>
                <hr>
                  @endforeach
                        </div>
        </div>
      </div>

    </div>

</div>

@endsection
