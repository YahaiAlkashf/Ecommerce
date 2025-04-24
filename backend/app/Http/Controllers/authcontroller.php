<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use function Laravel\Prompts\password;
use Illuminate\Support\Facades\Auth;
use  App\Http\Requests\RegisterRequset;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
class authcontroller extends Controller
{
     public function register(RegisterRequset $request){
                    $validator=$request->validated();
                    $user=User::create($validator);
                    $token = $user->createToken('auth_token')->plainTextToken ;
                    return response()->json(['token'=>$token, 'role'=>$user->role, 'user' => $user], 200);
                }


    public function login(LoginRequest $request){
        $validator=$request->validated();
        if(Auth::attempt($validator)){
            $user = User::where('email', $validator['email'])->first();
            $token = $user->createToken('auth_token')->plainTextToken;
            return response()->json([
                'role'=> $user->role,
                'token'=>$token,
            ],200)->cookie('token',$token,60*60*7,'/',null,true,true);
        }
        else{
            return response()->json([
                'message'=>' email or password invalid',
            ],401);
        }
    }

    public function checkRole(Request $request) {
        return response()->json([
            'status' =>true,
            'role' => $request->user()->role,
        ], 200);
    }


    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
       return response()->json([
            'status'=>true,
        ],200);
    }





 

}
