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
        $user=auth()->user();
        $this->authorize('viewAny',$user);
        $order_statuses=OrderStatus::all();
        return view('order_status.order_status',[
            'order_statuses'=>$order_statuses
        ]);
    }
    public function store(Request $request)
    {
        $user=auth()->user();
        $this->authorize('store',$user);
        $vldtData=$request->validate(['name'=>'min:3',]);
            OrderStatus::create($vldtData);
   $request->session()->flash('status','an order_statuses  was created !! ');
       return redirect()->route('orderStatus.index');
    }

    public function edit($id)
    {
        $user=auth()->user();
        $this->authorize('edit',$user);
        $order_status=OrderStatus::findOrFail($id);
        return view('order_status.edit',[
            'order_status'=>$order_status,
        ]);
    }

    public function update(Request $request, $id)
    {
        $user=auth()->user();
        $this->authorize('update',$user);
        $vldtData=$request->validate(['name'=>'min:3']);
        OrderStatus::findOrfail($id)->update($vldtData);
        $request->session()->flash('status','an order_status updated !!');
      return redirect()->route('orderStatus.index');
    }

    public function destroy(Request $request,$id)
    {
        $user=auth()->user();
        $this->authorize('delete',$user);
        OrderStatus::destroy($id);
        $request->session()->flash('failed',' order_status deleted !!');
        return redirect()->route('orderStatus.index');
    }

}
