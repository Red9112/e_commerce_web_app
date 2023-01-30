<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{


    public function index()
    {
        $cartSession = session()->get('cart');
       ($cartSession)? $products = Product::whereIn('id',$cartSession['product_id'])->get():$products =null;
       $cartWishlist=auth()->user()->cart->products;
        return view('cart',[
            'products'=>$products,
            'cartWishlist'=>$cartWishlist
        ]);
    }
        public function addToCart(Request $request)
        {
// Session::forget('cart');
//dd($data = Session::all());
 //if (isset($cart['product_id'])){} test existance of seesion key
//            $products =$cart['product_id'];
            $product_to_cart=$request->idprd;
            $cart = session()->get('cart');
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

                    // Wishlist:

                    public function indexWishlist()
                    {
                 $products=Cart::all();
                 return view('cart',[
                    'products'=>$products
                ]);

                    }

                    public function storeWishlist(Request $request,$id)
                    {
              $cart=auth()->user()->cart;
              ($cart==null)?$cart=Cart::create(['user_id'=>auth()->id()]):null;
              $cart->products()->syncWithoutDetaching([$id]);
              $request->session()->flash('status',' product added to Wishlist !!');
              return redirect()->back();
                    }


                    public function destroyWishlist(Request $request,$id)
                    {
                        $cart=auth()->user()->cart;
                        $cart->products()->detach($id);
                         $request->session()->flash('failed',' product removed from Wishlist !!');
                         return redirect()->back();
                    }




}
