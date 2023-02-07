<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Shipping;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function checkout_process_discount(Request $request){
        $request->validate(['shipping'=>'required']);
        $shipping=Shipping::findOrfail($request->shipping);
        $productIds = $request->input('products', []);
        $selectedQuantities = $request->input('quantity', []);
        $selectedQuantities = array_filter($selectedQuantities, function ($productId) use ($productIds) {
            return in_array($productId, $productIds);
        },ARRAY_FILTER_USE_KEY);
    $products = Product::whereIn('id', $productIds)->get();
    $subtotal=0;
    $quantitiesWithOffer=$selectedQuantities;
foreach ($products as $product) {
    $discounts=$product->discounts;
    $quantity = $selectedQuantities[$product->id];
    $disPrice=0;
    foreach ($discounts as $discount){
        if($discount->discount_type->name=="percent"){

        $disPrice+=$discount->percent($product->price);
        }
    }
    foreach ($discounts as $discount){
        if($discount->discount_type->name=="fixed"){
            $disPrice+=$discount->value;
        }
    }
    $productPrice=($product->price-$disPrice)*$quantity;
    foreach ($discounts as $discount){
     $quantitiesWithOffer[$product->id]=$discount->get_one_free($quantity);//order quantity after apply discount
     }
    $productsPrices[$product->id]=$productPrice;
    $subtotal+=$productPrice;
    }

    $total= $subtotal+ $shipping->price;
return view('checkout.checkout_process',[
    'products'=>$products,
    'subtotal'=>$subtotal,
    'shipping'=>$shipping,
    'total'=>$total,
    'selectedQuantities'=>$selectedQuantities,
    'quantitiesWithOffer'=>$quantitiesWithOffer,
    'productsPrices'=>$productsPrices,
]);

    }

    public function confirm_order(Request $request){

        return view('checkout.confirm_order',[

        ]);
    }
    public function save_order(Request $request){
        return redirect()->route('cart.index');
    }


}


