<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Repositories\OrderRepository;

class OrderController extends Controller
{

    public $orderRepository;

    public function __construct(OrderRepository $orderRepository)
{
    $this->orderRepository=$orderRepository;
}

// Checkout:
public function checkout_process_discount(Request $request){
    $request->validate(['shipping'=>'required']);
    $result=$this->orderRepository->checkout_process_discount($request);
return $result;
}

public function confirm_order(Request $request){
    return $this->orderRepository->confirm_order($request);
}
 public function save_order(Request $request){
     $this->orderRepository->save_order($request);
    $request->session()->flash('status','Order Saved !!');
    return redirect()->route('cart.index');
}

// Order:

public function order_show($id){
$order=Order::findOrfail($id);
    return view('order.show',[
      'order'=>$order,
    ]);
}

public function order_cancel(Request $request,$id){
   return   $this->orderRepository->order_cancel($request,$id);
    }




public function customer_orders_index(){
$user=User::findOrfail(auth()->id());
   $orders=$user->orders;
    return view('order.customer_index',[
      'orders'=>$orders,
    ]);
}


public function vendor_orders_index(){
    $user=auth()->user();
    $vendorProducts=$user->shop->products;
    $orderIds = DB::table('order_product')
->whereIn('product_id', $vendorProducts->pluck('id'))
->pluck('order_id')
->toArray();
$orders = Order::whereIn('id', $orderIds)->get();
    return view('order.vendor_index',[
        'orders'=>$orders,
        'user'=>$user,
    ]);
}
public function order_vendor_show($id){
    $user=auth()->user();
    $order=Order::findOrfail($id);
    $vendorProducts=$user->shop->products;
    $products = $order->products()->whereIn('products.id', $vendorProducts->pluck('id'))->get();
        return view('order.vendor_show',[
          'order'=>$order,
          'products'=>$products,
        ]);
    }

public function admin_orders_index(){
    $orders=Order::with(['user','order_status'])->get();
    return view('order.admin_index',[
        'orders'=>$orders,
    ]);
}

public function destroy(Request $request,$id)
{
    Order::destroy($id);
    $request->session()->flash('failed',' Order deleted !!');
    return redirect()->back();
}
}


