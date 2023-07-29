@extends('layouts.layout')
@section('header')
@include('includes.header')
@endsection
@section('content')


{{-- Edit  --}}

    <div class="container w-50 mx-3 my-3">
      <h2>Edit Payment Card :</h2>
  <form id="editForm" method="POST" action="{{route('payment.update',['payment'=>$payment->id])}}">
    @method('PUT')
    @csrf
    <div class="mb-3 mt-3">
    <label for="account_number">Account number</label>
    <input type="text" class="form-control @error('account_number') is-invalid @enderror" id="account_number" value="{{old('account_number',$payment->account_number)}}" name="account_number">
    <x-errors name="account_number"></x-errors>
        </div>
        <div class="mb-3 mt-3">
            <label for="is_default" class="form-label">Is a default card:</label>
            <select class="form-select" id="is_default" name="is_default">
              <option value="1" @if ($payment->is_default=="1") selected @endif>True</option>
              <option value="0" @if ($payment->is_default=="0") selected @endif>false</option>
            </select>
          </div>
        <button  type="submit" class="btn btn-primary">Edit</button>
    </form>
    </div>

  {{-- End Edit  --}}


  @endsection
