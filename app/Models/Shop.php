<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
     public function products(){
        return $this->hasMany('App\Models\Product')->order();
     }
     public function scopeShopProducts(Builder $query){
      return $query->withCount('products')->orderBy('products_count','desc');
     }
}
 