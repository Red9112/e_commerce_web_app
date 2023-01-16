<div style="display: flex;flex-wrap: wrap;">
    @foreach ($cat as $item)
    <a href="{{route('prodByCat',['id'=>$item])}}"><h5><x-badge val="success mx-1 p-1">{{$item->name}}</x-badge></h5></a>
    @endforeach 
  </div>