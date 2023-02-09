<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{

    public function index()
    {
        $user=auth()->user();
        $payments=$user->payments;
        return view('payment.payment',[
            'payments'=>$payments
        ]);
    }
    public function store(Request $request)
    {

   $vldtData=$request->validate(['account_number'=>'string','is_default'=>'boolean']);
   $vldtData['user_id']=auth()->id();
   Payment::create($vldtData);
   $request->session()->flash('status','a payment card  created !! ');
   return redirect()->route('payment.index');

    }

    public function edit($id)
    {
        $payment=Payment::findOrFail($id);
        return view('payment.edit',[
            'payment'=>$payment,
        ]);
    }

    public function update(Request $request, $id)
    {
        $vldtData=$request->validate(['account_number'=>'string','is_default'=>'boolean']);
        Payment::findOrfail($id)->update($vldtData);
        $request->session()->flash('status','a payment card  updated !!');
        return redirect()->route('payment.index');
    }

    public function destroy(Request $request,$id)
    {
        Payment::destroy($id);
        $request->session()->flash('failed','a payment card deleted !!');
        return redirect()->route('payment.index');
    }
}
