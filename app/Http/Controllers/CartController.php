<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{


    public function index()
    {
        //$cart = session()->get('cart');
        //$products =$cart['product_id'];
        //dd($products);
        $products = Product::whereIn('id', $products)->get();
        dd($products);
        return view('cart',[
            'products'=>$products
        ]);
    }
        public function addToCart(Request $request,$id)
        {
           // Session::forget('cart');
            //dd($data = Session::all());
           //if (isset($cart['product_id'])){} test existance of seesion key
dd($request->idprd);
           $cart = session()->get('cart');
            if(!$cart) {
                $cart = [
                    "product_id" => [
                        $id
                    ],
                            ];
                            session()->put('cart', $cart);
                            $request->session()->flash('status',' product added to chart !!');
                        }

                        else{
                            $cartProductsIds =collect($cart['product_id']);
                            if(!($cartProductsIds->contains(function ($item) use ($id) { return $item === $id;}))) {
                                    $cart['product_id'][]=$id;
                                    session()->put('cart', $cart);
                                    $request->session()->flash('status',' product added to chart !!');
                                }
                                else{
                                    $request->session()->flash('status',' product already in chart !!');
                                }
                        }
                        if($request->redirectInput=="cart") return redirect()->route('cart.index');
                        else return redirect()->back();
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
