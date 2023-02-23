<?php

namespace App\Http\Controllers;

use App\Models\DiscountType;
use Illuminate\Http\Request;

class DiscountTypeController extends Controller
{

    public function index()
    {
        $user=auth()->user();
        $this->authorize('viewAny',$user);
        $types=DiscountType::all();
        return view('discount.discount_type.index_create',[
            'types'=>$types,
        ]);
    }
    public function store(Request $request)
    {
        $user=auth()->user();
        $this->authorize('store',$user);
        $vldtData=$request->validate(['name'=>'min:3','description'=>'string',]);
        DiscountType::create($vldtData);
        $request->session()->flash('status','a Discount Type  was created !! ');
        return redirect()->route('discount_type.index');
    }
    public function edit($id)
    {
        $user=auth()->user();
        $this->authorize('edit',$user);
        $type=DiscountType::findOrFail($id);
        return view('discount.discountType_edit',[
            'type'=>$type,
        ]);
    }

    public function update(Request $request, $id)
    {
        $user=auth()->user();
        $this->authorize('update',$user);
        $vldtData=$request->validate(['name'=>'min:3','description'=>'string',]);
        DiscountType::findOrfail($id)->update($vldtData);
        $request->session()->flash('status','a Discount Type  updated !!');
      return redirect()->route('discount.index');
    }

    public function destroy(Request $request,$id)
    {
        $user=auth()->user();
        $this->authorize('delete',$user);
        DiscountType::destroy($id);
        $request->session()->flash('failed',' Discount Type deleted !!');
        return redirect()->route('discount.index');
    }

}
