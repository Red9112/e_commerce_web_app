<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use Illuminate\Http\Request;
use App\Http\Requests\DiscountRequest;

class DiscountController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $discounts=Discount::all();
        return view('discount.discount',[
            'discounts'=>$discounts
        ]);
    }

    public function store(DiscountRequest $request)
    {
        $data=$request->only([
            'code','name','type','value_percent','start_date','end_date','description'
        ]);
      Discount::create($data);
   $request->session()->flash('status','a discount was created !! ');
       return redirect()->route('discount.index');
    }

    public function edit($id)
    {
        $discount=Discount::findOrFail($id);
        return view('discount.edit',[
            'discount'=>$discount,
        ]);
    }

    public function update(DiscountRequest $request, $id)
    {
        $data=$request->only([
            'code','name','type','value_percent','start_date','end_date','description','expired'
        ]);
        Discount::findOrfail($id)->update($data);
        $request->session()->flash('status','The disocunt  updated !!');
      return redirect()->route('discount.index');
    }

    public function destroy(Request $request,$id)
    {
        Discount::destroy($id);
        $request->session()->flash('failed',' Discount Deleted !!');
        return redirect()->route('discount.index');
    }





}
