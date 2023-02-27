<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{

    public function index()
    {
        $role=new Role();
        $this->authorize('viewAny',$role);
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
        $role=new Role();
        $this->authorize('store',$role);
        $vldtData=$request->validate(['name'=>'min:3']);
        Role::create($vldtData);
         $request->session()->flash('status','a role was created !! ');
             return redirect()->route('role.index');
    }


    public function edit(Role $role)
    {
        $this->authorize('edit',$role);
        return view('roles.edit',[
            'role'=>$role,

        ]);
    }


    public function update(Request $request, Role $role)
    {
        $this->authorize('update',$role);
        $vldtData=$request->validate(['name'=>'min:3']);
        $role->update($vldtData);
        $request->session()->flash('status','The role was updated !!');
      return redirect()->route('role.index');
    }


    public function destroy(Request $request,Role $role)
    {
        $this->authorize('delete',$role);
        $users_count=$role->users->count();
        if ($users_count!=0) {
            $request->session()->flash('failed',
            " Error: Role can't be deleted because it's affected to some users!!");
        }
        else{ 
            $role->delete();
            $request->session()->flash('failed','  Role is deleted !!');
        }
        return redirect()->route('role.index');
    }
}
