<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Discount;
use App\Models\DiscountType;
use Illuminate\Http\Request;
use App\Http\Requests\DiscountRequest;
use App\Repositories\DiscountRepository;
use League\CommonMark\Parser\Block\AbstractBlockContinueParser;

class DiscountController extends Controller
{

public $discountRepository;

    public function __construct(DiscountRepository $discountRepository)
    {
        $this->middleware('auth');
        $this->discountRepository=$discountRepository;
    }


    public function affect_to_products($id)
    {
        $user=auth()->user();
        $this->authorize('affect_to_products',$user);
        $discount=Discount::findOrfail($id);
        $products=$user->shop->products;
        return view('discount.affect_to_products',[
            'discount'=>$discount,
            'products'=>$products,
        ]);
    }
    public function discount_product(Request $request,$id)
    {
        $user=auth()->user();
        $this->authorize('affect_to_products',$user);
        $this->discountRepository->attach_discount_to_product($request,$id);
        return redirect()->route('discount.index');
    }
    public function index()
    {
        $user=auth()->user();
        $this->authorize('viewAny',$user);
        $discounts=Discount::all();
        return view('discount.discount',[
            'discounts'=>$discounts,
        ]);
    }
    public function create()
    {
        $user=auth()->user();
        $this->authorize('store',$user);
        $types=DiscountType::all();
        return view('discount.create',[
            'types'=>$types,
        ]);
    }

    public function store(DiscountRequest $request)
    {
        $user=auth()->user();
        $this->authorize('store',$user);
        $data=$request->only([
            'code','name','discount_type_id','value','start_date','end_date','description'
        ]);
        $data['user_id']=auth()->id();
        Discount::create($data);
   $request->session()->flash('status','a discount was created !! ');
       return redirect()->route('discount.index');
    }

    public function edit($id)
    {
        $user=auth()->user();
        $this->authorize('edit',$user);
        $discount=Discount::findOrFail($id);
        $types=DiscountType::all();
        return view('discount.edit',[
            'discount'=>$discount,
            'types'=>$types,
        ]);
    }

    public function update(DiscountRequest $request, $id)
    {
        $user=auth()->user();
        $this->authorize('update',$user);
        $data=$request->only([
            'code','name','discount_type_id','value','start_date','end_date','description',
        ]);
        $discount=Discount::findOrfail($id);
        $is_expired=$request->has('expired');
        $discount->setIsExpiredAttribute($is_expired);
        $discount->update($data);
        $request->session()->flash('status','The disocunt  updated !!');
      return redirect()->route('discount.index');
    }

    public function destroy(Request $request,$id)
    {
        $user=auth()->user();
        $this->authorize('delete',$user);
        Discount::destroy($id);
        $request->session()->flash('failed',' Discount Deleted !!');
        return redirect()->route('discount.index');
    }






}
