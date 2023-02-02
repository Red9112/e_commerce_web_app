<?php

namespace App\Http\Controllers;

use App\Models\OrderStatus;
use Illuminate\Http\Request;

class OrderStatusController extends Controller
{
    public function index()
    {
        $order_statuses=OrderStatus::all();
        return view('order_status.order_status',[
            'order_statuses'=>$order_statuses
        ]);
    }
    public function store(Request $request)
    {
        $vldtData=$request->validate(['name'=>'min:3',]);
            OrderStatus::create($vldtData);
   $request->session()->flash('status','an order_statuses  was created !! ');
       return redirect()->route('orderStatus.index');
    }

    public function edit($id)
    {
        $order_status=OrderStatus::findOrFail($id);
        return view('order_status.edit',[
            'order_status'=>$order_status,
        ]);
    }

    public function update(Request $request, $id)
    {
        $vldtData=$request->validate(['name'=>'min:3']);
        OrderStatus::findOrfail($id)->update($vldtData);
        $request->session()->flash('status','an order_status updated !!');
      return redirect()->route('orderStatus.index');
    }

    public function destroy(Request $request,$id)
    {
        OrderStatus::destroy($id);
        $request->session()->flash('failed',' order_status deleted !!');
        return redirect()->route('orderStatus.index');
    }
}
