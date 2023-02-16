<?php

namespace  App\Repositories;


use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Discount;
use Illuminate\Http\Request;


class DiscountRepository{


    public function affect_discount_to_product(Request $request,$id)
    {

        // Vendor discount:can apply just to his products
        $discount=Discount::findOrfail($id);
        $user=auth()->user();
        if($request->my_products){
            $products=collect($user->shop->products);
            $productsIds=$products->pluck('id');
            $discount->products()->syncWithoutDetaching($productsIds);
            $request->session()->flash('status',"The discount affected to all your products !! ");
        }
        elseif($request->input('products', [])){
            $productsIds=$request->input('products', []);
            $discount->products()->syncWithoutDetaching($productsIds);
            $request->session()->flash('status',"The discount  affected to selected products !! ");
        }
        elseif($request->input('cats', [])){
            $categoriesIds=$request->input('cats', []);
            $products=collect($user->shop->products);
            foreach ($products as $product) {
            $ProdCategoriesIds=collect($product->categories)->pluck('id');
            foreach ($categoriesIds as $catId) {
(in_array($ProdCategoriesIds,$catId) )?$discount->products()->syncWithoutDetaching($product->id):null;
            }
            }
            $request->session()->flash('status',"The discount affected to products by selected categories !! ");
        }
        //admin discount:can apply to all site products
        elseif($request->input('catsToAll', [])){
            $categoriesIds=$request->input('cats', []);
            $categories=Category::where('id', $categoriesIds)->get();
            foreach ($categories as $cat) {
                $productsIds=collect($cat->products)->pluck('id');
                $discount->products()->syncWithoutDetaching($productsIds);
            }
        }
        elseif($request->applyToAll){
            $productsIds=Product::get()->pluck('id');
            $discount->products()->syncWithoutDetaching($productsIds);
            $request->session()->flash('status',"The discount affected to all site  products !! ");
        }

        else $request->session()->flash('failed',"The discount doesn't affected to any product !! ");
}
















}
