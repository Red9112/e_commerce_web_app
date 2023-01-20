
<div id="allDiv" class="mb-3 mt-3">
    <label id="{{$idLabel}}" for="{{$selectType}}" class="form-label">{{$slot}}</label>
    <select class="form-select @error('{{$selectType}}') is-invalid @enderror" id="{{$selectType}}" name="{{$selectType}}">
     @if ($selectType=="category_id")
    <option  selected disabled hidden>Choose...</option>
    @endif
    @foreach ($objects as $item)
    @if ($selectType=="role" && $item->name=="customer" )
    <option value="{{$item->id}}" selected>{{$item->name}}</option>
    @endif
    <option value="{{$item ->id}}" >{{$item->name}}</option>
    @endforeach
    </select>
  <x-errors name="{{$selectType}}"></x-errors>
  </div>
<button class="btn btn-outline-info btn-lg" id="clc" type="button">+</button>


 {{-- // send objects from view to js file=container.js   : --}}
 <div id="objects" data-objects='{{ json_encode($objects) }}'></div>
 {{-- ----------------------- --}}
