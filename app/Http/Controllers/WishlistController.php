<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class WishlistController extends Controller
{

                    public function index()
                    {
                 $products=auth()->user()->cart->products;
                 return view('wishlist',[
                    'products'=>$products,
                ]);
                    }

                    public function store(Request $request,$id)
                    {
              $cart=auth()->user()->cart;
              ($cart==null)?$cart=Cart::create(['user_id'=>auth()->id()]):null;
              $cart->products()->syncWithoutDetaching([$id]);
              $request->session()->flash('status',' product added to Wishlist !!');
              return redirect()->back();
                    }


                    public function destroy(Request $request,$id)
                    {
                        $cart=auth()->user()->cart;
                        $cart->products()->detach($id);
                         $request->session()->flash('failed',' product removed from Wishlist !!');
                         return redirect()->back();
                    }


}
