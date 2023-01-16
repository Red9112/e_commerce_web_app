@csrf
   <div class="form-group row">
<div class="col-xs-3">
    <label for="title"> Title</label>
    <input class="form-control w-50  @error('title') is-invalid @enderror" name="title"  id="title" type="text" value="{{old('title',$blog->title ?? null)}}">
   <x-errors name="title"></x-errors>
  </div>
<div class="col-xs-3">
    <label for="description">Description:</label>
    <textarea class="form-control w-50 @error('description') is-invalid @enderror" rows="5" id="description" name="description" >{{old('description',$blog->description ?? null)}}</textarea>
    <x-errors name="description"></x-errors>
  </div>

</div> 
