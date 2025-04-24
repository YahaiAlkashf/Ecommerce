<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMessageReqest;
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



    public function store(StoreMessageReqest $request){

      $validator = $request->validated();
        Message::create($validator);
        return response()->json([
          'status'=>true
        ],201);
    }



}
