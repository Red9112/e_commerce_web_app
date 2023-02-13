<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Address;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Shipping;
use App\Models\OrderStatus;
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
     $bonusQuantities[$product->id]=$discount->get_one_free($quantity)-$selectedQuantities[$product->id];
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
    'bonusQuantities'=>$bonusQuantities,
    'productsPrices'=>$productsPrices,
    'addresses'=>$addresses,
    'payments'=>$payments,
]);

    }

    public function confirm_order(Request $request){
        $productsPrices=$request->prices;
        $bonusQuantities=$request->bonusQuantities;
        $selectedQuantities=$request->selectedQuantities;
        $productIds = $request->input('products', []);
        $bonusQuantities = array_combine($productIds, $bonusQuantities);
        $selectedQuantities = array_combine($productIds, $selectedQuantities);
        $productsPrices = array_combine($productIds, $productsPrices);
        $products = Product::whereIn('id', $productIds)->get();

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
            'bonusQuantities'=>$bonusQuantities,
            'selectedQuantities'=>$selectedQuantities,
        ]);
    } 
     public function save_order(Request $request){
        
        $data=$request->only(['address_id', 'shipping_id','payment_id','order_total','order_status_id']);
        $data['user_id']=auth()->id();
        $order=Order::create($data);
        $productsIds=$request->input('products', []);
       // $order->products()->syncWithoutDetaching($productsIds);
       $bonusQuantities = array_combine($productsIds, $request->bonusQuantities);
        $selectedQuantities = array_combine($productsIds, $request->selectedQuantities);
        $productsPrices = array_combine($productsIds, $request->productsPrices);
        foreach ($productsIds as  $id) {
            $order->products()->attach($id,[
                'price' => $productsPrices[$id],
                'selected_quantity' => $selectedQuantities[$id],
                'bonus_quantity' =>$bonusQuantities[$id],
            ]);
        }
        $request->session()->flash('status','Order Saved !!');
        return redirect()->route('cart.index');

    }

// Order:
public function order_show($id){
    $order=Order::findOrfail($id);
        return view('order.customer_show',[
          'order'=>$order,
        ]);
    }

    public function order_cancel(Request $request,$id){
        $order=Order::findOrfail($id);
        if ($order->order_status=="shipped") {
            $request->session()->flash('failed',"Error : Order cannot be cancelled because it's already shipped !!");
        } else {
            $cancelledStatus = OrderStatus::where('name', 'cancelled')->first();
            if (!$cancelledStatus) {
           $request->session()->flash('failed','Error : Cancelled status not found !!');
          return  redirect()->back();
            }
            $order->order_status=$cancelledStatus->id;
            $order->save();
            $request->session()->flash('failed','Order Canceled !!');
        }
           return redirect()->back();
        }
 public function customer_orders_index(){
    $user=User::findOrfail(auth()->id());
       $orders=$user->orders;
        return view('order.customer_index',[
          'orders'=>$orders,
        ]);
    }
    public function vendor_orders_index(){
        $user=User::findOrfail(auth()->id());
        $orders=$user->shop->products;
        $productOrders = $product->orders()->whereIn('id', $orders->pluck('id'))->get();

        return view('order.vendor_index',[
            'orders'=>$orders,
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


