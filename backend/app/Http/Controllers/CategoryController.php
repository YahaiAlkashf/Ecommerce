<?php

namespace App\Http\Controllers;
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


    public function store(Request $request){

        $request->validate([
            'name' => 'required|string',
        ]);


        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('categories', 'public');

        } else {
            return response()->json([
                'status' => false,
                'message' => 'الصورة غير مرفقة'
            ], 400);
        }


        $category = Category::create([
            'name' => $request->name,
            'image_path' => $imagePath
        ]);

        return response()->json([
            'status' => true,
            'category' => $category
        ]);
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        // التأكد من عدم وجود منتجات مرتبطة بالقسم قبل الحذف
        if ($category->products()->exists()) {
            return response()->json([
                'status' => false,
                'message' => 'لا يمكن حذف القسم لأنه يحتوي على منتجات'
            ], 400);
        }

        try {
            // حذف الصورة المرتبطة بالقسم إذا كانت موجودة
            if ($category->image_path) {
                Storage::disk('public')->delete($category->image_path);
            }

            // حذف القسم من قاعدة البيانات
            $category->delete();

            return response()->json([
                'status' => true,
                'message' => 'تم حذف القسم بنجاح'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'حدث خطأ أثناء محاولة حذف القسم.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

public function edit($id){
    $category=Category::findorfail($id);
    return response()->json([
        'category'=>$category
    ]);
}


public function update(Request $request, $id) {
    $request->validate([
        'name' => 'required|string',
        'image' => 'nullable|mimes:jpeg,png,jpg,gif'
    ]);

    $category = Category::find($id);
    if (!$category) {
        return response()->json([
            'message' => 'القسم غير موجود'
        ]);
    }
    $category->name = $request->name;
    if ($request->hasFile('image')) {

        if ($category->image_path) {
            Storage::disk('public')->delete($category->image_path);
        }

        $imagePath = $request->file('image')->store('categories', 'public');
        $category->image_path = $imagePath;
    }


    $category->save();

    return response()->json([
        'status' => 'true'
    ]);
}
}
