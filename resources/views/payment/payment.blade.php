@extends('layouts.layout')
@section('header')
@include('includes.header')
@endsection
@section('content')


{{-- index --}}
<div class="d-flex flex-row justify-content-between">
<div class="w-50 mx-5 my-3">
<h2>List of payment cards :</h2>
  <table class="table">
    <thead>
      <tr>
        <th>Account number</th>
        <th>Is_default</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($payments as $item)
      <tr>
        <td>{{$item->account_number}}</td>
        <td>{{($item->is_default)?'True':'False'}}</td>
        <td>
{{--Actions--}}
<div class="d-inline-flex">
<a type="button" class="btn btn-success mx-2" href="{{route('payment.edit',['payment'=>$item->id])}}">Edit</a>
<form class="form-inline" method="POST" action="{{route('payment.destroy',['payment'=>$item->id])}}">
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

{{-- End index --}}

{{-- Create --}}

<div class="w-25 mx-5">
  <h2>Payment cards :</h2>
  <button type="button" id="createBtn" class=" btn btn-outline-info btn-lg">+</button>
  <form style="display: none" id="createForm" method="POST" action="{{route('payment.store')}}" enctype="multipart/form-data" >
    @csrf

      <div class="mb-3 mt-3">
        <label for="account_number">Account number</label>
          <input type="text" class="form-control @error('account_number') is-invalid @enderror" id="account_number" value="{{old('account_number')}}" name="account_number">
          <x-errors name="account_number"></x-errors>
        </div>
        <div class="mb-3 mt-3">
            <label for="is_default" class="form-label">Is a default card:</label>
            <select class="form-select" id="is_default" name="is_default">
              <option value="1">True</option>
              <option selected value="0" >false</option>
            </select>
          </div>
      <button type="submit" class="btn btn-primary">create</button>
    </form>
  </div>

  {{-- End Create --}}
</div>


@endsection
