<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorProductReuest;
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

    public function store(StorProductReuest $request){
         $validator=$request->validated();
         try{
                $mianpath=$request->file('mainImage')->store('product_image','public');

                $validator['mainImage']= $mianpath;
                $product=Product::create($validator);
                if($request->hasFile('images')){
                    $images=$request->file('images');
                    foreach($images as $image ){
                        $path=$image->store('product_image','public');
                        ProductImage::create([
                            'product_id' => $product->id,
                            'productImage' => $path,
                        ]);
                    }
                }

                return response()->json([
                    'status'=>true
                ],201);
         }catch(\Exception $e){
            return response()->json($e);
         }
    }




    public function destroy($productId){
        try{
            $product=Product::find($productId);
            if(!$product){
                return response()->json([
                    'message'=>' invaild product '
                ]);
            }
            $images=ProductImage::where('product_id',$productId)->get();
            foreach($images as $image){
                Storage::disk('public')->delete($image->productImage);
                $image->delete();
            }
            $product->delete();
            return response()->json([
                'status'=>true,
            ],204);

        }catch(\Exception $e){
            return response()->json([
                'status'=>false,
                'message'=>$e
            ]);
        }
    }

        public function show($productId){
            $product=Product::with('images')->find($productId);
            return response()->json([
                'product'=>$product
            ]);
        }


    public function update(StorProductReuest $request,$productId){
            $validator=$request->validated();

             $product=Product::findOrFail($productId);

             if($request->hasFile('mainImage')){
                $mainImagePath=$request->file('mainImage')->store('product_image','public');
                $validator['mainImage']=$mainImagePath;
             }
             $product->update($validator);
            if($request->hasFile('images')){
                $oldImages=ProductImage::where('product_id',$productId)->get();

                foreach($oldImages as $oldImage){
                    Storage::disk('public')->delete($oldImage->productImage);
                    $oldImage->delete();
                }

                $images=$request->file('images');

                foreach($images as $image ){
                    $path=$image->store('product_image','public');
                    ProductImage::create([
                        'product_id' => $productId,
                        'image_path' => $path,
                    ]);
                }
            }
            return response()->json([
                'status'=>true
            ],201);

    }

    public function search(Request $request){
            $query=$request->input('query');
            $products=Product::where('name','LIKE',"%{$query}%")
                               ->orwhere('description','LIKE',"%{$query}")
                               ->get();
           return response($products)->json();
    }
}
