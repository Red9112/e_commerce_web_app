<?php

namespace  App\Repositories;

use App\Models\User;
use App\Models\Order;
use App\Helpers\Helper;
use App\Models\Address;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Discount;
use App\Models\Shipping;
use App\Models\OrderStatus;
use Illuminate\Http\Request;
use App\Http\Requests\PurchaseRequest;
use Illuminate\Database\Eloquent\Builder;



class OrderRepository{



    public function search(Request $request,array $orderIds)
    {
        $searchTerm  = $request->input('search');
        $search_by  = $request->input('search_by');
       if($search_by=='date') {
            $orders = Order::with(['order_status','user'])
            ->whereIn('id', $orderIds)
            ->whereDate('created_at',$searchTerm)
            ->get();
        }
        elseif ($search_by=='status'){
            $orders = Order::with(['order_status','user'])
            ->whereIn('id', $orderIds)
            ->whereHas('order_status', function(Builder $query) use ($searchTerm ) {
                $query->where('name', 'LIKE', "%$searchTerm%");
            })
            ->get();
        }
        else {
            $orders = Order::with(['order_status','user'])
            ->whereIn('id', $orderIds)
            ->whereHas('user', function(Builder $query) use ($searchTerm ) {
                $query->where('name', 'LIKE', "%$searchTerm%");
            })
            ->get();
        }


        return $orders;
    } 

///////////// Checkout:
    public function checkout_process_discount(PurchaseRequest $request){
       // $request->validate(['shipping'=>'required','products'=>'required']);
        $shipping=Shipping::findOrfail($request->shipping);
        $user=User::findOrfail(auth()->id());
        $addresses=$user->addresses;
        $payments=$user->payments;
        $productIds = $request->input('products', []);
        $selectedQuantities = $request->input('quantity', []);
        $selectedQuantities = array_filter($selectedQuantities, function ($productId) use ($productIds) {
            return in_array($productId, $productIds);
        },ARRAY_FILTER_USE_KEY);

        $add_discnt_by_code = $request->input('add_discnt_by_code', []);
$result=$this->affect_discounts_to_products($productIds,$selectedQuantities,$add_discnt_by_code);
$result['selectedQuantities']=$selectedQuantities;
$result['shipping']=$shipping;
$result['addresses']=$addresses;
$result['payments']=$payments;
$result['total']= $result['subtotal'] + $result['shipping']->price;
//convert to DH

$subtotal_dh=Helper::convertPriceToDh($result['subtotal']);
$shipping_dh=Helper::convertPriceToDh($result['shipping']->price);
$total_dh=Helper::convertPriceToDh($result['total']);
return view('checkout.checkout_process',[
    'products'=>$result['products'],
    'subtotal'=>$result['subtotal'],
    'shipping'=>$result['shipping'],
    'total'=>$result['total'],
    'selectedQuantities'=>$result['selectedQuantities'],
    'bonusQuantities'=>$result['bonusQuantities'],
    'productsPrices'=>$result['productsPrices'],
    'addresses'=>$result['addresses'],
    'payments'=>$result['payments'],
    'total_dh'=>$total_dh,
    'shipping_dh'=>$shipping_dh,
    'subtotal_dh'=>$subtotal_dh,

    ]);
    }

    public function affect_discounts_to_products($productIds,$selectedQuantities,$add_discnt_by_code){
$products = Product::whereIn('id', $productIds)->get();
$subtotal=0;
foreach ($products as $product) {

$dis_by_id=Discount::where('code',$add_discnt_by_code[$product->id])->with('discount_type')->first();
$dis_by_id_disPrice=0;

if (is_object($dis_by_id) && !$dis_by_id->expired) {
    ($dis_by_id->discount_type->name=="percent")?$dis_by_id_disPrice+=$dis_by_id->percent($product->price):null;
    ($dis_by_id->discount_type->name=="fixed")?$dis_by_id_disPrice+=$dis_by_id->value:null;
    }
 
    $discounts=$product->discounts;
    $quantity = $selectedQuantities[$product->id];
    $disPrice=0;
    foreach ($discounts as $discount){
        if($discount->discount_type->name=="percent" && !$discount->expired){
        $disPrice+=$discount->percent($product->price);
        }}
    foreach ($discounts as $discount){
        if($discount->discount_type->name=="fixed" && !$discount->expired){
            $disPrice+=$discount->value;
        }}
    $productPrice=($product->price-($disPrice+$dis_by_id_disPrice))*$quantity;
    $bonusQuantities[$product->id]=0;
    $totalQuantity=$quantity;
    //if (!$discounts->isEmpty()) {
    foreach ($discounts as $discount){
(!$discount->expired)?$totalQuantity=$discount->get_one_free($quantity):null;
}


    if ($totalQuantity==$quantity && is_object($dis_by_id) && !$dis_by_id->expired) {
        $totalQuantity=$dis_by_id->get_one_free($quantity);
         }
 ($totalQuantity > $product->qty_in_stock) 
?$bonusQuantities[$product->id]= $quantity-$selectedQuantities[$product->id] 
:$bonusQuantities[$product->id]= $totalQuantity-$selectedQuantities[$product->id];
       
       
    
        $productsPrices[$product->id]=$productPrice;
        $subtotal+=$productPrice;
     }

$result['products']=$products;
$result['productsPrices']=$productsPrices;
$result['bonusQuantities']=$bonusQuantities;
$result['subtotal']=$subtotal;
return $result;
    }

    public function affect_discounts_by_code($productIds,$selectedQuantities){

    }
/////////////Confirm order:
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
    ////////Save order:

    public function save_order(Request $request){
        $data=$request->only(['address_id', 'shipping_id','payment_id','order_total']);
        $order_status_id=OrderStatus::where('name','Pending')->pluck('id');
        ($order_status_id->isEmpty())?$order_status_id=1:null;
        $data['order_status_id']= $order_status_id[0];
        $data['user_id']=auth()->id();
        $order=Order::create($data);
        $productsIds=$request->input('products', []);
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
    }
    //////////order cancel
    public function order_cancel(Request $request,$id){
        $order=Order::findOrfail($id);
        if ($order->order_status=="shipped") {
            $request->session()->flash('failed',"Error : Order cannot be canceled because it's already shipped !!");
        } else {
            $canceledStatus = OrderStatus::where('name', 'canceled')->first();
            if (!$canceledStatus) {
           $request->session()->flash('failed','Error : Canceled status not found !!');
          return  redirect()->back();
            }
            $order->order_status_id=$canceledStatus->id;
            $order->save();
            $request->session()->flash('failed','Order Canceled !!');
        }
           return redirect()->back();
    }


    public function order_delete(Request $request,Order $order){

        if($order->order_status->name=="shipped" || $order->order_status->name=="canceled"){
            $order->products()->detach();
        }
        else {
            $request->session()->flash('failed',
            "order can't be deleted because it's not shipped or canceled !!");
            return redirect()->back();
        }

        $order->delete();
        $request->session()->flash('failed',' Order deleted !!');
        return redirect()->back();
    }




}
