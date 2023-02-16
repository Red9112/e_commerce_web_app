<?php

namespace  App\Repositories;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ProductRepository{

    public function store_categories_to_product(Request $request,Product $product)
    {
 //store categories--
 $filteredAttributeNames = array_filter($request->keys(), function ($key){
    return strpos($key, 'category_id-') === 0;
});
$filteredAttributeNames = collect($filteredAttributeNames);
$filteredAttributeNames->push('category_id');
$categories=$request->only($filteredAttributeNames->toArray());
$categoriesIds=collect($categories)->values()->toArray();
$product->categories()->sync($categoriesIds);
//end store categories
    }


    public function upload_image_to_product(Request $request,Product $product)
    {
     // Upload file
$hasfile=$request->hasfile('picture');
$picture=$request->file('picture');
if($hasfile) {
$file=Storage::putFile('products',$picture);
$path=Storage::url($file);
// first method:
// $image=new Image(['url'=>$path]);
// $product->images()->save($image);
// second method:
$image=Image::make(['url'=>$path]);
$product->images()->save($image);
      }
// end
}
public function destroy_product($id)
    {
      $product=Product::with(['categories','comments','images','discounts','wishlists'])
      ->findOrfail($id);
      $product->categories()->detach();
      $product->comments()->delete();
      $product->images()->delete();
      $product->discounts()->detach();
      $product->wishlists()->detach();
      $product->destroy($id);
    }
}
