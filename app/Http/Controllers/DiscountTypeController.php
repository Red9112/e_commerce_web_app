<?php

namespace App\Http\Controllers;

use App\Models\DiscountType;
use Illuminate\Http\Request;

class DiscountTypeController extends Controller
{

    public function index()
    {
        $discountType=new DiscountType();
        $this->authorize('viewAny',$discountType);
        $types=DiscountType::all();
        return view('discount.discount_type.index_create',[
            'types'=>$types,
        ]);
    }
    public function store(Request $request)
    {
        $discountType=new DiscountType();
        $this->authorize('store',$discountType);
        $vldtData=$request->validate(['name'=>'min:3','description'=>'string',]);
        DiscountType::create($vldtData);
        $request->session()->flash('status','a Discount Type  was created !! ');
        return redirect()->route('discount_type.index');
    }
    public function edit($id)
    {
        $type=DiscountType::findOrFail($id);
        $this->authorize('edit',$type);
        return view('discount.discountType_edit',[
            'type'=>$type,
        ]);
    }

    public function update(Request $request, $id)
    {
        $discountType= DiscountType::findOrfail($id);
        $this->authorize('update',$discountType);
        $vldtData=$request->validate(['name'=>'min:3','description'=>'string',]);
        $discountType->update($vldtData);
        $request->session()->flash('status','a Discount Type  updated !!');
      return redirect()->route('discount.index');
    }

    public function destroy(Request $request,$id)
    {
        $discountType= new DiscountType();
        $this->authorize('delete',$discountType);
        DiscountType::destroy($id);
        $request->session()->flash('failed',' Discount Type deleted !!');
        return redirect()->route('discount.index');
    }

}
