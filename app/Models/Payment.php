<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;
    protected $fillable=['user_id','account_number','is_default'];


    public function user(){
        return $this->belongsTo(User::class);
    }
    public function orders(){
        return $this->hasMany('App\Models\Order');
    }


    public function check_payment_orders(Request $request){
        $user=auth()->user();
        $orders_count=$this->orders->count();
        if (!$user->hasRole('admin') && $orders_count!=0) {
            $request->session()->flash('failed',
            "payment card can't be deleted because its't involved in some orders !!");
            return redirect()->back();
        } 
        if ($user->hasRole('admin') && $orders_count!=0) {
            $request->session()->flash('failed',
            "this payment card is involved in some orders, you've to delete them first!!");
            return redirect()->back();
        }
        else {
        $this->delete();
        $request->session()->flash('failed','a payment card deleted !!');
        return redirect()->route('payment.index');
        }
    }







}
