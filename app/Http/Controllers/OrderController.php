<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\OrderStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Repositories\OrderRepository;
use App\Http\Requests\PurchaseRequest;

class OrderController extends Controller
{

    public $orderRepository;

    public function __construct(OrderRepository $orderRepository)
{
    $this->middleware('auth');
    $this->orderRepository=$orderRepository;
}

// Checkout:
public function checkout_process_discount(PurchaseRequest $request){
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
$order=Order::with('user')->findOrfail($id);
$this->authorize('order_show',$order);
$order_statuses=OrderStatus::all();
    return view('order.show',[
      'order'=>$order,
      'order_statuses'=>$order_statuses,
    ]);
}
public function order_vendor_show($id){
    $user=auth()->user();
    $order=Order::findOrfail($id);
    $this->authorize('order_vendor_show',$order);
    $vendorProducts=$user->shop->products;
    $products = $order->products()->whereIn('products.id', $vendorProducts->pluck('id'))->get();
        return view('order.vendor_show',[
          'order'=>$order,
          'products'=>$products,
        ]);
    }
public function order_cancel(Request $request,$id){
    $order=Order::with('user')->findOrfail($id);
    $this->authorize('order_cancel',$order);
   return   $this->orderRepository->order_cancel($request,$id);
    }

    public function set_order_status(Request $request,$id){
        $order=Order::findOrfail($id);
        $this->authorize('set_order_status',$order);
        $order->order_status_id=$request->order_status;
        $order->save();
        $request->session()->flash('status','Order status : "'.$order->order_status->name.'"  is saved for this order !!');
        return redirect()->back();
         }



public function admin_orders_index(Request $request){
    $order = new Order();
    $this->authorize('admin_viewAny',$order);
$orders=Order::with(['user','order_status'])->get();
if(!empty($request->search)){
$orderIds =collect($orders)->pluck('id')->toArray();
$orders=$this->orderRepository->search($request,$orderIds);
}
return view('order.admin_index',[
    'orders'=>$orders,
]);
}

public function customer_orders_index(){
$user=auth()->user();
$orders=$user->orders;
    return view('order.customer_index',[
      'orders'=>$orders,
    ]);
}

public function vendor_orders_index(Request $request){
    $user=auth()->user();
    $order = new Order();
    $this->authorize('vendor_viewAny',$order);
    if ($user->shop) {
        $vendorProducts=$user->shop->products;
        $orderIds = DB::table('order_product')
    ->whereIn('product_id', $vendorProducts->pluck('id'))
    ->pluck('order_id')
    ->toArray();
    $orders = Order::whereIn('id', $orderIds)->get();
    if(!empty($request->search)){
        $orders=$this->orderRepository->search($request,$orderIds);
    }

    }
    else{
        $orders=null;
    }

    return view('order.vendor_index',[
        'orders'=>$orders,
        'user'=>$user,
    ]);

}




public function destroy(Request $request,$id)
{
    $order=Order::findOrfail($id);
    $this->authorize('delete',$order);
    return $this->orderRepository->order_delete($request,$order);
}












}


