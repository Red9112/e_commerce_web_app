<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\User;
use App\Exports\ShopsExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Database\Eloquent\Builder;

class ShopController extends Controller
{
    public function __construct()
    {
       //$this->middleware('auth');
    }
    public function validatedData(){
        return [
            'name'=>'required|min:4|max:30',
            'phone_number'=>'required|string',
            'email' => 'regex:/^.+@.+$/i',
            'picture'=>'image|mimes:jpeg,jpg,svg,png|max:3072|'
        ];
    }


    public function exportShopsList(){
        return view('shop.exportShopsList');
    }
    public function export(Request $request){

if ($request->optradio == "excel") {
    return Excel::download(new ShopsExport, 'shops.xlsx');
}
 else {
    return Excel::download(new ShopsExport, 'shops.html');
}

    }

    public function index(Request $request)
    {
        $shop=new Shop();
        $this->authorize('viewAny',$shop);
        $shops = Shop::with('user')->withCount('products')->orderBy('id', 'ASC')->get();
        if(!empty($request->search)){
            $searchTerm  = $request->input('search');
            $shops = Shop::with('user')->withCount('products')->orderBy('id', 'ASC')
            ->where('name', 'LIKE', "%$searchTerm%")
            ->get();
        }
        $shopProducts=Shop::shopProducts()->take(5)->get();

        return view('shop.index',[
            'shops'=>$shops,
            'shopProducts'=>$shopProducts,
        ]);
    }
    
    public function shops_view_user(Request $request)
    {
        $shops=Shop::all();
        return view('shop.shops_view_user',[
            'shops'=>$shops,
        ]);
    }

    public function display_shop_products($id){
        $shop=Shop::with('products','products.categories','products.images')->findOrfail($id);
        return view('shop.display_shop_products',[
            'shop'=>$shop,
        ]);
    }
    public function create()
    {
        $shop=new Shop();
        $this->authorize('store',$shop);
        $users=User::all();
        return view('shop.create',[
            'users'=>$users
        ]);

    }


    public function store(Request $request)
    {
        $shop=new Shop();
        $this->authorize('store',$shop);
        $request->validate($this->validatedData());
        $shop=new Shop();
       $shop->name=$request->input('name');
       $shop->phone_number=$request->input('phone_number');
       $shop->email=$request->input('email');
       if ($request->user_id==null) {
        $shop->user_id=auth()->id();
    }else{
        $shop->user_id=$request->input('user_id');
    }

       $shop->store_image_to_user($request);
       $shop->save();
$request->session()->flash('status','your shop created !! ');
       return redirect()->route('dashboard');
    }


    public function show($id)
    {
        $shop=Shop::with('user')->findOrfail($id);
        return view('shop.show',[
            'shop'=>$shop
        ]);
    }


    public function edit($id)
    {
    $shop=Shop::findOrfail($id);
    $this->authorize('update',$shop);
    return view('shop.edit',[
     'shop'=>$shop
        ]);
    }


    public function update(Request $request, $id)
    {
        $shop=Shop::findOrfail($id);
        $this->authorize('update',$shop);
        $request->validate($this->validatedData());
        $data=$request->only(['name','phone_number','email']);
        $shop->update($data);
        $shop->store_image_to_shop($request);
        $shop->save();
        $request->session()->flash('status',' shop updated !!');
        return redirect()->route('dashboard');
    }


    public function destroy(Request $request,Shop $shop)
    {
      $this->authorize('delete',$shop);
      $is_shipped_canceled=$shop->check_products_orders();
      if ($is_shipped_canceled) {
        $shop->products()->delete();
    }
    else {
        $request->session()->flash('failed',
        "shop can't be deleted because it has products that are involved in some
         orders who are not shipped or canceled !!");
        return redirect()->back();
    }
      $shop->delete();
      $request->session()->flash('failed'," shop is Deleted with all it's products !!");
      return redirect()->route('shop.index');
    }














}
