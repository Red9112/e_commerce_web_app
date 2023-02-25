<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\User;
use App\Exports\ShopsExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ShopController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
    }
    public function validatedData(){
        return [
            'name'=>'required|min:4|max:20',
            'phone_number'=>'required|string',
            'email' => 'regex:/^.+@.+$/i',
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

    public function index()
    {
        $shop=new Shop();
        $this->authorize('viewAny',$shop);
        $shops = Shop::with('user')->withCount('products')->orderBy('id', 'ASC')->get();
        $shopProducts=Shop::shopProducts()->take(5)->get();

        return view('shop.index',[
            'shops'=>$shops,
            'shopProducts'=>$shopProducts,
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
        $shop->save();
        $request->session()->flash('status',' shop updated !!');
        return redirect()->route('dashboard');
    }


    public function destroy(Request $request,Shop $shop)
    {
      $this->authorize('delete',$shop);
    Shop::destroy($shop->id);
      $request->session()->flash('failed',' shop Deleted !!');
      return redirect()->route('shop.index');
    }
}
