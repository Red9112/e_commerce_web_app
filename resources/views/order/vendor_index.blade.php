@extends('layouts.layout')
@section('header')
@include('includes.header')
@endsection
@section('content')

<div class="container my-3">
    <div class="my-5">
        @if ($orders!=null)
    <h2>Orders for shop: <span class="badge bg-info">{{ $user->shop->name }}</span></h2>
    <h2>Vendor: <span class="badge bg-info">{{ $user->name }}</span></h2>
      </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Order Date</th>
                <th>Customer Name</th>
                <th>Status</th>
                <th>Details</th>

            </tr>
        </thead>
        <tbody>
             @forelse($orders as $order) 
                <tr>
                    <td>{{$order->id}}</td>
                    <td>{{ $order->created_at->format('d/m/Y') }}</td>
                    <td>{{$order->user->name}}</td>
                    <td>{{ $order->order_status->name }}</td>
                    <td>
                        <a type="button" class="btn btn-info mx-2" href="{{route('order.vendor.show',['order'=>$order->id])}}">Details</a>
                        </td>
                </tr>
                @empty
                <div class="container mx-1 my-3">
                <div class="alert alert-warning text-center">
                 <strong>Alert: </strong> There is no orders found !!
                </div>
              </div>
                @endforelse
        </tbody>
    </table>
    @else
    <center> <div><h3><x-badge val="warning mx-3 my-3">You don't have shop !!</x-badge></h3></div> </center>
       @endif
</div>

@endsection
