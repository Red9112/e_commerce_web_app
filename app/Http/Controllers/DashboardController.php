<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function __construct()
    {
      //  $this->middleware('auth');
    }
 

    public function dashboard(){

      $products=Product::with(['categories','images'])->orderBy('created_at','desc')->get();
     // dd($categories);
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
