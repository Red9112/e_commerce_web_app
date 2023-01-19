<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Image;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use App\Models\Role;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    public function __construct()
    {
     $this->middleware('auth');
     $this->authorizeResource(User::class, 'user');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

       $id=auth()->id();
       $user=User::findOrFAil($id);
      // $this->authorize('viewAny',$user);
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
        $roles=Role::all();
        //$user=auth()->id();
       // $this->authorize('create',$user);
        return view('users.create',[
            'roles'=>$roles,
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
        $user=auth()->id();
       // $this->authorize('create',$user);
     $data=$request->only(['name','email','password']);
      User::create([
        'name'           => $data['name'],
        'email'          => $data['email'],
        'password'       => bcrypt($data['password']),
        'remember_token' => null,
    ]);
        return redirect()->route('user.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {

       // $this->authorize('view',$user);
        return view('users.show', compact('user'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
     // $this->authorize('update',$user);
        return view('users.edit', [
            'user'=>$user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUserRequest $request, User $user)
    {
       // $this->authorize('update',$user);
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
        $request->session()->flash('status',' User Updated !!');
        return redirect()->route('user.show',['user'=>$user->id]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,User $user)
    {
        //$this->authorize('delete',$user);
     User::destroy($user->id);
      $request->session()->flash('failed',' User Deleted !!');
      return redirect()->route('user.index');
    }
}
