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
      $categories=Category::with('products')->get();
     // dd($categories);
        return view('dashboard',[
          'products'=>$products,
          'categories'=>$categories,
        ]);
    }
    public function prodByCat($id){
      $categories=Category::with('products')->get();
      $cat=Category::with('products','products.images')->findOrfail($id);
      $products=$cat->products;
      return view('dashboard',[
        'products'=>$products,
        'categories'=>$categories
     
      ]);
    }

  
}
