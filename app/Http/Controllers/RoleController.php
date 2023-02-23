<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{

    public function index()
    {
        $user=auth()->user();
        $this->authorize('viewAny',$user);
        $roles=Role::all();
        return view('roles.role',[
            'roles'=>$roles,
        ]);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $user=auth()->user();
        $this->authorize('store',$user);
        $vldtData=$request->validate(['name'=>'min:3']);
        Role::create($vldtData);
         $request->session()->flash('status','a role was created !! ');
             return redirect()->route('role.index');
    }


    public function edit(Role $role)
    {
        $user=auth()->user();
        $this->authorize('edit',$user);
        return view('roles.edit',[
            'role'=>$role,

        ]);
    }


    public function update(Request $request, Role $role)
    {
        $user=auth()->user();
        $this->authorize('update',$user);
        $vldtData=$request->validate(['name'=>'min:3']);
        $role->update($vldtData);
        $request->session()->flash('status','The role was updated !!');
      return redirect()->route('role.index');
    }


    public function destroy(Request $request,Role $role)
    {
        $user=auth()->user();
        $this->authorize('delete',$user);
        $role->delete();
        $request->session()->flash('failed','a role Deleted !!');
        return redirect()->route('role.index');
    }
}
