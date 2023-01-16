<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;


class ApiAuthController extends Controller
{

   
    public function login(Request $request)
    {
        $request->validate([ 
            'email'=>'required|email|max:255',
            'password'=>'required', 'string', 'min:4',
             
        ]);
        
        $user = User::where('email', $request->email)->first();
 
        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
     
        return response()->json([
            'api_token'=>$user->createToken('api.token')->plainTextToken,
        ])  ;
      
    }

}
