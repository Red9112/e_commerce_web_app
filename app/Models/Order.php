<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id','address_id', 'shipping_id','payment_id','order_total','order_status_id'
    ];
    
    public function products()
    {
        return $this->belongsToMany('App\Models\Product')
        ->withPivot(['price','selected_quantity','bonus_quantity']);
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
    
    // local scopes
    public function scopeIndexOrders(Builder $query){
        return $query->orderBy(static::CREATED_AT,'asc')->with(['user','order_status']);
            }






}
