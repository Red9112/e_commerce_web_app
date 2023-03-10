<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
    ];

    public function user(){
        return $this->belongsTo('App\Models\User');
     }
    //  public function products(){
    //     return $this->belongsToMany('App\Models\Product');
    //  }
     public function products()
    {
        return $this->morphToMany(Product::class, 'productable');
    }


}
