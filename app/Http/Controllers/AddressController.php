<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use App\Http\Requests\AddressRequest;

class AddressController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $addresses=Address::with('user')->get();
        return view('address.index',[
            'addresses'=>$addresses
        ]);
    }
    public function create()
    {
        return view('address.create');
    }

    public function store(AddressRequest $request)
    {
        $data=$request->only([
            'street_number','address','city','region','postal_code','country','is_default',
        ]);
        $data['user_id']=auth()->id();
        Address::create($data);
        $request->session()->flash('status','an address was created !! ');
       return redirect()->route('address.index');
    }

    public function edit($id)
    {
        $address=Address::findOrFail($id);
        return view('address.edit',[
            'address'=>$address,
        ]);
    }

    public function update(AddressRequest $request, $id)
    {
        $data=$request->only([
            'street_number','address','city','region','postal_code','country','is_default',
        ]);
        Address::findOrfail($id)->update($data);
        $request->session()->flash('status','The address  updated !!');
      return redirect()->route('address.index');
    }

    public function destroy(Request $request,$id)
    {
        Address::destroy($id);
        $request->session()->flash('failed',' Address Deleted !!');
        return redirect()->route('address.index');
    }


}
