<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{


    public function index()
    {
        $cart = session()->get('cart');
        $products = Product::whereIn('id', $cart['product_id'])->get();
        return view('cart',[
            'products'=>$products
        ]);
    }
        public function addToCart(Request $request)
        {
// Session::forget('cart');
//dd($data = Session::all());
 //if (isset($cart['product_id'])){} test existance of seesion key

            $product_to_cart=$request->idprd;
            $cart = session()->get('cart');
            $products =$cart['product_id'];
            if(!$cart) {
                $cart = [
                    "product_id" => [
                        $product_to_cart
                    ],
                            ];
                            session()->put('cart', $cart);
                            $request->session()->flash('status',' product added to cart !!');
                        }

                        else{
                            $cartProductsIds =collect($cart['product_id']);
                            if(!($cartProductsIds->contains(function ($item) use ($product_to_cart) { return $item === $product_to_cart;}))) {
                                    $cart['product_id'][]=$product_to_cart;
                                    session()->put('cart', $cart);
                                    $request->session()->flash('status',' product added to cart !!');
                                }
                                else{
                                    $request->session()->flash('status',' product already in cart !!');
                                }
                        }
                        if($request->redirect=="cart") return redirect()->route('cart.index');
                        else return redirect()->back();
                    }


                    public function removeSessionProduct(Request $request,$id)
                    {
                        $cart = session()->get('cart');
                        $product_id = array_search($id, $cart["product_id"]);
                        unset($cart["product_id"][$product_id]);
                         session()->put('cart', $cart);
                         $request->session()->flash('failed',' product removed from cart !!');
                         return redirect()->back();

                    }

}