<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Discount;
use App\Models\DiscountType;
use Illuminate\Http\Request;
use App\Http\Requests\DiscountRequest;
use League\CommonMark\Parser\Block\AbstractBlockContinueParser;

class DiscountController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }


    public function affect_to_products($id)
    {
        $discount=Discount::findOrfail($id);
        $user=auth()->user();
        $products=$user->shop->products;
        return view('discount.affect_to_products',[
            'discount'=>$discount,
            'products'=>$products,
        ]);
    }
    public function discount_product(Request $request,$id)
    {
        // Vendor discount:can apply just to his products
        $discount=Discount::findOrfail($id);
        $user=auth()->user();
        if($request->my_products){
            $products=collect($user->shop->products);
            $productsIds=$products->pluck('id');
            $discount->products()->syncWithoutDetaching($productsIds);
            $request->session()->flash('status',"The discount affected to all your products !! ");
        }
        elseif($request->input('products', [])){
            $productsIds=$request->input('products', []);
            $discount->products()->syncWithoutDetaching($productsIds);
            $request->session()->flash('status',"The discount  affected to selected products !! ");
        }
        elseif($request->input('cats', [])){
            $categoriesIds=$request->input('cats', []);
            $products=collect($user->shop->products);
            foreach ($products as $product) {
            $ProdCategoriesIds=collect($product->categories)->pluck('id');
            foreach ($categoriesIds as $catId) {
(in_array($ProdCategoriesIds,$catId) )?$discount->products()->syncWithoutDetaching($product->id):null;
            }
            }
            $request->session()->flash('status',"The discount affected to products by selected categories !! ");
        }
        //admin discount:can apply to all site products
        elseif($request->input('catsToAll', [])){
            $categoriesIds=$request->input('cats', []);
            $categories=Category::where('id', $categoriesIds)->get();
            foreach ($categories as $cat) {
                $productsIds=collect($cat->products)->pluck('id');
                $discount->products()->syncWithoutDetaching($productsIds);
            }
        }
        elseif($request->applyToAll){
            $productsIds=Product::get()->pluck('id');
            $discount->products()->syncWithoutDetaching($productsIds);
            $request->session()->flash('status',"The discount affected to all site  products !! ");
        }

        else $request->session()->flash('failed',"The discount doesn't affected to any product !! ");
        return redirect()->route('discount.index');
    }
    public function index()
    {
        $discounts=Discount::all();
        $types=DiscountType::all();
        return view('discount.discount',[
            'discounts'=>$discounts,
            'types'=>$types,
        ]);
    }
    public function create()
    {
        $types=DiscountType::all();
        return view('discount.create',[
            'types'=>$types,
        ]);
    }

    public function store(DiscountRequest $request)
    {
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
        $types=DiscountType::all();
        return view('discount.edit',[
            'discount'=>$discount,
            'types'=>$types,
        ]);
    }

    public function update(DiscountRequest $request, $id)
    {
        $data=$request->only([
            'code','name','discount_type_id','value','start_date','end_date','description','expired'
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
