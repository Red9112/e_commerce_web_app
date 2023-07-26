@extends('layouts.layout')
@section('header')
@include('includes.header')
@endsection
@section('content')
<div class="container my-3">
    <h1 class="text-center mb-5">Customer Orders</h1>
    <table class="table table-striped text-center">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Customer Name</th>
                <th>Order Date</th>
                <th>Order Total</th>
                <th>Order Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->user->name }}</td>
                    <td>{{ $order->created_at->format('d/m/Y') }}</td>
                    <td>{{ \App\Helpers\Helper::displayPrice($order->order_total )}}</td>
                    <td>{{ $order->order_status->name }}</td>
                    <td>
                        {{--Actions--}}
                        <div class="d-inline-flex">
                        <a type="button" class="btn btn-info mx-2" href="{{route('order.show',['order'=>$order->id])}}">Details</a>
                        <form class="form-inline" method="POST" action="{{route('order.cancel',['order'=>$order->id])}}">
                          @csrf
                          <button class="btn btn-danger" type="submit" >Cancel </button>
                         </form>
                        </div>
                        {{--END_Actions--}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
