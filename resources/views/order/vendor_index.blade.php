@extends('layouts.layout')
@section('header')
@include('includes.header')
@endsection
@section('content')

<div class="container my-3">
    <div class="my-5">
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
            @foreach ($orders as $order)
                <tr>
                    <td>{{$order->id}}</td>
                    <td>{{ $order->created_at->format('d/m/Y') }}</td>
                    <td>{{$order->user->name}}</td>
                    <td>{{ $order->order_status->name }}</td>
                    <td>
                        <a type="button" class="btn btn-info mx-2" href="{{route('order.vendor.show',['order'=>$order->id])}}">Details</a>
                        </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
