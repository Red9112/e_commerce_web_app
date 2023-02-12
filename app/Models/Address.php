<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'street_number',
        'address',
       'city',
       'region',
        'postal_code',
        'country',
        'is_default',
        'user_id',
    ];

//Relations:
public function user(){
    return $this->belongsTo(User::class);
}
public function orders(){
    return $this->hasMany('App\Models\Order');
}




}
