<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adress extends Model
{
    use HasFactory;

    protected $fillable = [
        'street_number',
        'adress',
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




}
 