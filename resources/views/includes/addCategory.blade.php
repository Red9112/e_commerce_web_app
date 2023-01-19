
<div  id="allDiv"  class="mb-3 mt-3">
    <label id="categoryLabel" for="category_id" class="form-label">Select product category  :</label>

    <select class="form-select @error('category_id') is-invalid @enderror"  id="category_id" name="category_id">
            <option  selected disabled hidden>Choose...</option>
            @foreach ($categories as $category)
            <option value="{{$category->id}}" >{{$category->name}}</option>
            @endforeach
          </select>
<x-errors name="category_id"></x-errors>
          </div>
          <button class="btn btn-outline-info btn-lg" id="clc" type="button">+</button>
