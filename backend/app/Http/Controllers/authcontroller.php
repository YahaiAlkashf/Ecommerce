<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use function Laravel\Prompts\password;
use Illuminate\Support\Facades\Auth;

class authcontroller extends Controller
{
    public function register(Request $request){

        
       $validator=Validator::make($request->all(),[
            'name'=>'required|string',
            'email'=>'required|email',
            'password'=>'required|min:6|confirmed',
        ]);
        if($validator->fails()){
            return response()->json(['errors'=> $validator->errors() ],422);
        }


        $user=User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=> Hash::make($request->password),
        ]);
     
        $token = $user->createToken('auth_token')->plainTextToken ?? null;

            if (!$token) {
                return response()->json(['error' => 'فشل في إنشاء التوكن'], 500);
            }

            return response()->json(['message' => 'تم التسجيل بنجاح', 'token' => $token, 'user' => $user], 201);
        
    }


    public function login(Request $request){
        $validator=Validator::make($request->all(),[
                'email'=>'required|email',
                'password'=>'required|min:6'
        ]);

        if($validator->fails()){
            return response()->json(['message'=>'اسم المستخدم او كلمة المرور غير صحيحة'],400);
        }
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = User::where('email', $request->email)->first();
            $token = $user->createToken('auth_token')->plainTextToken;
            return response()->json([
                'token'=>$token,
                'message'=>'تم ستجيل الدخول'
            ],200);
        }
        else{
            return response()->json([
                'message'=>'المستخدم غير مسجل دخول',
            ],401);
        }
    }
}
