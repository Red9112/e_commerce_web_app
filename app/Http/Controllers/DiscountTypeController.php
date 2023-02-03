<?php

namespace App\Http\Controllers;

use App\Models\DiscountType;
use Illuminate\Http\Request;

class DiscountTypeController extends Controller
{


    public function store(Request $request)
    {
        $vldtData=$request->validate(['name'=>'min:3','description'=>'string',]);
        DiscountType::create($vldtData);
   $request->session()->flash('status','a Discount Type  was created !! ');
       return redirect()->route('discount.index');
    }
    public function edit($id)
    {
        $type=DiscountType::findOrFail($id);
        return view('discount.discountType_edit',[
            'type'=>$type,
        ]);
    }

    public function update(Request $request, $id)
    {
        $vldtData=$request->validate(['name'=>'min:3','description'=>'string',]);
        DiscountType::findOrfail($id)->update($vldtData);
        $request->session()->flash('status','a Discount Type  updated !!');
      return redirect()->route('discount.index');
    }

    public function destroy(Request $request,$id)
    {
        DiscountType::destroy($id);
        $request->session()->flash('failed',' Discount Type deleted !!');
        return redirect()->route('discount.index');
    }

}
