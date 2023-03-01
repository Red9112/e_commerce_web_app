@extends('layouts.layout')
@section('header')
@include('includes.header')
@endsection
@section('content')
<div class="container my-3">
    <h1 class="text-center mb-5">All Orders</h1>
    <div class="w-75 my-3"><x-search route='admin.orders'>
        <select class="form-select me-2 w-25" id="searchTypeSelect" name="search_by">
         <option value="none" hidden>By</option>
         <option value="customer" >customer name</option>
         <option value="date" >date</option>
         <option value="status" >status</option>
         </select>
 </x-search></div>
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
                    <td>{{ $order->order_total }}</td>
                    <td>{{ $order->order_status->name }}</td>
                    <td>
                        {{--Actions--}}
                        <div class="d-inline-flex">
                        <a type="button" class="btn btn-info mx-2" href="{{route('order.show',['order'=>$order->id])}}">Details</a>
                        <form class="form-inline" method="POST" action="{{route('order.cancel',['order'=>$order->id])}}">
                          @csrf
                          <button class="btn btn-warning mx-2" type="submit" >Cancel </button>
                         </form>
                             <form class="form-inline" method="GET" action="{{route('order.destroy',['id'=>$order->id])}}">
                              @csrf
                              @method('DELETE')
                              <button class="btn btn-danger" type="submit" >Delete </button>
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
