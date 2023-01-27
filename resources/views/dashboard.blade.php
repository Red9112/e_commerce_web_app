@extends('layouts.layout')
@section('header')
@include('includes.header')
@endsection
@section('content')

<center>
<a class="nav-link" href="{{route('dashboard')}}">
<h2>{{__('welcome')}}</h2>
</a>


</center>


<x-display-prod :products="$products"></x-display-prod>


 <button id="test-button">Test SweetAlert2</button>


 <script>
  console.log("testt");


  document.getElementById('test-button').addEventListener('click', () => {
    Swal.fire({
  title: 'Do you want check the cart now ?',
  showDenyButton: true,
  confirmButtonText: 'go',
  denyButtonText: `return to shop`,
}).then((result) => {
  /* Read more about isConfirmed, isDenied below */
  if (result.isConfirmed) {
   // window.location.href = "{{route('cart.index')}}"
   window.location.href = "{{route('addToCart',['id'=>2])}}"
  }
})
});
</script>

@endsection
