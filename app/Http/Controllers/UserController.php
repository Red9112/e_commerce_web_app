<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Image;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    public function __construct()
    {

     //$this->authorizeResource(User::class,'user');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id=auth()->id();
        $user=User::findOrFail($id);
        $this->authorize('viewAny',$user);
       $users=User::orderBy('id')->get();
       return view('users.index',[
        'users'=>$users
       ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $id=auth()->id();
        $user=User::findOrFail($id);
        $roles=Role::all();
        return view('users.create',[
            'roles'=>$roles,
            'user'=>$user,
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {

     $data=$request->only(['name','email','password']);
     $user=User::create([
        'name'           => $data['name'],
        'email'          => $data['email'],
        'password'       => bcrypt($data['password']),
        'remember_token' => null,
    ]);
         //store roles--
$filteredAttributeNames = array_filter($request->keys(), function ($key){
    return strpos($key, 'role-') === 0;
});
$filteredAttributeNames = collect($filteredAttributeNames);
$filteredAttributeNames->push('role');
$users=$request->only($filteredAttributeNames->toArray());
$userIds=collect($users)->values()->toArray();
$user->roles()->sync($userIds);
//end store roles
$request->session()->flash('status',' User created !!');
        return redirect()->route('user.index');
 
    }

    public function show(User $user)
    {
        $id=auth()->id();
        $authUser=User::findOrFail($id);
        $this->authorize('view',$authUser);
        return view('users.show', compact('user'));

    }


    public function edit(User $user)
    {
        $this->authorize('update',$user);
        $roles=Role::all();
        return view('users.edit', [
            'user'=>$user,
            'roles'=>$roles,
        ]);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $this->authorize('update',$user);
       $data=$request->only(['name','email','password']);
       $user->update([
         'name'           => $data['name'],
         'email'          => $data['email'],
         'password'       => bcrypt($data['password']),
         'remember_token' => null,
     ]);
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
                 //store roles--
$filteredAttributeNames = array_filter($request->keys(), function ($key){
    return strpos($key, 'role-') === 0;
});
$filteredAttributeNames = collect($filteredAttributeNames);
$filteredAttributeNames->push('role');
$users=$request->only($filteredAttributeNames->toArray());
$userIds=collect($users)->values()->toArray();
$user->roles()->sync($userIds);
//end store roles

        $request->session()->flash('status',' User Updated !!');
        return redirect()->route('user.show',['user'=>$user->id]);
    }

    public function destroy(Request $request,User $user)
    {
        $this->authorize('update',$user);
     User::destroy($user->id);
      $request->session()->flash('failed',' User Deleted !!');
      return redirect()->route('user.index');
    }
}
