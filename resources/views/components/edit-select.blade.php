<div id="allDiv" class="mb-3 mt-3">
    <label id="{{$idLabel}}" for="{{$selectType}}" class="form-label">{{$slot}}</label>
    @foreach ($savedobjects as $savedItem)
    @if ($savedobjects[0]===$savedItem)
    <select class="form-select @error('{{$selectType}}') is-invalid @enderror" id="{{$selectType}}" name="{{$selectType}}">
      @foreach ($objects as $item)
      <option value="{{$item->id}}" @if($savedItem->id== $item->id) selected @endif>{{$item->name}}</option>
      @endforeach
    </select>
      @else
      <div style="display:flex;">
    <select class="form-select @error('{{$selectType}}') is-invalid @enderror" id="{{$selectType}}" name="{{"$selectType-".$savedItem->id}}">
      @foreach ($objects as $item)
      <option value="{{$item->id}}" @if($savedItem->id== $item->id) selected @endif>{{$item->name}}</option>
      @endforeach
    </select>
    <x-errors name="{{$selectType}}"></x-errors>
    <button type="button" class="deleteBtns btn btn-outline-danger btn-sm mx-1 my-1">del</button>
  </div>
    @endif
    @endforeach
  </div>
  <button class="btn btn-outline-info btn-lg" id="clc" type="button">+</button>

    {{-- // send objects from view to file js : --}}
    <div id="objects" data-objects='{{ json_encode($objects) }}'></div>
    {{-- ----------------------- --}}
