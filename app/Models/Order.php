<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id','address_id', 'shipping_id','payment_id','order_total','order_status_id'
    ];
    
    public function products()
    {
        return $this->morphToMany(Product::class, 'productable');
    }
    public function user()
    { 
        return $this->belongsTo('App\Models\User');
    }
    public function address()
    {
        return $this->belongsTo('App\Models\Address');
    }
    public function shipping()
    {
        return $this->belongsTo('App\Models\Shipping');
    }
    public function payment()
    {
        return $this->belongsTo('App\Models\Payment');
    }
    public function order_status()
    {
        return $this->belongsTo('App\Models\OrderStatus');
    }
}
