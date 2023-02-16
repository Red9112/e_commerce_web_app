<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Image;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{

    public $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository=$userRepository;
         //$this->authorizeResource(User::class,'user');
    }



    public function index()
    {
        $user=auth()->user();
        $this->authorize('viewAny',$user);
       $users=User::orderBy('id')->get();
       return view('users.index',[
        'users'=>$users,
        'user'=>$user,
       ]);
    }

    public function create()
    {
        $user=auth()->user();
        $roles=Role::all();
        return view('users.create',[
            'roles'=>$roles,
            'user'=>$user,
        ]);

    }

    public function store(StoreUserRequest $request)
    {
        $user=$this->userRepository->store_user($request);
        $this->userRepository->affect_roles_to_created_user($request,$user);
        (Auth::check())
        ?$request->session()->flash('status','A new account  created !!')
        :$request->session()->flash('status',' Registration completed !!');
        return redirect()->route('dashboard');
    }

    public function show(User $user)
    {
        $authUser=auth()->user();
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
        $this->userRepository->update_user($request,$user);
        $this->userRepository->store_image_to_user($request,$user);
        $this->userRepository->affect_roles_by_admin($request,$user);
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
