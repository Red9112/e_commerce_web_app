<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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


public function check_address_orders(Request $request){
    $user=auth()->user();
    $orders_count=$this->orders->count();
    if (!$user->hasRole('admin') && $orders_count!=0) {
        $request->session()->flash('failed',
        "address can't be deleted because its't involved in some orders !!");
        return redirect()->back();
    }
    if ($user->hasRole('admin') && $orders_count!=0) {
        $request->session()->flash('failed',
        "this address is involved in some orders, you've to delete them first!!");
        return redirect()->back();
    }
    else {
    $this->delete();
    $request->session()->flash('failed',' Address  Deleted !!');
    return redirect()->route('address.index');
    }
}




}
