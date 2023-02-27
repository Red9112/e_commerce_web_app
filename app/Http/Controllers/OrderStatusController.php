<?php

namespace App\Http\Controllers;

use App\Models\OrderStatus;
use Illuminate\Http\Request;

class OrderStatusController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $orderStatus=new OrderStatus();
        $this->authorize('viewAny',$orderStatus);
        $order_statuses=OrderStatus::all();
        return view('order_status.order_status',[
            'order_statuses'=>$order_statuses
        ]);
    }
    public function store(Request $request)
    {
        $orderStatus=new OrderStatus();
        $this->authorize('store',$orderStatus);
        $vldtData=$request->validate(['name'=>'min:3',]);
            OrderStatus::create($vldtData);
   $request->session()->flash('status','an order_statuses  was created !! ');
       return redirect()->route('orderStatus.index');
    }

    public function edit($id)
    {
        $order_status=OrderStatus::findOrFail($id);
        $this->authorize('edit',$order_status);
        return view('order_status.edit',[
            'order_status'=>$order_status,
        ]);
    }

    public function update(Request $request, $id)
    {
        $order_status=OrderStatus::findOrfail($id);
        $this->authorize('update',$order_status);
        $vldtData=$request->validate(['name'=>'min:3']);
        $order_status->update($vldtData);
        $request->session()->flash('status','an order_status updated !!');
        return redirect()->route('orderStatus.index');
    }

    public function destroy(Request $request,$id)
    {
        $orderStatus=OrderStatus::findOrfail($id);
        $this->authorize('delete',$orderStatus);
        $orderStatus_orders_count=$orderStatus->orders->count();
        if ($orderStatus_orders_count!=0) {
            $request->session()->flash('failed',
            " Error: order_status can't be deleted because it's related with some orders!!");
        }
        else{
            $orderStatus->delete();
            $request->session()->flash('failed',' order_status is deleted !!');
        }
        return redirect()->route('orderStatus.index');
    }

}
