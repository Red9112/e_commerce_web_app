<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Repositories\ProductRepository;

class DashboardController extends Controller
{


     public function __construct()
     {
          //  $this->middleware('auth');
     }


    public function dashboard(Request $request){
        $products=Product::with(['categories','images'])->orderBy('created_at','desc')->get();
        if(!empty($request->search_products)){
            $productRepository=new ProductRepository();
            $products=$productRepository->search($request);
        }
        return view('dashboard',[
          'products'=>$products,
        ]);
    }
    public function prodByCat($id){
      $cat=Category::with('products','products.images')->findOrfail($id);
      $products=$cat->products;
      return view('dashboard',[
        'products'=>$products,

      ]);
    }


}
