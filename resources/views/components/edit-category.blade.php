<div id="cat" class="mb-3 mt-3"> 
    <label id="label" for="category_id" class="form-label">Category  :</label>
    @foreach ($productcats as $item)
    @if ($productcats[0]===$item)
    <select class="form-select @error('category_id') is-invalid @enderror" id="category_id" name="{{'category_id'}}">
      @foreach ($categories as $category)
      <option value="{{$category->id}}" @if($item->id== $category->id) selected @endif>{{$category->name}}</option>
      @endforeach
    </select>
      @else
      <div style="display:flex;">
    <select class="form-select @error('category_id') is-invalid @enderror" id="category_id" name="{{'category-'.$item->id}}">
      @foreach ($categories as $category)
      <option value="{{$category->id}}" @if($item->id== $category->id) selected @endif>{{$category->name}}</option>
      @endforeach
    </select> 
    <x-errors name="category_id"></x-errors>
    <button type="button" class="deletecat btn btn-outline-danger btn-sm mx-1 my-1">del</button>
  </div>
    @endif
    @endforeach
  </div>
  <button class="btn btn-outline-info btn-lg" id="clc" type="button">+</button>