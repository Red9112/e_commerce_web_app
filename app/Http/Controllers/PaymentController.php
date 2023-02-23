<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user=auth()->user();
        $this->authorize('viewAny',$user);
        $payments=Payment::all();
        return view('payment.payment',[
            'payments'=>$payments
        ]);
    }
    public function user_cards()
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
        $payment=Payment::with('user')->findOrFail($id);
        $this->authorize('edit',$payment);
        return view('payment.edit',[
            'payment'=>$payment,
        ]);
    }

    public function update(Request $request, $id)
    {
        $payment=Payment::with('user')->findOrFail($id);
        $this->authorize('update',$payment);
        $vldtData=$request->validate(['account_number'=>'string','is_default'=>'boolean']);
        $payment->update($vldtData);
        $request->session()->flash('status','a payment card  updated !!');
        return redirect()->route('payment.index');
    }

    public function destroy(Request $request,$id)
    {
        $payment=Payment::with('user')->findOrFail($id);
        $this->authorize('delete',$payment);
        Payment::destroy($id);
        $request->session()->flash('failed','a payment card deleted !!');
        return redirect()->route('payment.index');

    }
}
