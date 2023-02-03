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

    public function products()
    {
        return $this->belongsToMany('App\Models\Product');
    }
    public function user(){
        return $this->belongsTo('App\Models\User');
    }


}
