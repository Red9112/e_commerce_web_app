<?php

namespace App\Models;

use App\Scopes\LatestScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;


    protected $fillable = [
        'sku',
        'name',
       'qty_in_stock',
        'price',
        'description',
        'shop_id',
    ];

    //Relations:
    public function comments(){
        return $this->morphMany('App\Models\Comment','commentable');
    }
    public function images(){
        return $this->morphMany('App\Models\Image','imageable');
    }
    public function shop(){
        return $this->belongsTo('App\Models\Shop');
    }
    public function wishlists(){
        return $this->morphedByMany(Wishlist::class, 'productable');
    }
    public function discounts()
    {
        return $this->morphedByMany(Discount::class, 'productable');
    }
    public function orders()
    {
        return $this->belongsToMany('App\Models\Order')
        ->withPivot(['price','selected_quantity','bonus_quantity']);
    }
public function categories()
{
    return $this->morphToMany('App\Models\Category','categoreable')->withTimestamps();
}
    public function getFirstImage(){
        if (count($this->images)>0) {
          return $this->images->first()->url();
        }
        return asset('http://localhost:8000/storage/products/defaultProduct.png');
    }



    // {{--Local Scope--}}
    public function scopeOrder(Builder $query){
return $query->orderBy(static::CREATED_AT,'asc')->with('images');
    }

  // {{--Global Scope--}}
//       public static function boot(){
//         parent::boot();
//   static::addGlobalScope(new LatestScope);
//     }




}
