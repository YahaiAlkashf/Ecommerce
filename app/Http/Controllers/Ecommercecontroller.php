<?php

namespace App\Http\Controllers;
use  App\Models\Product;
use Illuminate\Http\Request;
class Ecommercecontroller extends Controller
{
    public function index(){
        return view('index');
    }

    public function dashboard(){
        $Product=Product::all();
        return view('dashboard',['Products'=>$Product]);
    }

    public function create(){
     return view('create');
    }

    public function store(){
        request()->validate([
            'name'=> ['required','string'],
            'price'=>['required','numeric'] ,
            'image'=>['required','image','mimes:jpeg,png,jpg,gif','max:2048']
        ]);
        $name= request()->name;
        $description= request()->description;
        $price= request()->price;
        $count=request()->count;
        if(request()->hasFile('image')){
            $image=request()->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('img'),$imageName);
        }


        Product::create([
         'name'=>$name,
         'description'=>$description,
         'price'=>$price,
         'count'=>$count,
         'imagePath'=>$imageName
        ]);
        return to_route('dashboard');
    }


    public function edit($postid){
        $product=Product::find($postid);
        return view('edit',['product'=>$product]);
    }

    public function update($postid){
        $name=request()->name;
        $price=request()->price;
        $count=request()->count;
        $description=request()->description;
        $t=false;
        if(request()->hasfile('image')){
            $image=request()->file('image');
            $imageName=time().'.'.$image->extension();
            $image->move(public_path('img'),$imageName);
            $t=true;
        }
        $single_product= Product::find($postid);
        $data=[
            'name'=>$name,
            'price'=>$price,
            'count'=>$count,
            'description'=>$description
        ];
        if($t){
            $date['imagePath']=$imageName; 
              } 
        $single_product->update($data);

        return to_route('dashboard');
    }

    public function delete($pruductid){
        $single_product=Product::find($pruductid);
        $single_product->delete();
        return to_route('dashboard');
    }
}
