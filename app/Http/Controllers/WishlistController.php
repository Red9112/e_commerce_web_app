<?php

namespace App\Http\Controllers;


use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{

                    public function index()
                    {
                $wishlist=auth()->user()->wishlist;
                ($wishlist==null)?$wishlist=Wishlist::create(['user_id'=>auth()->id()]):null;
                 $products=$wishlist->products;
                 return view('wishlist',[
                    'products'=>$products,
                ]);
                    }


                    public function store(Request $request,$id)
                    {
              $wishlist=auth()->user()->wishlist;
              ($wishlist==null)?$wishlist=Wishlist::create(['user_id'=>auth()->id()]):null;
              $wishlist->products()->syncWithoutDetaching([$id]);
              $request->session()->flash('status',' product added to Wishlist !!');
              return redirect()->back();
                    }



                    public function destroy(Request $request,$id)
                    {
                        $wishlist=auth()->user()->wishlist;
                        $wishlist->products()->detach($id);
                        $request->session()->flash('failed',' product removed from Wishlist !!');
                        return redirect()->back();
                    }



}
