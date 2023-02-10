<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'code', 'discount_type_id','user_id', 'value', 'description', 'start_date', 'end_date', 'expired',
    ];

    // public function products()
    // {
    //     return $this->belongsToMany('App\Models\Product');
    // }
    public function products()
    {
        return $this->morphToMany(Product::class, 'productable');
    }
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    public function discount_type(){
        return $this->belongsTo('App\Models\DiscountType');
    }

    // function for apply discount
    public function percent($originalPrice){
            return $originalPrice*$this->value/100;
    }

public function get_one_free($quantity){

    if($this->discount_type->name=="buy_one_get_one_free"){
       return ($quantity*2);
          }
          elseif($this->discount_type->name=="buy_two_get_one_free"){
            return ($quantity+floor($quantity*0.5));
               }
    else return $quantity;
}

}
