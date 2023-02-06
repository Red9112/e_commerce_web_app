<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountType extends Model
{
    use HasFactory;
    protected $fillable = [
        'name','description',
    ];


    public function discounts(){
        return $this->hasMany('App\Models\Discount');
     }
}
