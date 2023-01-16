<div class="card card-header">
    <button class="btn" > <strong><h3>{{$header}}</h3></strong></button>
</div>
<center>
@if ($collection)
@foreach ($collection as $collect)
<div class="card">
    <div class="collapse show" >
      <div class="card-body">
        @if ($collect->blogs_count)
       <strong><h5>{{$collect->name}}</h5></strong></button>
       <x-badge val="info">nbr of blogs:  {{$collect->blogs_count}}</x-badge>
       @elseif($collect->products_count)
       <strong><h5>{{$collect->name}}</h5></strong></button>
       <x-badge val="info">nbr of products:  {{$collect->products_count}}</x-badge>
       @elseif($collect->comments_count)
      <a class="btn" href="#{{$collect->id}}"><strong><h5>{{$collect->title}}</h5></strong></button></a>
       <x-badge val="info">nbr of comments:  {{$collect->comments_count}}</x-badge>
       @endif
  </div>
  </div>
</div>
@endforeach 
@endif
 
@isset($slot)
<h5 style="color: brown">
{{$slot}}</h5>  
@endisset
</center>
<hr>


