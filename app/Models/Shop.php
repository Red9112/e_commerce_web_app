<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Shop extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'phone_number',
        'email',
        'logo',
        'user_id',
    ];

     //Relations:
     public function user(){
        return $this->belongsTo('App\Models\User');
     }
     public function image(){
        return $this->morphOne('App\Models\Image','imageable');
    }
    public function defaultShopImage(){
        return asset('images/defaultShop.png');
          }

     public function products(){
        return $this->hasMany('App\Models\Product')->order();
     }


//scopes:
     public function scopeShopProducts(Builder $query){
      return $query->withCount('products')->orderBy('products_count','desc');
     }



//shop functions:

public function defaultImage(){
    return asset('http://localhost:8000/storage/shops/default_shop.jpg');
      }


     public function check_products_orders(){
      $products=$this->products;
      $is_shipped_canceled=true;
      foreach ($products as $product) {
          foreach ($product->orders as $order) {
              ($order->order_status->name!="shipped" && $order->order_status->name!="canceled")
              ?$is_shipped_canceled=false:null;
          }
      }
      return $is_shipped_canceled;
   }


   public function store_image_to_shop(Request $request)
   {
       $hasfile=$request->hasFile('picture');
       $picture=$request->file('picture');
       if($hasfile){
           $path=Storage::putFile('shops',$picture);
           if ($this->image) {
           Storage::delete($this->image->url);
           $this->image->url= $path;
           $this->image->save();
           }else{
               $image=Image::make(['url'=>$path]);
               $this->image()->save($image);
           }
       }
   }


}
