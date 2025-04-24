<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrdereReqest;
use App\Http\Requests\UpdateOrdereRequest;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OrderController extends Controller
{

    public function index(){
        $orders = Order::with(['products' => function ($query) {
            $query->with(['images' => function ($imageQuery) {
                $imageQuery->select('product_id', 'image_url')->limit(1);
            }]);
        }])->get();

        return response()->json(['orders' => $orders], 200);
    }


    public function store(StoreOrdereReqest $request){

        $validator =$request->validated();

           $order= Order::create([
                'name'=>$request->name,
                'status'=>'pending',
                'phone'=>$request->phone,
                'address'=>$request->address,
                'alternative_phone'=>$request->alternativePhone,
                'payment_method'=>"OnDlivered",
                'user_id'=>$request->user_id,
                'total_price'=>0
            ]);

            $tolal_price=0;
            foreach($request->products as $product){
                $order->products()->attach($product['id']);
                $productPrice=Product::find($product['id'])->price;
                $tolal_price+= $productPrice * 1;
            }
            $order->update([
                'total_price'=>$tolal_price
            ]);


            return response()->json([
                'status'=>true,
            ]);
    }

    public function update(UpdateOrdereRequest $request , Order $order){
        $validator = $request->validated();
        $order->update($validator);
        return response()->json([
            'status' => true,
            'data' => $order
        ], 200);
    }

}
