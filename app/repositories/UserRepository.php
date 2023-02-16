<?php

namespace  App\Repositories;
use App\Models\Role;
use App\Models\User;
use App\Models\Image;
use Illuminate\Http\Request;
use App\Events\NewVendorRequestEvent;
use Illuminate\Support\Facades\Storage;

class UserRepository{


    public function store_user(Request $request)
    {
        $data=$request->only(['name','email','password']);
        $user=User::create([
           'name'           => $data['name'],
           'email'          => $data['email'],
           'password'       => bcrypt($data['password']),
           'remember_token' => null,
       ]);
       return $user;
    }
    public function affect_roles_to_created_user(Request $request,User $user)
    {
        $authUser=auth()->user();
        if ($authUser==null ||!$authUser->hasRole('admin')) {
            //store roles by user--
          $customerRoleId=collect(Role::where("name","customer")->get())->pluck('id');
          $user->roles()->sync($customerRoleId);
            //end store roles
          //send a notification to admin if the user asked to be vendor
          $vendorRoleId=collect(Role::where("name","vendor")->get())->pluck('id');
          ($request->role==$vendorRoleId)?event(new NewVendorRequestEvent($user)):null;
              }
      else {
        $this->affect_roles_by_admin($request,$user);
      }

    }
    public function update_user(Request $request,User $user)
    {
        $data=$request->only(['name','email','password']);
        $user->update([
          'name'           => $data['name'],
          'email'          => $data['email'],
          'password'       => bcrypt($data['password']),
          'remember_token' => null,
      ]);
    }
    public function store_image_to_user(Request $request,User $user)
    {
        $hasfile=$request->hasFile('picture');
        $picture=$request->file('picture');
        if($hasfile){
            $path=Storage::putFile('users',$picture);
            if ($user->image) {
            Storage::delete($user->image->url);
            $user->image->url= $path;
            $user->image->save();
            }else{
                $image=Image::make(['url'=>$path]);
                $user->image()->save($image);
            }
        }
    }
    public function  affect_roles_by_admin(Request $request,User $user)
    {
  $filteredAttributeNames = array_filter($request->keys(), function ($key){
    return strpos($key, 'role-') === 0;
});
$filteredAttributeNames = collect($filteredAttributeNames);
$filteredAttributeNames->push('role');
$users=$request->only($filteredAttributeNames->toArray());
$userIds=collect($users)->values()->toArray();
$user->roles()->sync($userIds);
    }


}

