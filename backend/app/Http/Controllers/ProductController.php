<?php

namespace App\Http\Controllers;
use App\Models\ProductImage;
use App\Models\Product;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use function Pest\Laravel\json;

class ProductController extends Controller
{

    public function index(){
        try {
            $allProduct=Product::with('images')->get();
            return response()->json(['products'=>$allProduct]);
        } catch (\Exception $e) {
            return response()->json([
                'status'=>false,
                'message'=>$e->getMessage()
            ]);
        }

    }

    public function store(Request $request){
         $request->validate([
                    'name'=>'required',
                    'description'=>'required',
                    'price'=>'required',
                    'rating'=>'required',
                    'category'=>'required|exists:categories,id',
                    'images.*' => 'mimes:jpeg,png,jpg,gif',
            ]);

             $product=Product::create([
                    'name'=>$request->name,
                    'description'=>$request->description,
                    'price'=>$request->price,
                    'rating'=>$request->rating,
                    'category_id'=>$request->category,
                ]);


                if($request->hasFile('images')){
                    $images=$request->file('images');
                    $imagepath=[];

                    foreach($images as $image ){
                        $path=$image->store('product_image','public');
                        ProductImage::create([
                            'product_id' => $product->id,
                            'image_path' => $path,
                        ]);
                    }
                }
                return response()->json([
                    'message'=>'تم انشاء المنتج',
                    'status'=>true
                ],201);


    }

    public function destroy($productId){
        try{
            $product=Product::find($productId);

            if(!$product){
                return response()->json([
                    'message'=>'المنتج غير موجود'
                ]);
            }

            $images=ProductImage::where('product_id',$productId)->get();

            foreach($images as $image){
                Storage::disk('public')->delete($image->image_path);
                $image->delete();
            }

            $product->delete();

            return response()->json([
                'status'=>true,
                'message'=>'تم الحذف بنجاح'
            ]);
        }catch(\Exception $e){
            return response()->json([
                'status'=>false,
                'message'=>$e->getMessage()
            ]);
        }



    }

        public function edit($productId){

            $product=Product::with('images')->find($productId);

            return response()->json([
                'product'=>$product
            ]);
        }


    public function update(Request $request,$productId){
            $request->validate([
                'name'=>'required',
                'description'=>'required',
                'price'=>'required',
                'rating'=>'required',
                'category'=>'required|exists:categories,id',
                'images.*' => 'mimes:jpeg,png,jpg,gif',
             ]);

             $product=Product::findorFail($productId);

             $product->update([
                'name'=>$request->name,
                'description'=>$request->description,
                'price'=>$request->price,
                'rating'=>$request->rating,
                'category_id'=>$request->category,
            ]);

            if($request->hasFile('images')){
                $oldImages=ProductImage::where('product_id',$productId)->get();

                foreach($oldImages as $oldImage){
                    Storage::disk('public')->delete($oldImage->image_path);
                    $oldImage->delete();
                }

                $images=$request->file('images');
                $imagepath=[];

                foreach($images as $image ){
                    $path=$image->store('product_image','public');
                    ProductImage::create([
                        'product_id' => $productId,
                        'image_path' => $path,
                    ]);
                }
            }
            return response()->json([
                    'message'=>'تم التعديل بنجاح'
            ]);

    }

    public function singleProduct($id){

    }

}
