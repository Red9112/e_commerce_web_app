<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\User;
use App\Models\Image;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $user=User::with(['shop','shop.products','shop.products.images','shop.products.categories'])
     ->findOrfail(auth()->id());
       if ($user->shop!=null) {
       $products=$user->shop->products; }

        else {
        $products=null;
            }


        return view('product.index',[
            'products'=>$products,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

     $categories=Category::all();
        return view('product.create',[
            'categories'=>$categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {

        $vender=User::findOrfail(auth()->id());
        $data=$request->only(['sku','name','description','qty_in_stock','price']);
        $data['shop_id']=$vender->shop->id;
        $product=Product::create($data);
        //store categories--
$filteredAttributeNames = array_filter($request->keys(), function ($key){
    return strpos($key, 'category_id-') === 0;
});
$filteredAttributeNames = collect($filteredAttributeNames);
$filteredAttributeNames->push('category_id');
$categories=$request->only($filteredAttributeNames->toArray());
$categoriesIds=collect($categories)->values()->toArray();
$product->categories()->sync($categoriesIds);
//end store categories

        // Upload file
$hasfile=$request->hasfile('picture');
$picture=$request->file('picture');
if($hasfile) {
$file=Storage::putFile('products',$picture);
$path=Storage::url($file);
// first method:
// $image=new Image(['url'=>$path]);
// $product->images()->save($image);
// second method:
$image=Image::make(['url'=>$path]);
$product->images()->save($image);

      }
// end
$request->session()->flash('status','your product was created !! ');
return redirect()->route('product.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product=Cache::remember("product-{$id}",60, function() use($id)  { // 60=>60 seconds
            return Product::with(['categories','images','comments'])->findOrfail($id);
        });

        return view('product.show',[
            'product'=>$product,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product=Product::with(['categories','images'])->findOrfail($id);

        $categories=Category::all();
        return view('product.edit',[
            'product'=>$product,
            'categories'=>$categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreProductRequest $request, $id)
    {

      $data=$request->only(['sku','name','description','qty_in_stock','price']);
      $product=Product::findOrfail($id);
      $product->update($data);
        //store categories--
$filteredAttributeNames = array_filter($request->keys(), function ($key){
    return strpos($key, 'category-') === 0;
});
$filteredAttributeNames = collect($filteredAttributeNames);
$filteredAttributeNames->push('category_id');
$categories=$request->only($filteredAttributeNames->toArray());
$categoriesIds=collect($categories)->values()->toArray();
$product->categories()->sync($categoriesIds);
//end store categories
      $product->save();

// Upload file
$hasfile=$request->hasfile('picture');
$picture=$request->file('picture');
if($hasfile) {
$path=Storage::putFile('products',$picture);
//$path=Storage::url($file);
// first method
// $image=new Image(['url'=>$path]);
// $product->images()->save($image);
//  second method:
$image=Image::make(['url'=>$path]);
$product->images()->save($image);
      }
      //end
 $request->session()->flash('status',' product updated !!');
      return redirect()->route('product.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
      Product::destroy($id);
      $request->session()->flash('failed',' product Deleted !!');
      return redirect()->route('product.index');

    }
}
