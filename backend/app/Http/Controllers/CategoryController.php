<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index(){
      $allCategory=Category::withCount('products')->get();
      return response()->json([
        'allCategory'=>$allCategory
      ]);
    }


    public function store(StoreCategoryRequest $request){

        $validator = $request->validated();
        try{

             $imagePath = $request->file('image')->store('categories', 'public');
             Category::create([
                'name'=>$validator['name'],
                'image'=>$imagePath
             ]);
            return response()->json([
                'status' => true,
            ],201);
        }catch(\Exception $e){
            return response()->json($e);
        }

    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }
            $category->delete();
            return response()->json([
                'status' => true,
            ], 204);
    }

   public function show($id){
        $category=Category::findOrFail($id);
        return response()->json([
            'category'=>$category
        ]);
   }


    public function update(UpdateCategoryRequest $request,$id) {
    $validator = $request->validated();

        $category = Category::findOrFail($id);
        $category->name = $validator['name'];
        if ($request->hasFile('image')){
        Storage::disk('public')->delete($category['image']);
            $imagePath = $request->file('image')->store('categories', 'public');
            $category->image = $imagePath;
        }
        $category->save();
        return response()->json([
            'status' => 'true'
        ],201);
    }
}
