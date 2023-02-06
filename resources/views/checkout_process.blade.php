@extends('layouts.layout')
@section('header')
@include('includes.header')
@endsection
@section('content')
<style>
    table {
        width: 100%;
        margin-top: 20px;
        border-collapse: collapse;
    }

    th, td {
        border: 1px solid #dddddd;
        padding: 8px;
    }

    th {
        background-color: #dddddd;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }
</style>

<div class="container text-center">
    <h2>Selected Products</h2>
    <table  class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>Product Name</th>
                <th>Original Price</th>
                <th>Discounted Price</th>
                <th>Selected quantity</th>
                <th>quantity with offers</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->price }}</td>
                @if (array_key_exists($product->id, $productsPrices))
                <td>{{$productsPrices[$product->id]}}</td>
                @else
                <td>none</td>
                 @endif
                 @if (array_key_exists($product->id, $selectedQuantities))
                <td>{{$selectedQuantities[$product->id]}}</td>
                 @endif
                 @if (array_key_exists($product->id, $quantitiesWithOffer))
                 <td>{{$quantitiesWithOffer[$product->id]}}</td>
                  @endif
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Total Price: {{ $totalOrderPrice }}</h3>
</div>



@endsection
