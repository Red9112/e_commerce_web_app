<?php

namespace  App\Repositories;


use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Discount;
use Illuminate\Http\Request;


class DiscountRepository{



    public function attach_detach(Request $request,Discount $discount,$productsIds)
    {
   ($request->has('attach'))
   ?$discount->products()->syncWithoutDetaching($productsIds)
   :$discount->products()->detach($productsIds);
    }

    public function attach_discount_to_product(Request $request,$id)
    {
        // Vendor discount:can apply just to his products
        $discount=Discount::findOrfail($id);
        $user=auth()->user();
        if($request->my_products){
            $products=collect($user->shop->products);
            $productsIds=$products->pluck('id');
            $this->attach_detach($request,$discount,$productsIds);
            ($request->has('attach'))
            ?$request->session()->flash('status',"The discount affected to all your products !! ")
            :$request->session()->flash('status',"The discount detached from all your products !! ");
        }
        elseif($request->input('products', [])){
            $productsIds=$request->input('products', []);
            $this->attach_detach($request,$discount,$productsIds);
            ($request->has('attach'))
            ?$request->session()->flash('status',"The discount  affected to selected products !! ")
            :$request->session()->flash('status',"The discount  detached from selected products !! ");
        }
        elseif($request->input('cats', [])){
            $categoriesIds=$request->input('cats', []);
            $products=collect($user->shop->products);
            foreach ($products as $product) {
            $ProdCategoriesIds=collect($product->categories)->pluck('id');
            foreach ($categoriesIds as $catId) {
            (in_array($ProdCategoriesIds,$catId) )
            ?$this->attach_detach($request,$discount,$product->id):null;
            }
            }
            ($request->has('attach'))
            ?$request->session()->flash('status',"The discount affected to products by selected categories !! ")
            :$request->session()->flash('status',"The discount detached from products by selected categories !! ");
        }
        //admin discount:can apply to all site products
        elseif($request->input('catsToAll', [])){
            $categoriesIds=$request->input('cats', []);
            $categories=Category::where('id', $categoriesIds)->get();
            foreach ($categories as $cat) {
                $productsIds=collect($cat->products)->pluck('id');
                $this->attach_detach($request,$discount,$productsIds);
            }
            ($request->has('attach'))
            ?$request->session()->flash('status',"The discount atached by selected categories to all site  products  !! ")
            :$request->session()->flash('status',"The discount detached by selected categories from all site  products  !! ");
        }
        elseif($request->applyToAll){
            $productsIds=Product::get()->pluck('id');
            $this->attach_detach($request,$discount,$productsIds);
            ($request->has('attach'))
            ?$request->session()->flash('status',"The discount affected to all site  products !! ")
            :$request->session()->flash('status',"The discount detached from all site  products !! ");
        }

        else{
            ($request->has('attach'))
            ?$request->session()->flash('failed',"The discount doesn't affected to any product !! ")
            :$request->session()->flash('failed',"The discount doesn't detached from any product !! ");
    }
}



}
