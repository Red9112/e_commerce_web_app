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
public function destroy_product(Request $request,Product $product)
    {
      $user=auth()->user();
      $orders_count=$product->orders->count();
        if ($user->hasRole('vendor') && $orders_count!=0) {
            $request->session()->flash('failed',
            "product can't be deleted because its't involved in some orders !!: required authorisation:admin");
            return redirect()->back();
        } 
        if ($user->hasRole('admin') && $orders_count!=0) {
        $is_shipped_canceled=true;
        foreach ($product->orders as $order) {
            ($order->order_status->name!="shipped" && $order->order_status->name!="canceled")
            ?$is_shipped_canceled=false:null;
        }
        if ($is_shipped_canceled) {
            $product->orders()->detach();
        }  
        else {
            $request->session()->flash('failed',
            "product can't be deleted because it's involved in some
             orders who are not shipped or canceled !!");
            return redirect()->back();
        }
    }
      $product->categories()->detach();
      $product->comments()->delete();
      $product->images()->delete();
      $product->discounts()->detach();
      $product->wishlists()->detach();
      $product->delete();
    }










    
}
