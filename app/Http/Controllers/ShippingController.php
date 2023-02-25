<?php

namespace App\Http\Controllers;

use App\Models\Shipping;
use Illuminate\Http\Request;

class ShippingController extends Controller
{
    public function index()
    {
        $shipping=new Shipping();
        $this->authorize('viewAny',$shipping);
        $shippings=Shipping::all();
        return view('shipping.shipping',[
            'shippings'=>$shippings
        ]);
    }
    public function store(Request $request)
    {
        $shipping=new Shipping();
        $this->authorize('store',$shipping);
        $vldtData=$request->validate([
            'name'=>'min:3',
            'price' => 'required|numeric',]);
        Shipping::create($vldtData);
   $request->session()->flash('status','a shipping method was created !! ');
       return redirect()->route('shipping.index');
    }

    public function edit($id)
    {
        $shipping=Shipping::findOrFail($id);
        $this->authorize('edit',$shipping);
        return view('shipping.edit',[
            'shipping'=>$shipping,
        ]);
    }

    public function update(Request $request, $id)
    {
        $shipping=Shipping::findOrfail($id);
        $this->authorize('update',$shipping);
        $vldtData=$request->validate(['name'=>'min:3','price'=>'required|numeric']);
        $shipping->update($vldtData);
        $request->session()->flash('status','a shipping method  updated !!');
      return redirect()->route('shipping.index');
    }

    public function destroy(Request $request,$id)
    {
        $shipping=new Shipping();
        $this->authorize('delete',$shipping);
        Shipping::destroy($id);
        $request->session()->flash('failed',' shipping method deleted !!');
        return redirect()->route('discount.index');
    }
}
