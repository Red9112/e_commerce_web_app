<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\User;
use App\Models\Image;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Repositories\ProductRepository;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreProductRequest;

class ProductController extends Controller
{
    public $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->middleware('auth');
        $this->productRepository=$productRepository;
    }
    public function index()
    {
       $user=User::with(['shop','shop.products','shop.products.images','shop.products.categories'])
       ->findOrfail(auth()->id());
       ($user->shop!=null)? $products=$user->shop->products:$products=null;
        return view('product.index',[
            'products'=>$products,
        ]);
    }


    public function create()
    {

     $categories=Category::all();
        return view('product.create',[
            'categories'=>$categories
        ]);
    }

    public function store(StoreProductRequest $request)
    {
        $vender=User::findOrfail(auth()->id());
        $data=$request->only(['sku','name','description','qty_in_stock','price']);
        $data['shop_id']=$vender->shop->id;
        $product=Product::create($data);
$this->productRepository->store_categories_to_product($request,$product);
$this->productRepository->upload_image_to_product($request,$product);
$request->session()->flash('status','your product was created !! ');
return redirect()->route('product.index');

    }

    public function show($id)
    {
        $product=Cache::remember("product-{$id}",60, function() use($id)  { // 60=>60 seconds
            return Product::with(['categories','images','comments'])->findOrfail($id);
        });
        return view('product.show',[
            'product'=>$product,
        ]);
    }


    public function edit($id)
    {
        $product=Product::with(['categories','images'])->findOrfail($id);
        $categories=Category::all();
        return view('product.edit',[
            'product'=>$product,
            'categories'=>$categories,
        ]);
    }
    public function update(StoreProductRequest $request, $id)
    {

      $data=$request->only(['sku','name','description','qty_in_stock','price']);
      $product=Product::findOrfail($id);
      $product->update($data);
      $this->productRepository->store_categories_to_product($request,$product);
      $this->productRepository->upload_image_to_product($request,$product);
 $request->session()->flash('status',' product updated !!');
      return redirect()->route('product.index');

    }

    public function destroy(Request $request,$id)
    {
      $this->productRepository->destroy_product($id);
      $request->session()->flash('failed',' product Deleted !!');
      return redirect()->route('product.index');

    }
}
