<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Pdf;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
     $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        return view('home');
    }


    public function pdf()
    {
        $shops = Shop::withCount('products')->orderBy('id', 'ASC')->get();
        //{{-- method 1 to share data --}}
        // view()->share([
        //         'shops'=>$shops,
        // ]);
        //$pdf = Pdf::loadView('invoice.pdf'); 
        //end m1 

  //{{-- method 2 to share data --}}
        $pdf = Pdf::loadView('invoice.pdf',[
           'shops'=> $shops
        ]);
        //end m2
        return $pdf->download('invoice.pdf');
       
    }
    public function  downloadPDF()
    {
        return view('invoice.downloadPDF');
    }
  
   
   
   
}
