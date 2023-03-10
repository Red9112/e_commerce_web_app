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
        $discount=new Discount();
        $this->authorize('affect_to_products',$discount);
        $discount=Discount::findOrfail($id);
        $products=$user->shop->products;
        return view('discount.affect_to_products',[
            'discount'=>$discount,
            'products'=>$products,
        ]);
    }
    public function discount_product(Request $request,$id)
    {
        $discount=new Discount();
        $this->authorize('affect_to_products',$discount);
        $this->discountRepository->attach_discount_to_product($request,$id);
        return redirect()->route('discount.index');
    }
    public function index(Request $request)
    {
        $discount=new Discount();
        $this->authorize('viewAny',$discount);
        $discounts=Discount::orderBy('expired','desc')->get();
        if(!empty($request->search)){
            $discounts=$this->discountRepository->search($request);
        }
        return view('discount.discount',[
            'discounts'=>$discounts,
        ]);
    }
    public function create()
    {
        $discount=new Discount();
        $this->authorize('store',$discount);
        $types=DiscountType::all();
        return view('discount.create',[
            'types'=>$types,
        ]);
    }

    public function store(DiscountRequest $request)
    {
        $discount=new Discount();
        $this->authorize('store',$discount);
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
        $discount=Discount::findOrFail($id);
        $this->authorize('edit',$discount);
        $types=DiscountType::all();
        return view('discount.edit',[
            'discount'=>$discount,
            'types'=>$types,
        ]);
    }

    public function update(DiscountRequest $request, $id)
    {
        $discount=Discount::findOrfail($id);
        $this->authorize('update',$discount);
        $data=$request->only([
            'code','name','discount_type_id','value','start_date','end_date','description',
        ]);
        $is_expired=$request->has('expired');
        $discount->setIsExpiredAttribute($is_expired);
        $discount->update($data);
        $request->session()->flash('status','The disocunt  updated !!');
      return redirect()->route('discount.index');
    }

    public function destroy(Request $request,$id)
    {
        $discount=Discount::findOrFail($id);
        $this->authorize('delete',$discount);
        $discount->products()->detach();
        $discount->delete();
        $request->session()->flash('failed',' Discount Deleted !!');
        return redirect()->route('discount.index');
    }






}
