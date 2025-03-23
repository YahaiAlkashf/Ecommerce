<?php

namespace App\Http\Controllers;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{


    public function index(){
            $allMessage=Message::all();
            return response()->json([
                'allMessage'=>$allMessage,
            ],200);    
    }


    
    public function store(Request $request){

        $request->validate([
            'name'=>'required|string|max:100',
            'email'=>'required|email',
            'phone'=>'required|digits_between:10,15',
            'message'=>'required',
        ]);

        Message::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'message'=>$request->message,
        ]);

        return response()->json([
          'status'=>true
        ],200);

    }



}
