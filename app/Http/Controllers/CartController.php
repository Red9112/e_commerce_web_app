<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{


    public function index()
    {
        return view('cart');
    }
        public function addToCart(Request $request,$id)
        {
           // Session::forget('cart');
            //dd($data = Session::all());
           //if (isset($cart['product_id'])){} test existance of seesion key

           $cart = session()->get('cart');
            if(!$cart) {
                $cart = [
                    "product_id" => [
                        $id
                    ],
                            ];
                            session()->put('cart', $cart);
                            $request->session()->flash('status',' product added to chart !!');
                            return redirect()->back();
                        }

                        else{
                            $cartProductsIds =collect($cart['product_id']);
                            if(!($cartProductsIds->contains(function ($item) use ($id) { return $item === $id;}))) {
                                    $cart['product_id'][]=$id;
                                    session()->put('cart', $cart);
                                    $request->session()->flash('status',' product added to chart !!');
                                    return redirect()->back();
                                }
                                else{
                                    $request->session()->flash('status',' product already in chart !!');
                                    return redirect()->back();
                                }
                        }


                    }


                    public function removeSessionProduct(Request $request,$id)
                    {
                        $cart = session()->get('cart');
                        $product_id = array_search($id, $cart["product_id"]);
                        unset($cart["product_id"][$product_id]);
                         session()->put('cart', $cart);
                         $request->session()->flash('failed',' product removed from chart !!');
                         return redirect()->back();

                    }

}
