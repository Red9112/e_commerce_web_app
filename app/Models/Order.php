<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'address_id', 'shipping_id','payment_id','order_total','order_status_id'
    ];
    
    public function products()
    {
        return $this->morphToMany(Product::class, 'productable');
    }
}
