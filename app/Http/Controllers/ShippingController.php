<?php

namespace App\Http\Controllers;

use App\Models\Shipping;
use Illuminate\Http\Request;

class ShippingController extends Controller
{
    public function index()
    {
        $user=auth()->user();
        $this->authorize('viewAny',$user);
        $shippings=Shipping::all();
        return view('shipping.shipping',[
            'shippings'=>$shippings
        ]);
    }
    public function store(Request $request)
    {
        $user=auth()->user();
        $this->authorize('store',$user);
        $vldtData=$request->validate([
            'name'=>'min:3',
            'price' => 'required|numeric',]);
        Shipping::create($vldtData);
   $request->session()->flash('status','a shipping method was created !! ');
       return redirect()->route('shipping.index');
    }

    public function edit($id)
    {
        $user=auth()->user();
        $this->authorize('edit',$user);
        $shipping=Shipping::findOrFail($id);
        return view('shipping.edit',[
            'shipping'=>$shipping,
        ]);
    }

    public function update(Request $request, $id)
    {
        $user=auth()->user();
        $this->authorize('update',$user);
        $vldtData=$request->validate(['name'=>'min:3','price'=>'required|numeric']);
        Shipping::findOrfail($id)->update($vldtData);
        $request->session()->flash('status','a shipping method  updated !!');
      return redirect()->route('shipping.index');
    }

    public function destroy(Request $request,$id)
    {
        $user=auth()->user();
        $this->authorize('delete',$user);
        Shipping::destroy($id);
        $request->session()->flash('failed',' shipping method deleted !!');
        return redirect()->route('discount.index');
    }
}
