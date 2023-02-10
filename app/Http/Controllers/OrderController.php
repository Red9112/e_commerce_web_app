<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Address;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

// Checkout:
    public function checkout_process_discount(Request $request){
        $request->validate(['shipping'=>'required']);
        $shipping=Shipping::findOrfail($request->shipping);
        $user=User::findOrfail(auth()->id());
        $addresses=$user->addresses;
        $payments=$user->payments;
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
    'addresses'=>$addresses,
    'payments'=>$payments,
]);

    }

    public function confirm_order(Request $request){
        $productsPrices=$request->prices;
        $quantities=$request->quantities;
        $productIds = $request->input('products', []);
        $products = Product::whereIn('id', $productIds)->get();
        $productsPrices = array_combine($productIds, $productsPrices);
        $quantities = array_combine($productIds, $quantities);
$request->validate(['shipping'=>'required','total'=>'required','payment'=>'required','address'=>'required']);
$shipping=Shipping::findOrfail($request->shipping);
$payment=Payment::findOrfail($request->payment);
$address=Address::findOrfail($request->address);
        return view('checkout.confirm_order',[
            'shipping'=>$shipping,
            'total'=>$request->total,
            'payment'=>$payment,
            'address'=>$address,
            'products'=>$products,
            'productsPrices'=>$productsPrices,
            'quantities'=>$quantities,
        ]);
    }
    public function save_order(Request $request){
        $data=$request->only(['address_id', 'shipping_id','payment_id','order_total','order_status_id']);
        $order=Order::create($data);
        $products=$request->input('products', []);
        $order->products()->syncWithoutDetaching($products);
        $request->session()->flash('status','Order Saved !!');
        return redirect()->route('cart.index');
    }

// Order:

 public function customer_orders_index(Request $request){
       
        return view('order.customer_index',[
           // ''=>$,
        ]);
    }
    public function vendor_orders_index(Request $request){
        return view('order.vendor_index',[
           // ''=>$,
        ]);
    }
    
    public function admin_orders_index(Request $request){
       
        return view('order.admin_index',[
          //  ''=>$,
        ]);
    }
    public function show(Request $request){

        return view('order.show',[
          //  ''=>$,
        ]);
    }
    public function destroy(Request $request,$id)
    {
        Order::destroy($id);
        $request->session()->flash('failed',' Order deleted !!');
        return redirect()->back();
    }
}


