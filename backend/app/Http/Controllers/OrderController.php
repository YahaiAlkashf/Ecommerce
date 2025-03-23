<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OrderController extends Controller
{

    public function index()
    {
        $orders = Order::with(['products' => function ($query) {
            $query->with(['images' => function ($imageQuery) {
                $imageQuery->select('product_id', 'image_url')->limit(1);
            }]);
        }])->get();
    
        return response()->json(['orders' => $orders], 200);
    }


    public function store(Request $request)
    {
        try{
            $request->validate([
                'name'=>'required|string',
                'phone'=>'required|numeric',
                'address'=>'required|string',
                'products'=>'required|array',
                'products.*.id'=>'exists:products,id',
                
            ]);
    
           $order= Order::create([
                'name'=>$request->name,
                'status'=>'pending',
                'phone'=>$request->phone,
                'address'=>$request->address,
                'alternative_phone'=>$request->alternativePhone,
                'payment_method'=>"عند الاستلام",
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
                'message'=>'تم ارسال الطلب بنجاح',
            ]);

        }catch(\Exception $e){
            return response()->json([
                'status'=>false,
                'message'=>$e->getMessage(),
            ]);
        }


    }


    
    public function update(Request $request ,$orderId){
            $request->validate([
                'status'=>['required',Rule::in(['pending','Confirmed','Delivered'])]
            ]);
            
            $order=Order::find($orderId);
            if(!$order){
                return response()->json([
                    'status'=>false,
                ],400);
            }

            $order->update([
                'status'=>$request->status,
            ]);

            return response()->json([
                'status'=>true,
            ],200);

    }

}
