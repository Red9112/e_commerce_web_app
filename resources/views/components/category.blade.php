<div style="display: flex;flex-wrap: wrap;">
    @foreach ($cat as $item)
    <a href="{{route('prodByCat',['id'=>$item])}}"><h6><x-badge val="success mx-1 p-1">{{$item->name}}</x-badge></h6></a>
    @endforeach
  </div>
